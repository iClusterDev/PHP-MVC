<?php
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

  }