<?php

class Simple_controller
{
  public $smarty = NULL;

  function __construct() {
    global $_BASE_PATH;

    $this->smarty = new Smarty();

    $this->smarty->setTemplateDir($_BASE_PATH . 'src/Views');
    $this->smarty->setCompileDir($_BASE_PATH . 'src/Views/Smarty/Compile_dir');
    $this->smarty->setCacheDir($_BASE_PATH . 'src/Views/Smarty/Cache');
    $this->smarty->setConfigDir($_BASE_PATH . 'src/Views/Smarty/Config');
  }

  protected function get_view_path($view_file)
  {
    global $_BASE_PATH;

    return $_BASE_PATH . 'src/Views/' . $view_file;
  }
}



?>
