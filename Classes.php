<?php

include 'connect.php';

class Object
/* Hauptobjekte:
 * 
 * Wohungen, Häuser
 * 
 */
{
    protected $database;
    private $id;
    private $name; //e.g. Wohnung 1
    protected $db_table = "main_objects";
    
    public function __construct( ){
        $year = date("Y");
        $this->database="Zieger_Miete_".$year;
    }

    // to create a new database entry:
    public static function create_db_entry( $name )
    { 
        echo "mah";
        $instance = new static();
        $instance->name=$name;
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
        $query="INSERT INTO `".$this->db_table."` VALUES ('','".$this->name."')";
        query($this->database,$query);
    }
    
    protected function read_from_db()
    { 
        $query="SELECT `name` FROM `".$this->db_table."` WHERE id=".$this->id."";
        $result = query($this->database,$query);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $this->name=$row[name];
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

}

class Sub_Object extends Object
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
    protected $db_table="sub_objects";
    
    // to create a new database entry:
    public static function create_db_entry( $main_id , $name )
    {
        $instance = new static();
        $instance->main_id=$main_id;
        $instance->name=$name;
        $instance->write_on_db();
        return $instance;
    }
    
    // override:
    protected function write_on_db()
    {
        $query="INSERT INTO `".$this->db_table."` VALUES ('','".$this->main_id."','".$this->name."')";
        query($this->database,$query);
    }
    
}
