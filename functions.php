<?php
include ('config.php');


function sms ($sender,$message)
{

                // Authorisation details.
                $uname = "YOUR TEXT LOCAL USERNAME";
                $hash = "YOUR TEXT LOCAL HASH";

                // Configuration variables. Consult http://www.txtlocal.co.uk/developers/ for more info.
                $info = "1";
                $test = "0";

                // Data for text message. This is the text message data.
                $from = "Trains"; // This is who the message appears to be from.
                // 612 chars or less
                // A single number or a comma-seperated list of numbers
                $message = urlencode($message);
                $data =
                "uname=".$uname."&hash=".$hash."&message=".$message."&from=".$from."&selectednums=".$sender."&info=".$info."&test=".$test;
                $ch = curl_init('http://www.txtlocal.com/sendsmspost.php');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch); // This is the result from the API
                curl_close($ch);

}

function debug ($message)
{
                        $fp = fopen("error.txt","a");
                        fwrite($fp,$message);
                        fclose($fp);
                        }
						
						
function downloaddue()
{					// SEE GIT HUB INSTRUCTIONS TO ALTER THIS CSV TO YOUR LOCAL STATION
					$url  = 'https://docs.google.com/spreadsheet/pub?key=0AuC2xjBKqlYadDJ2TzJkdFh5Wi03Wlh5NmMtdDNOdHc&single=true&gid=0&output=csv';
					$path = '/tmp/trains.csv';
 
					$download = curl_init($url);
					curl_setopt($download, CURLOPT_RETURNTRANSFER, true);
 
					$data = curl_exec($download);
 
					curl_close($download);
 
					file_put_contents($path, $data);
						
					}
					
					
function emptytable() 
{
				GLOBAL $dbh;
				$empty = $dbh->prepare('TRUNCATE TABLE  `Trains`');
				$empty->execute();
				}
				
function importdue()
{
				GLOBAL $dbh;
				$importduetimes = $dbh->prepare("LOAD DATA INFILE '/tmp/trains.csv' INTO TABLE `Trains` FIELDS TERMINATED BY ',' IGNORE 1 LINES;");
				$importduetimes->execute();
 
    		

}
				
function oldtrains()
{
		GLOBAL $dbh;
        $oldtrains = $dbh->prepare('DELETE  FROM `Trains` WHERE `due` < CURRENT_TIME');
		$oldtrains->execute();
						}
						
						
function nexttrain()
{
		GLOBAL $dbh;
        $nexttrain = $dbh->prepare("SELECT * FROM `Trains` WHERE `due` > CURRENT_TIME LIMIT 0 , 1 ");
		$nexttrain->execute();
		$result = $nexttrain->fetch(PDO::FETCH_ASSOC);
		$due = substr($result['Due'], 0, 5);
		$now = date('h:i');
		$d = (strtotime($now) - strtotime($due))/60;
		GLOBAL $message;
		$message = ("The next train to depart from ".$station." is ".$due." and is currently ".$result['Status']."");
		echo $message;
		
						}
						

?>