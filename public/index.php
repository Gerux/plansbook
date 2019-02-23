<?php
require '../vendor/autoload.php';

// Twig_Autoloader::register();

$url = $_SERVER["QUERY_STRING"];
$router = new Core\Router();
$router->addRoutes("", ["PointsController", "index"]);
$router->addRoutes("routines", ["RoutinesController", "index"]);
$router->addRoutes("add-daily", ["RoutinesController", "addRoutine"]);

$router->dispatch($url);


