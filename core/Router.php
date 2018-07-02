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
    * if there's a match sets the params to those from the matched route
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
    * @param  string  $url  The route URL
    * @return void
    */
    public function dispatch($url) {

      $url = $this->stripQueryString($url);

      if ($this->match($url)) {
        $controller = $this->toStudlyCaps($this->params['controller']);
        $controller = "App\Controllers\\$controller";
        if (class_exists($controller)) {
          $controllerObj = new $controller();
          $action = $this->toCamelCase($this->params['action']);
          if (is_callable([$controllerObj, $action])) {
            $controllerObj->$action();
          }
          else {
            echo "Error (Router - match): method $action in class $controller is not callable";
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

  }