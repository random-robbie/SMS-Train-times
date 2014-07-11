<?php

// configuration
$dbtype = "mysql";
$dbhost = "localhost";
$dbname = "trains";
$dbtable = "Trains";
$dbuser  = "MYSQL USERNAME";
$dbpass  = "MYSQL PASSWORD";
$station = ""; //Enter your local station name

// database connection
$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

// Google Drive CSV for train times URL
// SEE GIT HUB INSTRUCTIONS TO ALTER THIS CSV TO YOUR LOCAL STATION
$url  = 'https://docs.google.com/spreadsheet/pub?key=0AuC2xjBKqlYadDJ2TzJkdFh5Wi03Wlh5NmMtdDNOdHc&single=true&gid=0&output=csv';

//temp folder for the CSV
$tmpcsv = "/tmp/trains.csv";

// Textlocal account details
$username = urlencode('youremail@address.com');
$hash = urlencode('Your API hash');
$senderid = "MyTrainTime"; //Who the messsage to appear from
// 0 for test mode off will use credits and 1 for test mode on will get result from api but will not send.
$test = "0"; 

?>