<?php
/**
 * Description of AdaugaTara
 *
 * @author hathor
 */
class AdaugaTaraController extends Controller
{
    protected $isempty = array();
    public function __construct()
    {
        parent::__construct();
        $this->form = Load::library('Validation');
        $this->model = Load::model('AdaugaTara');
    }

    public function index()
    {
        $this->view->add(array('administrator/adauga_tara'));
    }

    public function adaugatara()
    {
        if($this->form->isPost('submit'))
        {
            if($this->form->notEmpty('element_1'))
            {
                $isempty['tara'] = 'Campul Tara este gol';
                $this->view->assign('tara', $isempty);
            }
            if($this->form->notEmpty('element_2'))
            {
                $isempty['regiune'] = 'Campul Regiune este gol';
                $this->view->assign('regiune', $isempty);
            }
            if(count($isempty) < 1)
            {
                $this->model->InsertCountry(ucwords($this->form->getPost('element_1')));
                $this->model->InsertRegion(ucwords($this->form->getPost('element_1')), ucwords($this->form->getPost('element_2')));
            }
            else
            {
                
                $this->view->add(array('administrator/adauga_tara'));
            }
        }
    }
}
?>
