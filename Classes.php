<?php

include 'connect.php';

class db_Object extends db_io
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
    protected $id;
    protected $row;
    
    
    public function __construct( $db_table ){
        $year = date("Y");
        $database="Zieger_Miete_".$year;
        parent::__construct($database,$db_table);
    }

    // to create a new database entry:
    public static function create_db_entry( $row )
    { 
        $instance = new static();
        $instance->row=$row;
        $instance->write_on_db($row);
        return $instance;
    }
    
    // to open new object
    public static function access_db_entry( $id )
    {
        $instance = new static();
        $instance->id=$id;
        $instance->read_from_db($what="*",$where="id=".$id);
        $instance->row = $instance->result->fetch(PDO::FETCH_ASSOC);
        array_shift($instance->row);
        return $instance;
    }

}

class Main_Object extends db_Object
/* Hauptobjekte:
 * 
 * Wohungen, Häuser
 * 
 */
{
    public function __construct()
    {
        parent::__construct("main_objects");
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->row["name"];
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
    
    public function __construct()
    {
        parent::__construct("sub_objects");
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->row["name"];
    }
    
}

class tenant extends db_Object
/*
 *  Tenant basic information.
 */
{
    public function __construct()
    {
        parent::__construct("tenants");
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->row["fName"]." ".$this->row["name"];
    }
}