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

