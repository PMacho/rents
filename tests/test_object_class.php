<?php

require '../Classes.php';

//Main_Object::create_db_entry("Haus1");
//Sub_Object::create_db_entry([38, "Wohnung1"]);

$haus = mainObject::access_db_entry("id=1");
$wohnung = subObject::access_db_entry("id=2");

echo  $haus->getName() ;
echo  $wohnung->getName() ;

