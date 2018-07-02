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

/*
  Controllers
*/
// require '../app/controllers/Post.php';

spl_autoload_register(function ($class) {
  echo 'called:' . $class . '<br>';
  $root = dirname(__DIR__);
  $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
  if (is_readable($file)) {
    require $root . '/' . str_replace('\\', '/', $class) . '.php';
  }
});

/*
  Routing
*/
// require '../core/Router.php';

$router = new Core\Router();

$router->add('', [
  'controller' => 'home', 
  'action' => 'index'
  ]
);

$router->add('posts', [
  'controller' => 'posts', 
  'action' => 'index'
  ]
);

// $router->add('posts/new', [
//   'controller' => 'Posts',
//   'action' => 'new'
//   ]
// );

$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}');
$router->add('admin/{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}/{id:\d+}');

// echo '<pre>';
//   echo htmlspecialchars(print_r($router->getRoutes(), true));
// echo '</pre>';

$url = $_SERVER['QUERY_STRING'];

// if ($router->match($url)) {
//   $params = $router->getParams();
//   echo '<pre>';
//     var_dump($params);
//   echo '</pre>';
// } 
// else {
//   echo 'url not found';
// };

$router->dispatch($url);
