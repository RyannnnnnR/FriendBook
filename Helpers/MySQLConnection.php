<?php

class MySQLConnection {
    // Hard code values -- Environment variables best practice.
    const DB_USER = "s101106611";
    const DB_PASS = "101197";
    const DB_HOST = "feenix-mariadb.swin.edu.au";
    const DB_NAME = "s101106611_db";

    private static $instance;
    private $connection;


    public function __construct()
    {
//        $this->connection = mysqli_connect(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);
    }

    public static function getInstance() {
        if(self::$instance ==  null) {
            self::$instance = new MySQLConnection();
        }
        return self::$instance;
    }

    public function execute($query){
        mysqli_query($this->connection, $query);
    }

    public function closeConnection() {
        if($this->connection != null)
            mysqli_close($this->connection);
    }
}