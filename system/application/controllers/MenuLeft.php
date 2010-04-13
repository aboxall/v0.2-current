<?php
/**
 * Description of MenuLeft
 *
 * @author Bogdan Olteanu
 */
class MenuLeftController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = Load::model('MenuLeft');
    }

    public function index()
    {
        $row = $this->model->getMenu();
        $this->view->assign('region', $row);
        $this->view->add('global/left');
    }
}
?>
