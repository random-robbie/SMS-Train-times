<?php
// SMS Train Times
// By Robert Wiggins
// For use with textlocal.com API
// Donate something via paypal txt3rob@gmail.com

// functions Include
include ('functions.php');
include ('config.php');

// Post Data
$sender2 = $_REQUEST["sender"];
$content2 = $_REQUEST["content"];


if (time()-filemtime('/tmp/trains.csv') > 1 * 3600) {
  emptytable();
  downloaddue();
  importdue();
  oldtrains();
  nexttrain();
  

  
} else {
   oldtrains();
   nexttrain();
   sms ($sender2,$message);
}


?>


