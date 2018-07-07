<?php
  // NOTES
  // index.php is the front controller
  // every request doesn't map directly to individual scripts
  // every request goes trough the front controller (central entry point for all requests)
  // also the front controller handles everything common to every request (sessions etc.)
  // to make this possible the request path is coded into the query string
  // localhost/index.php?/home

/*
  Front Controller
*/
// template engine autoload
// and configuration
$root = str_replace('\\', '/', dirname(__DIR__));
require_once $root . '/Vendor/autoload.php';


// controllers autoload
// loads classes dynamically
// whenever the object of a class is instantiated
// the autoload requires the corresponding class 
spl_autoload_register(function ($class) {
  $root = str_replace('\\', '/', dirname(__DIR__));
  $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
  if (is_readable($file)) {
    require $root . '/' . str_replace('\\', '/', $class) . '.php';
  }
});


// router setup
// creates a new router and 
// adds the routes
$router = new Core\Router();
$router->add('', ['controller' => 'home', 'action' => 'index']);
$router->add('posts', ['controller' => 'posts', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);


// get the request url
$url = $_SERVER['QUERY_STRING'];


// dispatch the request to
// the right controller
$router->dispatch($url);
