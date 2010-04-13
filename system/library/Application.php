<?php

class Application
{
    protected $Uri, $Config, $Controller, $Method, $Draw;

    public function __construct()
    {
        $this->Uri    = Load::library('URI');
        $this->Config = Load::library('Config');

        $this->parseRoute();
    }

    protected function parseRoute()
    {
        // parse the route from the URL
        if (!empty($this->Uri->uri_parts))
        {
            $controller = $this->Uri->uri_parts[0];

            if (isset($this->Uri->uri_parts[1]))
            {
                $method = $this->Uri->uri_parts[1];
            }
        }

        // use default if no controller has been found
        if (empty($controller))
        {
            $controller = $this->Config->get('default.controller');
        }

        // use default if no method has been found
        if (empty($method))
        {
            $method = $this->Config->get('default.method');
        }

        // for controllers with multiple words in their name
        $controller = str_replace('-', ' ', $controller);

        // convert class name into expected casing
        $controller = ucwords($controller);

        // remove any spaces to give final controller name
        $controller = str_replace(' ', '', $controller);

        try
        {
            // init controller
            $this->Controller = Load::controller($controller);
        }
        catch (LoadException $e)
        {
            throw new Exception($e->getMessage());
        }

        // ensure method exists
        if (!method_exists($this->Controller, $method))
        {
            throw new Exception('404 error..');
        }

        // call the method
        $this->Method = call_user_func(array($this->Controller, $method));
        // call draw method
        $this->Draw = call_user_func(array($this->Controller, '_draw'));
    }
}

// EOF
