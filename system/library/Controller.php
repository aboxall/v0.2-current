<?php

abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = Load::library('View');
    }

    final public function _draw()
    {
        $this->view->add('global/head');
        $this->view->add('global/header');
        $this->view->add('global/left');
        $this->view->add('global/right');
        $this->view->add('global/footer');
    }

    abstract public function index();
}

// EOF
