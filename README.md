SMS-Train-times
===============

Get a SMS when the next train is due!

You need a textlocal account - 

You need to have a google account also to get the CSV.

The file will automatically download a CSV from google docs to get the information.

Currently it is set to my CSV for my local station West Kirby.

Create a new CSV on your google docs account and put this in the first row / col
```
=ImportHtml("http://ojp.nationalrail.co.uk/service/ldbboard/dep/WKI/LVC/To?ar=true"& year(now()) & month(now()) & day(now()) & hour(now()),"table",1)
```
change the WKI to your station code and then do the same for LVC for the trains destination once you have done this ensure you set the spreadsheet to public and capture the download link.

go to config.php and alter the below bits
```
$dbhost = "localhost";
$dbname = "trains";
$dbtable = "Trains";
$dbuser  = "MYSQL USERNAME";
$dbpass  = "MYSQL PASSWORD";
$station = ""; //Enter your local station name


// Google Drive CSV for train times URL
$url  = 'https://docs.google.com/spreadsheet/pub?key=0AuC2xjBKqlYadDJ2TzJkdFh5Wi03Wlh5NmMtdDNOdHc&single=true&gid=0&output=csv';

//temp folder for the CSV
$tmpcsv = "/tmp/trains.csv";

// Textlocal account details
$username = urlencode('youremail@address.com');
$hash = urlencode('Your API hash');
$senderid = "MyTrainTime"; //Who the messsage to appear from
// 0 for test mode off will use credits and 1 for test mode on will get result from api but will not send.
$test = "0"; 


```
Go to your textlocal account and point the incoming sms to your scripts location and then it will text you back the next train time!

Also do not forget to import trains.sql so that the mysql table can be created
