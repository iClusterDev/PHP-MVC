<?php

  namespace App\Controllers;

  class Post extends \Core\Controller {

    public function __construct($routeParams) {
      parent::__construct($routeParams);
    }

    public function index() {
      echo 'hello from Post index';
    }

    public function addNew() {
      echo 'hello from Post addNew';
    }

    public function edit() {
      echo 'Route parameters <br>';
      echo '<pre>';
        htmlspecialchars(print_r($this->routeParams));
      echo '<pre>';
    }
  }