<?php

  namespace Core;

  use App\Config;

  /**
   * Error/Exception handler class 
   */
  class Error {

    /**
     * converts any error into an exception
     * @param int $level: error severity
     * @param string $message: error message
     * @param string $file: lile name where error occurs
     * @param int $line: line number in the file
     * @return void
     */
    public static function errorHandler($level, $message, $file, $line) {
      if (error_reporting() !== 0) {
        throw new \ErrorException($message, 0, $level, $file, $line);
      }      
    }

    /**
     * exception handler
     * @param Exception $exception: the exception
     * @return void
     */
    public static function exceptionHandler($exception) {

      // error code is 404 (not found) or 500 (general server error)
      $errorCode = ($exception->getCode() === 404) ? 404 : 500;
      http_response_code($errorCode);


      if (Config::SHOW_ERRORS) {
        echo "<h1>Fatal Error</h1>";
        echo "<p>Uncaught Exception: " . get_class($exception) . "</p>";
        echo "<p>Message: '" . $exception->getMessage() . "'</p>";
        echo "<p>Stack Trace: <pre>" . $exception->getTraceAsString() . "</pre></p>";
        echo "<p>Thrown in: '" . $exception->getFile() . "' on line " . $exception->getLine() .  "</p>";
      }
      else {
        $message  = "Uncaught Exception: " . get_class($exception);
        $message .= "\nMessage: '" . $exception->getMessage();
        $message .= "\nStack Trace: " . $exception->getTraceAsString();
        $message .= "\nThrown in: '" . $exception->getFile() . "' on line " . $exception->getLine();

        $logFile = str_replace('\\', '/', dirname(__DIR__)) . '/Logs/' . date('Y-m-d') . '.txt';
        ini_set('error_log', $logFile);
        error_log($message);

        if ($errorCode === 404) {
          echo "<h1>Page not found</h1>";  
        }
        else {
          echo "<h1>An Error Occurred</h1>";
          echo "<p>Please try again later</p>";
        }
      }
    }

  }