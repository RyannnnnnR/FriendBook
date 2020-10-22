<?php

class MySQLConnection {
    // Hard code values -- Environment variables best practice.
    const DB_USER = "s101106611";
    const DB_PASS = "101197";
    const DB_HOST = "feenix-mariadb.swin.edu.au";
    const DB_NAME = "s101106611_db";

    private $connection;


    public function __construct()
    {
        $this->connection = mysqli_connect(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);
    }

    public function execute($query){
        return mysqli_query($this->connection, $query);
    }

    public function getErrors() {
        if(mysqli_connect_error()){
            return mysqli_connect_error();
        }
        if(mysqli_error($this->connection)) {
           return mysqli_error($this->connection);
        }
        return null;
    }
    public function get($query, $mode = MYSQLI_ASSOC){
        $result = $this->execute($query);
        if (!$result) return null;
        $tmp = mysqli_fetch_all($result, $mode);
        mysqli_free_result($result);
        return $tmp;
    }
    public function closeConnection() {
        if($this->connection != null)
            mysqli_close($this->connection);
    }
}