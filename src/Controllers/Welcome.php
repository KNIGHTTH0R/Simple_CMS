<?php

class Welcome extends Simple_Controller
{
  function czesc() {
    echo 'Witam';
  }

  function start() {
    $this->smarty->assign('page_name', 'default');

    $this->smarty->display('default_page.tpl');

    //echo "Default Page";
  }
}



?>
