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
        echo "Error - render: view file $viewFile not found";
      }
    }

  }