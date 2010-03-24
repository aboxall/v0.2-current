<?php

class Config
{
    private static $instance;
    private $properties = array();
    public $path;

    public static function getInstance()
    {
        if (!self::$instance)
        {
            self::$instance = new Config;
        }

        return self::$instance;
    }

    private function __construct()
    {
        // create a local var for the configs dir path
        $this->path = APP_PATH . '/configs/';

        // default config files to load
        $this->parse('config.ini', true);
        $this->parse('database.ini', true);

        // set the prod/dev environment
        $this->setEnvironment();
    }

    public function parse($ini, $file = false, $return = false)
    {
        // if $ini is a file..
        if ($file)
        {
            // preserve the original $ini var for later
            $path = $ini;

            // check if $ini param contains the relative/absolute
            // path to the config file by seeing if it exists
            if (!file_exists($path))
            {
                // if it doesn't prepend the default config path
                $path = $this->path . $path;

                // make sure the config file now exists
                if (!file_exists($path))
                {
                    // if not throw a Config exception
                    throw new ConfigException('Config file doesn\'t exist: ' . $ini);
                }
            }
        }

        // if $file is true we need to parse $ini param as a file 
        $parsed = $file ? parse_ini_file($path, true) : parse_ini_string($ini, true);

        // if the return param is set we want to return the parsed
        // INI file instead of adding to the properties array
        if ($return)
        {
            return $parsed;
        }

        // loop through the parsed array and add
        // each section to the properties array
        foreach ($parsed as $section => $properties)
        {
            $this->properties[$section] = $properties;
        }
    }

    public function get($property)
    {
        $tokens = explode('.', $property);
        $return = $this->properties;

        foreach ($tokens as $token)
        {
            $return = $this->recurseGet($token, $return);

            if (!$return)
            {
                break;
            }
        }

        return $return;
    }

	public function set($property, $value)
	{
        // FIXME - got frustrated and did this as a temp fix

        $tokens = explode('.', $property);
        $count  = count($tokens);

        switch ($count)
        {
            case 1:
                $this->properties[$property] = $value;
                break;
            case 2:
                $this->properties[$tokens[0]][$tokens[1]] = $value;
                break;
            case 3:
                $this->properties[$tokens[0]][$tokens[1]][$tokens[2]] = $value;
                break;
        }

        return true;
	}

    private function recurseGet($token, $properties)
    {
        if (array_key_exists($token, $properties))
        {
            return $properties[$token];
        }

        return false;
    }

    private function setEnvironment($overwrite = false)
    {
        $uri = Load::library('URI');

        if (!empty($overwrite))
        {
            // we're overwriting the default environment 
            $env = $overwrite;
        }
        else
        {
            $prod_exps = $this->get('server.prod_exps');

            foreach ($prod_exps as $exp)
            {
                if (preg_match($exp, $_SERVER['SCRIPT_URI']))
                {
                    // we're on the production site
                    $env = 'prod';

                    // break as we have a valid match
                    break;
                }
            }
        }

        if (empty($env))
        {
            // we're on the development site
            $env = 'dev';
        }

        // set the server enviroment
        $this->set('server.environment', $env);
    }

    public function getEnvironment()
    {
        // returns the environment string (by default dev or prod)
        return $this->get('server.environment');
    }

    public function isDev()
    {
        // return true if we're in the dev environment
        return ($this->get('server.environment') == 'dev') ? true : false;
    }

    public function isProd()
    {
        // return true if we're in the prod environment
        return ($this->get('server.environment') == 'prod') ? true : false;
    }
}

// EOF
