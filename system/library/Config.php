<?php

class Config
{
    private $properties = array();
    private static $instance;

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

        // check whether we're using environment levels
        if ($this->get('server.use_environment'))
        {
            // set the dev/prod environment
            $this->setEnvironment();
        }

        // load the session library to detect debug_mode override
        $session = Load::library('Session');

        // check if the debug GET param has been passed
        if (isset($_GET['debug']))
        {
            // parse the integer value of debug GET param
            $debug_mode = (int) $_GET['debug'];

            // override the debug mode
            $this->set('server.debug_mode', $debug_mode);

            // store the value for the rest of the session
            $session->set('debug_mode_override', $debug_mode);
        }
        // check if the debug mode has been set for this session
        elseif ($session->get('debug_mode_override'))
        {
            // override the debug mode
            $this->set('server_debug_mode', $session->get('debug_mode_override'));
        }
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

    private function setEnvironment($debug_mode = false, $overwrite = false)
    {
        if (!empty($overwrite))
        {
            // if a custom environment has been passed or we're overwriting
            // the default handling of dev/prod, set the environment to that 
            $env  = $overwrite;
        }
        elseif ($_SERVER['SERVER_NAME'] == $this->get('server.prod_domain'))
        {
            // we're on the production server
            $env = 'prod';
        }
        else
        {
            // default to a dev environment
            $env = 'dev';
            
            // debug mode should always be enabled on dev
            $debug_mode = true;
        }

        // set the server environment property
        $this->set('server.environment', $env);

        // set the debug mode property
        $this->set('server.debug_mode', $debug_mode);

        // write debug log
        Logger::write('Environment set: ' . $env);
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
