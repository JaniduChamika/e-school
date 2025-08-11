<?php

class DB
{
      public static $dbms;
      public static function connect()
      {
            if (!isset($dbms)) {
                  DB::$dbms = new mysqli("localhost", "root", "password", "eschool", "3306");
            }
      }

      public static function iud($query)
      {
            DB::connect();
            DB::$dbms->query($query);
      }
      public static function search($query)
      {
            DB::connect();
            $resultset =  DB::$dbms->query($query);
            return $resultset;
      }
}

