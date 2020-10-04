<?php


class QueryBuilder
{
    private $table;
    private $wheres;
    private $connection;
    private static $tokens = array("pk" => "PRIMARY KEY", "increment" => "AUTO_INCREMENT", "string" => "VARCHAR", 'nullable' => "NULL", "integer" => "INT");
    private $query;


    public function __construct($query, $table)
    {
        require_once('MySQLConnection.php');
        $this->connection = MySQLConnection::getInstance();
        $this->query = $query;
        $this->table = $table;
    }

    public static function table($table)
    {
        return new QueryBuilder(null, $table);
    }

    public static function create($table, $columns)
    {
        $query = "CREATE TABLE IF NOT  EXISTS $table (";
        $tmp = array();
        foreach ($columns as $column) {
            $column = self::processColumn($column);
            $tmp[] = implode(" ", $column);
        }
        $query .= implode(", ", $tmp) . ");";
        $query = strtr($query, self::$tokens);
        echo $query;
        return new QueryBuilder($query, null);
    }

    public function select($columns = ['*'])
    {
        $this->columns = $columns;
        return $this;
    }

    public function where($columns, $operator = null, $value = null, $boolean = 'and')
    {
        $this->wheres = $columns;
        return $this;
    }

    public function toString()
    {
        return $this->query;
    }

    public function execute()
    {
        $this->connection->execute($this->toString());
    }

    private function processColumn($column)
    {
        if (!in_array("nullable", $column)) array_push($column, "NOT NULL");
        return array_map(function ($v) {
            if (strpos($v, "string") !== false) {
                $split = explode('=', $v);
                if ($split[1] == null) {
                    $split[1] = 255;
                }
                return sprintf("string(%d)", $split[1]);
            }
            // Ignore keywords, we are gonna swap out later.
            return in_array($v, array_keys(self::$tokens)) ? $v : strtoupper($v);
        }, $column);
    }

}