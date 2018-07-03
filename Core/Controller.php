<?php

  // notes: this is a base controller
  // every controller extends this class
  // the base controller is for passing the route parameters
  // to every controller

  namespace Core;

  abstract class Controller {

    protected $routeParams = [];

    public function __construct($params) {
      $this->routeParams = $params;
    }

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

    // action filters
    protected function before() {}

    protected function after() {}

  }