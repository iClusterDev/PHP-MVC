<?php

  namespace App\Controllers\Admin;

  // user controller
  // inherits from base controller
  class User extends \Core\Controller {

    // constructor
    public function __construct($routeParams) {
      parent::__construct($routeParams);
    }

    // indexAction
    public function indexAction() {
      echo 'Hello from Admin/User.php';
    }

    // before action filter
    protected function before() {
    }

    // after action folter
    protected function after() {
    }

  }