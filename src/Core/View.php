<?php

class View
{
  private $show_view = TRUE;
  private $content;

  function __construct($view_content = NULL)
  {
    $content = $view_content;
  }

  function get()
  {
    $show_view = FALSE;

    return $content;
  }
  
}







 ?>
