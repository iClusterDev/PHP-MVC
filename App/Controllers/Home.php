<?php

  namespace App\Controllers;

  class Home extends \Core\Controller {

    public function __construct($routeParams) {
      parent::__construct($routeParams);
    }

    public function indexAction() {
      echo 'hello from Home index';
    }

    protected function before() {
      echo '(before) ';
    }

    protected function after() {
      echo ' (after)';
    }
    
  }