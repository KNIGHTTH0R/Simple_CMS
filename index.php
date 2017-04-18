<?php
/*
  Główny plik
*/

// Ścieżka do pliku index.php
$_CONFIG = Array(
  'default_controller' => 'Default'
);

$_BASE_PATH = './';

require $_BASE_PATH . 'src/Routing.php';
Routing::route();

//print_r(Routing::check_controller('test'));

//print_r($_SERVER);

print_r(Routing::get_route());
?>
