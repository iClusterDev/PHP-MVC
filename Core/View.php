<?php

  namespace Core;

  class View {

    public static function render($viewFile, $args = []) {

      // extract $args into individual variables
      // if there's a collision don't overwrite variable
      extract($args, EXTR_SKIP);

      // IMPROV: can add the functionality to choose the views folder in a flexible way
      // if no option is provided the view will default to
      // ../App/Views
      $view = "../App/Views/$viewFile";
      if (is_readable($view)) {
        require $view;
      }
      else {
        throw new \Exception("view file $viewFile not found");
      }
    }


    public static function renderTemplate($template, $args = []) {

      static $twig = null;

      

      if ($twig === null) {
        $loader = new \Twig_Loader_Filesystem(dirname(str_replace('\\', '/', __DIR__)) . '/App/Views');
        $twig = new \Twig_Environment($loader);
      }

      echo $twig->render($template, $args);
    }

  }