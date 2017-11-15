<?php

include 'connect.php';

class db_Object extends db_base
/* Generic object for interactions with mysql databases.
 * 
 * Parameter:
 *     database ... Database: defined in __construct
 *     db_table ... The database table: defined in the __construct of childs.   
 * 
 * Creation of database rows:
 *     db_Object::create_db_entry($row);
 * where row can be a single parameter or an array.
 * 
 * Access rows of the database:
 *     db_Object::access_db_entry($id);
 * where $id is the id of the row.
 * By default the $this->row variable is filled with the returned row, by $this->setter. The 
 * setter function can be overriden in child classes to access certain entries.
 * 
 */
{
    protected $database;
    private $id;
    protected $row;
    protected $db_table;
    
    public function __construct( ){
        $year = date("Y");
        $this->database="Zieger_Miete_".$year;
        parent::__construct($this->database);
    }

    // to create a new database entry:
    public static function create_db_entry( $row )
    { 
        $instance = new static();
        $instance->row=$row;
        $instance->write_on_db();
        return $instance;
    }
    
    // to open new object
    public static function access_db_entry( $id )
    {
        $instance = new static();
        $instance->id=$id;
        $instance->read_from_db();
        return $instance;
    }
   
    protected function write_on_db()
    {
        if (is_array($this->row))
        {
            foreach ($this->row as $s)
            {
                $string .= ",'".$s."'";
            }
        } else 
        {
            $string=",'".$this->row."'";
        }
        
        $query="INSERT INTO `".$this->db_table."` VALUES (''".$string.",'1')";
        $this->query($query);
    }
    
    protected function read_from_db()
    { 
        $query="SELECT * FROM `".$this->db_table."` WHERE id=".$this->id." AND active=1 ";
        $result = $this->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        array_shift($row);
        $this->setter($row);
    }
    
    protected function setter($row)
    {
        $this->row = $row;
    }

}

class Main_Object extends db_Object
/* Hauptobjekte:
 * 
 * Wohungen, Häuser
 * 
 */
{
    private $name;
   
    public function __construct()
    {
        parent::__construct();
        $this->db_table = "main_objects";
    }
    
    protected function setter($row)
    {
        $this->name = $row["name"];
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
}

class Sub_Object extends db_Object
/* Mietobjekte:
 * 
 * Zimmer in Wohungen, Wohnungen in Häusern
 * 
 * new parameter:
 *     main_id ... id of main object, the sub_object belongs to
 * 
 */
{
    private $main_id;
    private $name;
    
    public function __construct()
    {
        parent::__construct();
        $this->db_table = "sub_objects";
    }
    
    protected function setter($row)
    {
        $this->main_id = $row["main_id"];
        $this->name = $row["name"];
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
}

class tenant extends db_Object
/*
 *  Tenant basic information.
 */
{
    private $name;
    private $fName;
    
    public function __construct()
    {
        parent::__construct();
        $this->db_table = "tenants";
    }
    
    protected function setter($row)
    {
        $this->fName = $row["fName"];
        $this->name = $row["name"];
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->fName." ".$this->name;
    }
}