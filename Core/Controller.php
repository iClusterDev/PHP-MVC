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

  }