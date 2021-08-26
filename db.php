<?php 
  class DB {

    private static $host = 'localhost';
    private static $db_name = 'hyper';
    private static $username = 'hyper';
    private static $password = 'drcj8uurUrQdI3e';
    private static $conn = null;

    public static function connect() {
      try { 
        self::$conn = mysqli_connect(self::$host, self::$username, self::$password, self::$db_name);
        if (!self::$conn) {
            throw new Exception('MySQL Connection Database Error');
        }
    } catch(Exception $e) {
        echo $e->getMessage();
      }

      return self::$conn;
    }
  }