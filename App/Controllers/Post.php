<?php

  namespace App\Controllers;

  class Post extends \Core\Controller {

    public function __construct($routeParams) {
      parent::__construct($routeParams);
    }

    public function indexAction() {
      echo 'hello from Post index';
    }

    public function addNewAction() {
      echo 'hello from Post addNew';
    }

    public function editAction() {
      echo 'Route parameters <br>';
      echo '<pre>';
        htmlspecialchars(print_r($this->routeParams));
      echo '<pre>';
    }

    protected function before() {
      echo '(before) ';
    }

    protected function after() {
      echo ' (after)';
    }
    
  }