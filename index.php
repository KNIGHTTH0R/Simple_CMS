<?php
/*
  Główny plik
*/

require_once 'vendor/autoload.php';

// Ścieżka do pliku index.php
$_CONFIG = Array(
  'default_controller' => 'Default'
);

$_BASE_PATH = './';

require $_BASE_PATH . 'src/Routing.php';

// Routing to expected controller and method
Routing::route();


?>
