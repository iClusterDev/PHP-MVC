<?php

  // notes: this is a base controller
  // every controller extends this class
  // the base controller is for passing the route parameters
  // to every controller
  // also every derived controller inherits action filters before() - after()
  // the magic method __call is for executing the action filters

  namespace Core;

  abstract class Controller {

    // route parameters
    protected $routeParams = [];

    // constructor - initialize the controller
    // with the route parameters
    public function __construct($params) {
      $this->routeParams = $params;
    }

    // magic method
    public function __call($name, $args) {
      $method = $name . 'Action';
      if (method_exists($this, $method)) {
        if ($this->before() !== false) {
          call_user_func_array([$this, $method], $args);
          $this->after();
        }
      }
      else {
        echo "Error Core\Controller: $method not found in controller" . get_class($this);
      }
    }

    // action filter to execute before 
    // the action method
    protected function before() {}

    // action filter to execute after 
    // the action method
    protected function after() {}

  }