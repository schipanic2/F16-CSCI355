<?php

class Database
{
    private static $dbName = 'my_schipanic2' ;
    private static $dbHost = 'daytona.birdnest.org' ;
    private static $dbUsername = 'my.schipanic2';
    private static $dbUserPassword = 'goldfish1';
    private static $cont;
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( 'mysql:host='.self::$dbHost.';'.'dbname='.self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>