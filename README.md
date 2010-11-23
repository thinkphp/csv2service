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

- **$myservice['form']** the HTML form with all possible fields contained in the dataset.
- **$myservice['table']** the data table of the information returned by the form submission.
- **$myservice['query']** the data in raw JSON (for debugging).
- **$myservice['json']** the YQL statement (for debugging).

If you want to tweak the outcome of the form and the table and you want to change the data names or remove parts of it 
you can set and options array:

     #PHP
     include('csvtoservice.php');
     $content = csvtoservice('http://winterolympicsmedals.com/medals.csv',
          array(
             'filter' => array(fieldnames),
             'rename' => array('field' => 'new field'),
             'preset' => array('field' => preset value),
             'prefill' => array('field1' => 'value1',
                                'field2' => 'value 2'),
             'uppercase' => Boolean            
          )  
     ); 

- **filter** contains an array of fields to not show in the form or the table. This allows you to get rid of some of the data.
- **rename** allows you to rename fields.
- **preset** is an array of fields to preset with a hard value. This fields will be part of the query of the data, but will not be added to the form or displayed. This allows you to pre-filter the data.
- **prefill** is an array of fields to pre-fill the form in case you want to give the end user a hint what they can search for.
- **uppercase** - is a boolean value if the script should uppercase the first letter of the field name or not ex:('Country' instead of 'country').


## Sample

    #PHP
    include('csvtoservice.php');
    $content = csvtoservice('http://winterolympicsmedals.com/medals.csv',
       array(
           'filter' => array('eventgender', 'city'),
           'rename' => array('noc' => 'country'),
           'preset' => array('year' => 2002),
           'prefill' => array('sport' => 'skiing',
                              'medal' => 'gold'),
           'uppercase' => true  
          )  
       ); 
    if($content) {
       if($content['form']) {
          echo$content['form']; 
       }
       if($content['table']) {
          echo$content['table']; 
       } 
    } 