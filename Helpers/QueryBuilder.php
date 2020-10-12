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
        $query =  "SELECT %s FROM $table";
        return new QueryBuilder($query, $table);
    }

    public static function create($table, $columns)
    {
        $query = "CREATE TABLE IF NOT  EXISTS $table (";
        $tmp = array();
        foreach ($columns as $key => $column) {
            $column = self::processColumn($key, $column);
            $tmp[] = implode(" ", $column);
        }
        $query .= implode(", ", $tmp) . ");";
        $query = strtr($query, self::$tokens);
        return new QueryBuilder($query, null);
    }

    public function select($columns = ['*'])
    {
        $this->query = sprintf($this->query, implode($columns, ","));
        return $this;
    }

    /**
     *
     * @param $columns
     * @param null $operator
     * @param null $value
     * @param string $condition
     * @return $this
     * @throws Exception
     */
    public function where($columns, $operator = null, $value = null, $condition = 'AND')
    {
        if(strpos($this->query, "SELECT") !== 0) throw new Exception("Cannot call where on non select queries");
        $query = "";
        if (is_array($columns)) {
            foreach ($columns as $key => $value) {
                $query .= strpos($this->query, "WHERE") === false ? " WHERE ". implode($value, " ") : "$key $columns $operator $value";;
            }
        } else {
            $query = strpos($this->query, "WHERE") === false ? " WHERE $columns $operator $value" :" $condition $columns $operator $value";;
        }
        $this->query .= $query;
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

    public function get()
    {
        $this->connection->get();
    }

    private function processColumn($key, $column)
    {
        array_unshift($column, $key);
        if (!in_array("nullable", $column)) {
            array_push($column, "NOT NULL");
        }
        // This doesn't scale very well.
        return array_map(function ($v) use($key) {
            if ($v == $key) {
                return  sprintf("`%s`",$v);
            }
            else if ($v == 'increment') {
                return 'integer '.$v;
            }
            else if (strpos($v, "string") !== false) {
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