<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class BlogController extends Controller
{
    public function __construct()
    {
	   parent::__construct();
           $this->session = Load::library('Session');
    }
    
    public function custom()
    {
        session_destroy();
        print_r($_SESSION);
        if($this->session->get('imo'))
        {
            $this->view->nop = 'This is a Custom view from ' . __CLASS__ . ' and method is ' . __METHOD__;
        }
        else
        {
            $this->view->nop = 'The session wasn\'t set';
        }
        $this->view->add('custom');
    }
    public function index() {
        $this->view->sd = 'Welcome from the ' . __CLASS__;
    }
}