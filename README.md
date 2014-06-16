SMS-Train-times
===============

Get a SMS when the next train is due!

You need a textlocal account - 

You need to have a google account also to get the CSV.

The file will automatically download a CSV from google docs to get the information.

Currently it is set to my CSV for my local station West Kirby.

Create a new CSV on your google docs account and put this in the first row / col
```
=ImportHtml("http://ojp.nationalrail.co.uk/service/ldbboard/dep/wki?ar=true"& year(now()) & month(now()) & day(now()) & hour(now()),"table",1)
```
change the WKI to your station code and then once you have done this ensure you set the spreadsheet to public and capture the download link.

go to functions.php 

and alter the url for the CSV.

Go to your textlocal account and point the incoming sms to your scripts location and then it will text you back the next train time!

Also do not forget to import trains.sql so that the mysql table can be created
