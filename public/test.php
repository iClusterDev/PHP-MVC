<?php
  $string = '{controller}/{id:\d+}/{action}';

  $string = preg_replace('/\//', '\\/', $string);

  echo $string . '<br>';

  $string = preg_replace('/\{([a-z]+)\}/', '(?<\1>[a-z-]+)', $string);

  $string = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?<\1>\2)', $string);

  echo htmlspecialchars(print_r($string, true));
  