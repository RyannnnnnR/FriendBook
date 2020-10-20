<?php


class QueryBuilder
{
    private $table;
    private $connection;
    private static $tokens = array("pk" => "PRIMARY KEY", "increment" => "AUTO_INCREMENT", "string" => "VARCHAR", 'nullable' => "NULL", "integer" => "INT");
    private $query;


    public function __construct($query, $table)
    {
        require_once('MySQLConnection.php');
        $this->connection = new MySQLConnection();
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
        $query = "SELECT %s FROM $this->table";
        $this->query = sprintf($query, implode($columns, ","));
        return $this;
    }

    public function insert($data, $ignore = false)
    {
        $query = "INSERT". ($ignore ? " IGNORE ": ""). " INTO $this->table (%s) VALUES (%s)";
        $columns = [];
        $values = [];
        foreach ($data as $key => $value){
            $columns[] = $key;
            $values[] = "'".$value."'";
        }
        $this->query = sprintf($query, implode($columns, ","), implode($values, ","));
        return $this;
    }

    public function delete() {
        $this->query = "DELETE FROM $this->table";
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
        if(strpos($this->query, "SELECT") !== 0 && strpos($this->query, "DELETE") !== 0) throw new Exception("Cannot call where on non select or delete queries");
        $query = "";
        if (is_array($columns)) {
            foreach ($columns as $key => $value) {
                $query .= (strpos($query, "WHERE") === false) ? " WHERE ". implode($value, " ") : " ".(is_numeric($key) ? $condition : $key)." ". implode($value, " ");
            }
        } else {
            $query = (strpos($this->query, "WHERE") === false) ? " WHERE $columns $operator $value" :" $condition $columns $operator $value";
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
        return $this->connection->get($this->toString());
    }

    public function toUsers() {
        include_once ('models/User.php');
        $arr = $this->get();
        $users = [];
        foreach ($arr as $data) {
            $users[] =  new User($data['friend_id'],
                $data['friend_email'], $data['password'], $data['profile_name'],
                $data['date-started'], $data['num_of_friends']);
        }
        return $users;
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