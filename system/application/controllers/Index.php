<?php

class IndexController extends Controller
{

    public function __construct()
    {
	   parent::__construct();

        try
        {
            $model = Load::model('Index');
        }
        catch (LoadException $e)
        {
            die($e->getMessage());
        }
    }

    public function index()
    {
        $this->view->head = 'Welcome from the ' . __CLASS__;
        $this->view->add('index');
    }
}
// EOF
