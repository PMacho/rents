<?php

require '../Classes.php';

//$test=Object::create_db_entry("Haus1");
//$test2=Sub_Object::create_db_entry(1, "Wohnung1");

$haus = Object::access_db_entry(1);
$wohnung = Sub_Object::access_db_entry(2);

echo $haus->getName();
echo $wohnung->getName();
