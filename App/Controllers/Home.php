<?php

  namespace App\Controllers;

  class Home extends \Core\Controller {

    public function __construct($routeParams) {
      parent::__construct($routeParams);
    }

    public function index() {
      echo 'hello from Home index';
    }
    
  }