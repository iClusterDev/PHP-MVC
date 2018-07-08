<?php
  // NOTES
  // index.php is the front controller
  // every request doesn't map directly to individual scripts
  // every request goes trough the front controller (central entry point for all requests)
  // also the front controller handles everything common to every request (sessions etc.)
  // to make this possible the request path is coded into the query string
  // localhost/index.php?/home

/**
 * front controller
 */


/**
 * autoloader
 */
$root = str_replace('\\', '/', dirname(__DIR__));
require_once $root . '/Vendor/autoload.php';


/**
 * error and exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

// controllers autoload
// loads classes dynamically
// whenever the object of a class is instantiated
// the autoload requires the corresponding class 
// spl_autoload_register(function ($class) {
//   $root = str_replace('\\', '/', dirname(__DIR__));
//   $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
//   if (is_readable($file)) {
//     require $root . '/' . str_replace('\\', '/', $class) . '.php';
//   }
// });


/**
 * routing
 */
$router = new Core\Router();
$router->add('', ['controller' => 'home', 'action' => 'index']);
$router->add('post', ['controller' => 'post', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);


/**
 * dispatcher
 */
$url = $_SERVER['QUERY_STRING'];
$router->dispatch($url);
