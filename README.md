csvtoservice
============
Is a PHP script to pull data from a CSV file on the web and turn it into a search and filter interface.

The parameters and options
-----------------------------

All you need to provide is a URL that points to a CSV file and the script does the rest.
You assign a variable to the main function that will get the HTML as properties.


##Usage

   #php
   $myservice = csvtoservice('http://winterolympicsmedals.com/medals.csv');
