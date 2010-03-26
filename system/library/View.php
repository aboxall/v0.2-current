<?php
class View
{
    public $vars  = array(), $views = array();
    protected $viewss, $array, $files, $filename;

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

    public function frontRender()
    {
        extract($this->vars);
        if(self::is_multidimensional($this->views))
        {
            foreach($this->views as $view)
            {
                foreach($view as $viewss)
                {
                    $viewss = self::setPath($viewss);
                    if(self::fileExists($viewss))

                        require $viewss;
                }
            }
        }
        else
        {
            foreach($this->views as $view)
            {
                $view = self::setPath($view);
                if(self::fileExists($view))

                    require $view;
            }
        }
    }

    protected function is_multidimensional($array)
    {
        if(!is_array($array))
            throw new Exception('THE_PARSED_VALUES_ARE_NOT_ARRAY');
        else
        {
            $this->filter = array_filter($array, 'is_array');
            if(count($this->filter) > 0)
                return true;
            
        }
    }

    protected function setPath($files)
    {
        return $files = $this->config->get('view.view_dir') .
               $files . $this->config->get('view.view_ext');
    }

    protected function fileExists($filename)
    {
        if(!file_exists($filename))
            throw new Exception('VIEW_NOT_FOUND');
            
            return true;
    }
}