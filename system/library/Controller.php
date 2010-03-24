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
            $this->config->get('templates.tpl'));
        foreach($search as $k => $v)
        {
            load::template($v . '.php');
        }
    }

    abstract public function index();
}

// EOF
