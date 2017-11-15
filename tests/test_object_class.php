<?php

require '../Classes.php';

//Main_Object::create_db_entry("Haus1");
//Sub_Object::create_db_entry([38, "Wohnung1"]);

$haus = Main_Object::access_db_entry("id=1");
$wohnung = Sub_Object::access_db_entry("id=2");

echo  $haus->getName() ;
echo  $wohnung->getName() ;

