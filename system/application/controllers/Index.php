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
        $this->view->head = 'Lol';
    }

    public function custom()
    {
    }
}
// EOF
