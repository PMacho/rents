<?php

function connect($database)
/* 
 * Connect to database <database>.
 */ 
{
    $servername = "localhost";
    $username = "root";
    $password = "root";
    static $conn;
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}

function query($database, $sql)
/*
 * General query function, using prepared statements. 
 * 
 * Usage:
 * 
 *    $database="<databse>";
 *    $query="<query>";
 *    $result=query($database,$query);
 *    // one line:
 *    $row=$result->fetch(PDO::FETCH_ASSOC);
 *    // multiple lines:
 *    while ($row=$result->fetch(PDO::FETCH_ASSOC))
 *    {
 *        //do things
 *    }
 */
{
    $conn = connect($database);
    $query = $conn->prepare($sql);
    $query->execute();
    // $row=$query->fetch(PDO::FETCH_ASSOC);
    // print_r($row);
    return $query;
}