<?php

class IndexController extends Controller
{

    public function __construct()
    {
	   parent::__construct();
           $this->session = Load::library('Session');
    }

    public function index()
    {
        $this->value = 'lol';
        $this->session->set('imo', $this->value);
        $this->session->set('lmo', 'imo');
        $this->view->issession = $this->session->get('imo');
        $this->view->head = 'Welcome from the ' . __CLASS__;
        $this->view->add('index');
    }

    public function custom()
    {
        //session_destroy();
        print_r($_SESSION);
        if($this->session->get('imo'))
        {
            $this->view->nop = $this->session->get('imo');//'This is a Custom view from ' . __CLASS__ . ' and method is ' . __METHOD__;
        }
        else
        {
            $this->view->nop = 'The session wasn\'t set';
        }
        $this->view->add('custom');
    }
}
// EOF
