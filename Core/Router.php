<?php

  namespace Core;

  // NOTES
  // the Router decides which controller to use
  // based on the route coming from the URL
  // it contains a routing table where
  // every route is mapped to a controller and an action
  class Router {

    /*
    * Associative array of route () routing table
    * @var array 
    */
    protected $routes = array();


    /*
    * Parameters from the matched route
    * @var array 
    */
    protected $params = array();


    /*
    * Converts a string with hyphens to StudlyCaps
    * e.g. post-authors -> PostAuthors
    * @param string $string the string to convert
    * @return string
    */
    protected function toStudlyCaps($string) {
      return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }


    /*
    * Converts a string with hyphens to camelCase
    * e.g. post-authors -> postAuthors
    * @param string $string the string to convert
    * @return string
    */
    protected function toCamelCase($string) {
      return lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $string))));
    }


    /*
    * Add a route to the routing table
    * this converts a route into a regular expression.
    * optionally can pass a parameter array
    * @param string $route  The route URL
    * @param array  $params Parameters (controller, action)
    * @return void
    */
    public function add($route, $params = []) {
      $route = preg_replace('/\//', '\\/', $route);      
      $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
      $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?<\1>\2)', $route);
      $route = '/^' . $route . '$/i';
      $this->routes[$route] = $params;
    }


    /*
    * Get all the routes from the routing table
    * @return array
    */
    public function getRoutes() {
      return $this->routes;
    }


    /*
    * Matches the route to the routes in the routing table
    * checks the url against every added route in the router
    * if there's a match sets in the router params the controller, action and
    * any other parameter (e.g. id)
    * @param  string  $url  The route URL
    * @return boolean true if match, false otherwise
    */
    public function match($url) {
      foreach ($this->routes as $route => $params) {
        if (preg_match($route, $url, $matches)) {
          foreach ($matches as $key => $match) {
            if (is_string($key)) {
              $params[$key] = $match;
            }
          }
          $this->params = $params;
          return true;
        }
      }
      return false;
    }


    /*
    * Get the currently matched parameters
    * @return array
    */
    public function getParams() {
      return $this->params;
    }


    /*
    * dispatch the route to the corresponding controller and action
    * first removes the query string from the route stripQueryString()
    * then if match() returns true converts the controller name in studly caps (it's a class name)
    * and concatenates the namespace
    * if the controller class exists creates a new controller object passing the route parameters
    * converts the action (controller method) in camel case
    * if the action doesn't end with the "Action" suffix calls the method
    * else throws an exception
    * @param  string  $url  The route URL
    * @return void
    */
    public function dispatch($url) {

      $url = $this->stripQueryString($url);

      if ($this->match($url)) {
        $controller = $this->toStudlyCaps($this->params['controller']);
        $controller = $this->getNamespace() . $controller;
        if (class_exists($controller)) {
          $controllerObj = new $controller($this->params);
          $action = $this->toCamelCase($this->params['action']);
          if (preg_match('/Action$/i', $action) == 0) {
            $controllerObj->$action();
          }
          else {
            throw new \Exception("Method $action in controller $controller cannot be called directly. remove the Action suffix to call this method!");
          }
        }
        else {
          echo "Error (Router - match): class $controller doesn'n exists";
        }
      }
      else {
        echo 'Error (Router - match): URL not found';
      }
    }


    /*
    * removes the query string from URL
    * @param  string  $url  The route URL
    * @return string  $url the url without query string
    */
    protected function stripQueryString($url) {
      if ($url != '') {
        $parts = explode('&', $url, 2);
        if (strpos($parts[0], '=') === false) {
          $url = $parts[0];
        }
        else {
          $url = '';
        }
      }
      return $url;
    }

    /*
    * get the controller namespace passed optionally in the add() method
    * this option should be in $this->params (if passed)
    * @return string  $url the url without query string
    */
    protected function getNamespace() {
      $namespace = 'App\Controllers\\';
      if (array_key_exists('namespace', $this->params)) {
        $namespace .= $this->params['namespace'] . '\\';
      }
      return $namespace;
    }

  }