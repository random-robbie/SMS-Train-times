<?php
include ('config.php');


function sms ($sender,$message)
{

                
	GLOBAL $username;
	GLOBAL $hash;
	GLOBAL $senderid;
	GLOBAL $test;
	// Message details
	$numbers = urlencode($sender);
	$sender2 = urlencode($senderid);
	$message2 = urlencode($message);
 
	// Prepare data for POST request
	$data = 'username=' . $username . '&hash=' . $hash . '&test=' . $test .'&numbers=' . $numbers . "&sender=" . $sender2 . "&message=" . $message2 ;
 
	// Send the GET request with cURL
	$ch = curl_init('http://api.txtlocal.com/send/?' . $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	echo "<br><br>".$response."";

}

function debug ($message)
{
                        $fp = fopen("error.txt","a");
                        fwrite($fp,$message);
                        fclose($fp);
                        }
						
						
function downloaddue()
{					GLOBAL $url;
					GLOBAL $tmpcsv;

 
					$download = curl_init($url);
					curl_setopt($download, CURLOPT_RETURNTRANSFER, true);
 
					$data = curl_exec($download);
 
					curl_close($download);
 
					file_put_contents($tmpcsv, $data);
						
					}
					
					
function emptytable() 
{
				GLOBAL $dbh;
				GLOBAL $dbtable;
				$empty = $dbh->prepare('TRUNCATE TABLE  ".$dbtable."');
				$empty->execute();
				}
				
function importdue()
{
				GLOBAL $dbh;
				GLOBAL $dbtable;
				GLOBAL $tmpcsv;
				$importduetimes = $dbh->prepare("LOAD DATA INFILE '".$tmpcsv."' INTO TABLE ".$dbtable." FIELDS TERMINATED BY ',' IGNORE 1 LINES;");
				$importduetimes->execute();
 
    		

}
				
function oldtrains()
{
		GLOBAL $dbh;
		GLOBAL $dbtable;
        $oldtrains = $dbh->prepare('DELETE  FROM ".$dbtable." WHERE `due` < CURRENT_TIME');
		$oldtrains->execute();
						}
						
						
function nexttrain()
{
		GLOBAL $dbh;
		GLOBAL $station;
		GLOBAL $dbtable;
        $nexttrain = $dbh->prepare("SELECT * FROM ".$dbtable." WHERE `due` > CURRENT_TIME LIMIT 0 , 1 ");
		$nexttrain->execute();
		$result = $nexttrain->fetch(PDO::FETCH_ASSOC);
		$iflate = $result['Status'];
		if ($iflate == "On time")
		{
		$status = "On Time";
		} else {
		$status = "Is expected at ".$result['Status']."";
		}
		$due = substr($result['Due'], 0, 5);
		$now = date('h:i');
		$d = (strtotime($now) - strtotime($due))/60;
		GLOBAL $message;
		$message = ("The next train to depart from ".$station." is ".$due." and is currently ".$status."");
		echo $message;
		
						}
						

?>