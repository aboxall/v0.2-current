<?php

abstract class Controller
{
    protected $view, $config;

    public function __construct()
    {
        $this->view = Load::library('View');
        $this->config = Load::library('Config');
    }

    final public function _draw()
    {
        $this->view->frontRender();
    }

    abstract public function index();
}

// EOF
