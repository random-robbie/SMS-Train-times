<?php

// configuration
$dbtype = "mysql";
$dbhost = "localhost";
$dbname = "trains";
$dbuser  = "MYSQL USERNAME";
$dbpass  = "MYSQL PASSWORD";
$smskey = "YOUR KEYWORD";  // NOTE YOU MUST ADD A SPACE FOR THIS TO WORK
$station = ""; //Enter your local station name

// database connection
$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

//Train Station of Departure
$station = "Hoylake";
?>