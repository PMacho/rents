<?php

class db_base extends PDO
{

    private $servername;

    private $username;

    private $password;

    public function __construct($database)
    /* 
    * Connect to database <database>.
    */ 
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "root";
        try {
            parent::__construct("mysql:host=$this->servername;dbname=$database", $this->username, $this->password);
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            // set PDO error mode to exception
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function query($query)
    /*
     * General query function, using prepared statements. 
     * 
     * Usage:
     * 
     *    // one line:
     *    $row=$result->fetch(PDO::FETCH_ASSOC);
     *    // multiple lines:
     *    while ($row=$result->fetch(PDO::FETCH_ASSOC))
     *    {
     *        //do things
     *    }
     */
    {
        $result = $this->prepare($query);
        $result->execute();
        
        return $result;
    }
}

class db_io extends db_base
{
    protected $db_table;
    protected $result;
    
    public function __construct($database,$db_table)
    {
        parent::__construct($database);
        $this->db_table=$db_table;
    }
    
    protected function write_on_db($row)
    {
        if (is_array($row))
        {
            foreach ($row as $s)
            {
                $string .= ",'".$s."'";
            }
        } else 
        {
            $string=",'".$row."'";
        }
        
        $query="INSERT INTO `".$this->db_table."` VALUES (''".$string.")";
        $this->query($query);
    }
    
    protected function read_from_db($what="*",$where="")
    {
        $where="" ? "" : " WHERE ".$where;
        $query="SELECT ".$what." FROM `".$this->db_table."`".$where;
        $this->result = $this->query($query);
    }
    
}

