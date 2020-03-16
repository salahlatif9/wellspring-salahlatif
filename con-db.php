<?php

// OpenCon function is to connect to the database

function OpenCon()
 {
   $dbhost = "localhost";
   $dbuser = "root";
   $dbpass = "";
   $db = "wellspring";

 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

 return $conn;
 }

// CloseCon function to close the connection

function CloseCon($conn)
 {
 $conn -> close();
 }

?>
