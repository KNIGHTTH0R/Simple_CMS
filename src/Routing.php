<?php
/*
  Routing file
*/
require_once 'Controller.php';

class Routing {
  public static $default_controller = 'Default';

  static function check_controller($uri)
  {
    global $_BASE_PATH;

    // If input array is empty
    if(empty($uri)) Array(FALSE, 'error' => 'Empty route', 'error_id' => 1);

    // Checking if controller file exist
    $controller_path = $_BASE_PATH . 'src/Controllers/' . $uri['controller'] . '.php';

    if( ! file_exists($controller_path))
    {
      return Array(FALSE, 'error' => 'Controller file doesn\'t exist. Path: ' . $controller_path, 'error_id' => 2);
    }

    // Loading controller file
    require_once $controller_path;

    // Checking whether conroller class exist
    if( ! class_exists($uri['controller']))
    {
      return Array(FALSE, 'error' => 'Controller class name doesn\'t exist', 'error_id' => 3);
    }

    // Checking whether conroller class have selected method
    if( ! method_exists($uri['controller'], $uri['method']))
    {
      return Array(FALSE, 'error' => 'Controller method name doesn\'t exist. Method name: ' . $uri['method'], 'error_id' => 4);
    }

    return Array(TRUE, 'error' => '', 'error_id' => 0);
  }

  static function get_route()
  {
    //print_r(explode('/', $_SERVER['PATH_INFO'] . "/"));

    if(preg_match_all('/[^\/]+/', $_SERVER['REQUEST_URI'], $match) > 0)
    {

      // For nginx
      if($match[0][0] != 'index.php')
      {
        array_unshift($match[0], 'index.php');
      }

      $returned_value = Array(
        'complete_uri' => $match[0],
        'controller' => (!empty($match[0][1]))? $match[0][1] : 'Welcome.php',
        'method' => (!empty($match[0][2]))? $match[0][2] : 'start',
        'args' => array_splice($match[0], 3)
      );

      // Changing first letter to uppercase in name of controller class
      $returned_value['controller'][0] = strtoupper($returned_value['controller'][0]);

      return $returned_value;
    }
    else
    {
      return Array();
    }


  }

  static function route()
  {
    $uri = self::get_route();

    if(!empty($uri))
    {

      // Checking whether route is correct
      if(self::check_controller($uri)[0])
      {
        // Creating controller object
        $controller = new $uri['controller'];

        // Call specific method in controller
        call_user_func(Array($controller, $uri['method']),
                      ( isset($uri['args'][0]) )? $uri['args'][0] : NULL,
                      ( ! empty($uri['args']) )? $uri['args'] : NULL
        );
      }
      else
      {
        self::load_404();
      }

    }
    else
    {
      // Load 404 page
      self::load_404();
    }
  }

  static function load_404()
  {
    die('Simple_CMS: Error 404');
  }

  static function load_500()
  {
    die('Simple_CMS: Error 500');
  }
}

?>
