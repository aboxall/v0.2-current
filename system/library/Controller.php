<?php

abstract class Controller
{
    protected $view;
    protected $config;

    public function __construct()
    {
        $this->view = Load::library('View');
        $this->config = Load::library('Config');
    }

    final public function _draw()
    {
        $search = preg_replace("/controller/",
            $this->config->get('default.controller'),
            $this->config->get('view.tpl'));
        foreach($search as $k => $v)
        {
            Load::view($v . $this->config->get('view.view_ext'));
        }
    }

    abstract public function index();
}

// EOF
