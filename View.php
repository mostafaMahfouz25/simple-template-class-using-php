<?php 



class View 
{
    /**
     * 
     * vars for adding varibles to any tempalte 
     */
    private  $vars = array();

    /**
     * 
     * template file to view 
     */
    private  $template;

  
    /**
     * 
     * @param $template => name of file with full path  
     */
    public function render($template,$vars = array())
    {
        
        $this->vars = $vars;
        $template = trim($template);
        if($this->find_template(VIEWS.$template.'.php'))
        {
            // $this->template = $template;
            $this->template = VIEWS.$template.'.php';
            $this->render_template();
            
        }
        else 
        {
            die("this file <b>" . $template . "</b> :  is not exist !");
        }
    }

    /**
     * 
     * chaeck if file exists and if this variable is file 
     * @param $template => path of file 
     * 
     */
    private function find_template($template)
    {
        $found = false;
        if(is_file($template) && file_exists($template))
        {
            $found = true;
        }
        return $found;
    }

    /**
     * 
     * render file and pass varibles to this file 
     */
    private  function render_template()
    {
        extract($this->vars);
        ob_start();
        require_once($this->template);
        return ob_end_flush();
    }
}