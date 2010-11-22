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

If you want to tweak the outcome of the form and the table and you want to change the data names or remove parts of it 
you can set and options array:

     #PHP
     include('csvtoservice.php');
     $content = csvtoservice(&#x27;http://winterolympicsmedals.com/medals.csv&#x27;,
          array(
             &#x27;filter&#x27; => array(fieldnames),
             &#x27;rename&#x27; => array(&#x27;field&#x27; => &#x27;new field&#x27;),
             &#x27;preset&#x27; => array(&#x27;field&#x27; => preset value),
             &#x27;prefill&#x27; => array(&#x27;field1&#x27; => &#x27;value1&#x27;,
                                          &#x27;field2&#x27; => &#x27;value 2&#x27;),
             &#x27;uppercase&#x27; => Boolean            
          )  
     ); 
