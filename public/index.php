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
  // echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] . '"';

/*
  Routing
*/
require '../core/Router.php';

$router = new Router();

// add the routes
$router->add('', [
  'controller' => 'Home', 
  'action' => 'index'
  ]
);

$router->add('posts', [
  'controller' => 'Posts', 
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

echo '<pre>';
  echo htmlspecialchars(print_r($router->getRoutes(), true));
echo '</pre>';

$url = $_SERVER['QUERY_STRING'];

if ($router->match($url)) {
  echo '<pre>';
  var_dump($router->getParams());
  echo '</pre>';
} 
else {
  echo 'url not found';
}


// regex:
// /abc/ -> contain
// /\w/ -> any character
// /\s/ -> space
// /\f/ -> number
// /^abc/ -> starts with abc
// /abc$/ -> ends with abc
// /a+bc/ -> at least one a
// /a*bc/ -> zero or more a
// /ab.de/ -> any char (letter number space etc..)
// /abd\./ -> if look for . must escape it
// /abc/i -> i to make the pattern case insensitive

// /ab[123]cd/ -> [123] is a character set: match ab2cd, match ab1cd, not match ab5cd
// /ab[123]+cd/ -> [123]+ is a character set with repetition operator: match ab13212cd, match ab1321132cd, not match ab5232cd
// /ab[1-5]cd/ -> [1-5] is a range: match ab3cd, match ab1cd, not match ab7cd
// /[a-z0-9 ]+/ -> at least one character, number or space

// /ab[^123]cd/ -> [^123] is a negate character set: not match ab2cd, not match ab1cd, match ab5cd
// /[^a-z]+/ -> negate range: no match "hello" - match "HELLO"
// /(?P<controller>^[a-z]+)\/(?P<action>[a-z]+$)/ -> named character set (use with preg_match())

// preg_match(regex, string, matchesArray)
// preg_replace(regex, replacement, string)

// $string = 'fabs 123';
// $regex = '/fs\s/';
// if (preg_match($regex, $string)) {
//   echo 'is a match';
// }
// else {
//   echo 'NOT a match';
// }

