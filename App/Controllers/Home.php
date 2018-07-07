<?php

  namespace App\Controllers;

  use \Core\View;

  // home controller
  // inherits from base controller
  class Home extends \Core\Controller {

    // constructor
    public function __construct($routeParams) {
      parent::__construct($routeParams);
    }

    // indexAction
    public function indexAction() {
      View::renderTemplate('Home/index.php', $data = array(
        'name' => 'Fabio',
        'colors' => ['red', 'green', 'blue']
      ));
    }

    // before action filter
    protected function before() {
    }

    // after action filter
    protected function after() {
    }
    
  }