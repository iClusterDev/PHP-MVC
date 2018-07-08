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

  // namespace Root\Test;

  // class Test {
  //   private function add($num1, $num2) {
  //     echo $num1 + $num2 . '<br>';
  //   }

  //   public function __call($method, $args) {
  //     $this->before();
  //     call_user_func_array([$this, $method], $args);
  //     $this->after();
  //   }

  //   private function before() {
  //     echo 'Before<br>';
  //   }

  //   private function after() {
  //     echo 'After<br>';
  //   }
  // }

  // $test = new Test();
  // $test->add(1,5);

  // errors
  // can be triggered using the trigger_error
  // errors can be handled setting a function error handler and registering that function useing set_error_handler()

  // exceptions
  // when dealing with classes and objects
  // can be thrown -> throw new Exception(myException)
  // can be caught and dealt with using try catch blocks
  // can also register a exeption handler function using set_exception_handler(myFunction)

  // the esaiest way to handle errors and exceptions is to convert errors to exception and add an exception handler


