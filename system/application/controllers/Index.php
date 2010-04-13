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
        $this->view->assign('lol', 'Raw Data');
        $this->view->add(array('global/head', 'global/header', 'global/left', 'index', 'global/right', 'global/footer'));
    }
}
