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
      // echo 'hello from Home index';
      View::render('Home/index.php', $data = array(
        'name' => 'Fabio',
        'colors' => [
          'red' => 'red',
          'blue' => 'blue',
          'green' => 'green'
        ]
      ));
    }

    // before action filter
    protected function before() {
    }

    // after action filter
    protected function after() {
    }
    
  }