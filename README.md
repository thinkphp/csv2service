csvtoservice
============
Is a PHP script to pull data from a CSV file on the web and turn it into a search and filter interface.

The parameters and options
-----------------------------

All you need to provide is a URL that points to a CSV file and the script does the rest.
You assign a variable to the main function that will get the HTML as properties.


     #PHP
     $myservice = csvtoservice('http://winterolympicsmedals.com/medals.csv');

The returned properties will be:

- $myservice['form'] the HTML form with all possible fields contained in the dataset.
- $myservice['table'] the data table of the information returned by the form submission.
- $myservice['query'] the data in raw JSON (for debugging).
- $myservice['json'] the YQL statement (for debugging).
