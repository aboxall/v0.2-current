<?php
class View
{
    public $vars  = array(), $views = array();

    public function __construct()
    {
        $this->config = Load::library('Config');
    }

    public function assign($name, $value)
    {
        $this->vars[$name] = $value;
    }

    public function add($view)
    {
        $this->views[] = $view;
    }

    public function replace()
    {
        extract($this->vars);
          $search = preg_replace("/controller/",
            $this->config->get('default.controller'),
            $this->config->get('view.tpl'));
        $this->merge = array_merge($this->views, $search);
        unset($this->merge[0]);
        foreach ($this->merge as $this->view)
        {
            include $this->config->get('view.view_dir') . $this->view . '.php';
        }
    }
}