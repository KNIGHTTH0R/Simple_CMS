<?php
/*
  Głowny plik routingu
*/

class Routing {
  public static $default_controller = 'Default';

  static function check_controller($uri)
  {
    global $_BASE_PATH;

    // Jeżeli brak parametrów
    if(empty($uri)) return TRUE;

    // Sprawdzanie czy plik kontrolera instnieje
    if( ! file_exists($_BASE_PATH . 'src/Controllers/' . $uri[0] . '.php'))
    {
      return Array(FALSE, 'error' => 'Controller file doesn\'t exist');
    }

    // Ładowanie kontrolera oraz tworzenie obiektu
    require $_BASE_PATH . 'src/Controllers/' . $uri[0] . '.php';

    // Sprwdzanie czy klasa kontrolera została zadeklarowana z poprawną nazwą
    if( ! class_exists($uri[0]))
    {
      return Array(FALSE, 'error' => 'Controller class name doesn\'t exist');
    }

    if( ! isset($uri[1])) return TRUE;

    // Sprawdzanie czy metoda kontrolera istnieje
    if( ! method_exists($uri[0], $uri[1]))
    {
      return Array(FALSE, 'error' => 'Controller method name doesn\'t exist');
    }

    return TRUE;
  }

  static function get_route() 
  {
    //print_r(explode('/', $_SERVER['PATH_INFO'] . "/"));

    if(preg_match_all('/\w+/', $_SERVER['PATH_INFO'], $match) > 0)
    {
      return $match[0];
    }
    else
    {
      return Array();
    }


  }

  static function route()
  {

  }

  static function load_404()
  {

  }

  static function load_500()
  {

  }
}

?>
