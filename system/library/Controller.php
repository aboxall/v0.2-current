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
        $this->view->replace();
    }

    abstract public function index();
}

// EOF
