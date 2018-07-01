<?php
  // regular expressions
  // -------------------
  // /abc/ -> contain
  // /\w/ -> any character
  // /\s/ -> space
  // /\f/ -> number
  // /^abc/ -> starts with abc
  // /abc$/ -> ends with abc
  // /a+bc/ -> at least one a
  // /a*bc/ -> zero or more a
  // /ab.de/ -> any char (letter number space etc..)
  // /abd\./ -> if look for . must escape it
  // /abc/i -> i to make the pattern case insensitive

  // /ab[123]cd/ -> [123] is a character set: match ab2cd, match ab1cd, not match ab5cd
  // /ab[123]+cd/ -> [123]+ is a character set with repetition operator: match ab13212cd, match ab1321132cd, not match ab5232cd
  // /ab[1-5]cd/ -> [1-5] is a range: match ab3cd, match ab1cd, not match ab7cd
  // /[a-z0-9 ]+/ -> at least one character, number or space

  // /ab[^123]cd/ -> [^123] is a negate character set: not match ab2cd, not match ab1cd, match ab5cd
  // /[^a-z]+/ -> negate range: no match "hello" - match "HELLO"
  // /(?P<controller>^[a-z]+)\/(?P<action>[a-z]+$)/ -> named character set (use with preg_match())

  // preg_match(regex, string, matchesArray)
  // preg_replace(regex, replacement, string)

  // $string = 'fabs 123';
  // $regex = '/fs\s/';
  // if (preg_match($regex, $string)) {
  //   echo 'is a match';
  // }
  // else {
  //   echo 'NOT a match';
  // }


  // $string = '{controller}/{id:\d+}/{action}';

  // $string = preg_replace('/\//', '\\/', $string);

  // echo $string . '<br>';

  // $string = preg_replace('/\{([a-z]+)\}/', '(?<\1>[a-z-]+)', $string);

  // $string = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?<\1>\2)', $string);

  // echo htmlspecialchars(print_r($string, true));

  // strings conversion
  $string = 'posts-authors';

  // echo $string;

  // echo ucwords($string);

  echo lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $string))));
  