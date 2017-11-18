<?php
include 'connect.php';
include 'helper_functions.php';

class db_Object extends db_io
/*
 * Generic object for interactions with mysql databases.
 *
 * Parameter:
 * database ... Database: defined in __construct
 * db_table ... The database table: defined in the __construct of childs.
 *
 * Creation of database rows:
 * db_Object::create_db_entry($row);
 * where row can be a single parameter or an array.
 *
 * Access rows of the database:
 * db_Object::access_db_entry($id);
 * where $id is the id of the row.
 * By default the $this->row variable is filled with the returned row, by $this->setter. The
 * setter function can be overriden in child classes to access certain entries.
 *
 */
{

    protected $id;

    protected $row;

    public function __construct($db_table)
    {
        $year = date("Y");
        $database = "Zieger_Miete_" . $year;
        parent::__construct($database, $db_table);
    }

    // to create a new database entry:
    public static function create_db_entry($row)
    {
        $instance = new static();
        $instance->row = $row;
        $instance->write_on_db($row);
        return $instance;
    }

    // to open new object
    public static function access_db_entry($id)
    {
        $instance = new static();
        $instances = array();
        $instance->read_from_db($what = "*", $where = $id);
        while ($instance->row = $instance->result->fetch(PDO::FETCH_ASSOC)) {
            if (isset($instance->row["id"])) {
                $instance->id = $instance->row["id"];
            }
            $instances[] = clone $instance;
        }
        
        return returner($instances);
    }

    /**
     *
     * @return mixed
     */
    public function getRow()
    {
        return $this->row;
    }

    public function getId()
    {
        return $this->id;
    }
}

class mainObject extends db_Object
/*
 * Hauptobjekte:
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
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->row["name"];
    }
    
    public function objects(){
        return subObject::access_db_entry("main_id=" . $this->id);
    }
}

class subObject extends db_Object
/*
 * Mietobjekte:
 *
 * Zimmer in Wohungen, Wohnungen in Häusern
 *
 * new parameter:
 * main_id ... id of main object, the sub_object belongs to
 *
 */
{

    public function __construct()
    {
        parent::__construct("sub_objects");
    }

    /**
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->row["name"];
    }

    public function tenant()
    {
        $contract = contract::access_db_entry("object_id=" . $this->id);
        $tenant = tenant::access_db_entry("id=" . $contract->getTenantId());
    }
}

class tenant extends db_Object
/*
 * Tenant basic information.
 */
{

    private $contracts;

    public function __construct()
    {
        parent::__construct("tenants");
    }

    /**
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->$this->row["name"];
    }

    public function getfName()
    {
        return $this->row["fName"];
    }

    public function contracts()
    {
        return contract::access_db_entry("tenant_id=" . $this->id);
    }
    
    public function objects()
    // returns all subObjects rented by tentant
    {
        $contracts = $this->contracts();
        foreach ($contracts as $contract) {
            $object = subObject::access_db_entry("id=" . $contract->getObjectId());
            $objects[] = clone $object;
        }
        return returner($objects);
    }
    
    public function payments()
    // returns all payments of selected year, of the actual tentant
    {
        $payments = payment::access_db_entry("tenant_id=" . $this->id);
        return $payments;
    }
}

class payment extends db_Object
{

    public function __construct()
    {
        parent::__construct("payments");
    }
}

class contract extends db_Object
{

    public function __construct()
    {
        parent::__construct("contracts");
    }
    
    protected function getTenantId()
    {
        return $this->row["tenant_id"];
    }

    protected function getObjectId()
    {
        return $this->row["object_id"];
    }
    
    public function getData()
    {
        $data=array();
        $data["rent"]=$this->row["rent"];       
        $data["deposit"]=$this->row["deposit"];
        $data["enter_date"]=$this->row["enter_date"];
        return $data;
    }
    
}