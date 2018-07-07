<?php

  namespace App\Controllers;

  use \Core\View;

  // post controller
  // inherits from base controller
  class Post extends \Core\Controller {

    // constructor
    public function __construct($routeParams) {
      parent::__construct($routeParams);
    }

    // indexAction
    public function indexAction() {
      View::renderTemplate('Post/index.php');
    }

    // addNewAction
    public function addNewAction() {
      echo 'hello from Post addNew';
    }

    // editAction
    public function editAction() {
      echo 'Route parameters <br>';
      echo '<pre>';
        htmlspecialchars(print_r($this->routeParams));
      echo '<pre>';
    }

    // before action filter
    protected function before() {
    }

    // after action filter
    protected function after() {
    }
    
  }