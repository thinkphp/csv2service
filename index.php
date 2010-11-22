<?php error_reporting(0); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>CSV to web service - creating a searchable web interface automatically  from CSV files with YQL</title>
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.8.0r4/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
   <style type="text/css">
html,body{background:#999;color:#000;}
#doc{background:#fff;border:1em solid #fff;-moz-border-radius:5px;}

form div{float:left;width:250px;padding-bottom:10px;}
form label{float:left;width:80px;font-weight:bold;}
form div#bar{clear:both;float:none;margin:1em 0;background:#a0f2c8;width:auto;padding:5px;text-align:right;}

table{width:100%;margin:1em 0;border:1px solid #ccc;border-collapse:collapse;}
th,td{border:1px solid #ccc;padding:5px;}
thead th{background:#69c;font-weight:bold;color:#fff;}

#yql{padding:1em;background:#eee;border:1px solid #999;-moz-border-radius:5px;}

h1{font-size:140%;font-weight:bold;color:#036;margin:.5em 0;}
h2{font-size:130%;font-weight:bold;color:#000;margin:.5em 0;}
h3{font-size:120%;font-weight:bold;color:#369;margin:.5em 0;border-bottom:2px solid #999}

pre{border:1px solid #999;padding:.5em;margin:1em 0;border:1px solid #999;background:#eee;-moz-box-shadow:2px 2px 2px rgba(33,33,33,.3);-moz-border-radius:5px;}
p{margin:1em 0} 
a{color:#333;}

#bd ul{margin-left:1em;}
#bd li{list-style:square;padding-bottom:.5em;}
#bd li code{font-weight:bold;color:#000;}

#ft{font-size:90%;text-align:left;margin:2em 0;}

   </style>
</head>
<body>
<!-- script rewritten and understood from heilmann -->
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1>csv2service (<a href="demo.php">demo</a> | <a href="demo-with-logging.php">with debugging</a> | <a href="fifa2010.php">fifa2010</a>)</h1></div>
   <div id="bd" role="main">
         <p>This script allows you to get any CSV file from the internet and turn it into a web interface that empowers users to search and filter data. It uses YQL to convert CVS resources to web interfaces.</p>
         <h2>#Example (Olimpic Winter Medals Salt Lake City 2002)</h2>
         <p>Simply, enter your search criteria in the appropriate field, then hit the search button and see the results, try it out!!!</p>
<?php
include('csvtoservice.php');
$content = csvtoservice('http://winterolympicsmedals.com/medals.csv',
     array(
           'filter' => array('eventgender','city'),
           'rename' => array('noc' => 'country'),
           'preset' => array('year'=> 2002),
           'prefill' => array('sport'=>'skiing',
                              'medal'=>'gold'),
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
?>       

   <h2>The code</h2>
   <p>The code search form and table result is powered by a simple dataset <a href="http://winterolympicsmedals.com/medals.csv">http://winterolympicsmedals.com/medals.csv</a>. All you need to convert it to what you see above is the following in your PHP documents: </p>
<pre><code>
include('csvtoservice.php');
$content = csvtoservice(&#x27;http://winterolympicsmedals.com/medals.csv&#x27;,
     array(
           &#x27;filter&#x27; => array(&#x27;eventgender&#x27;, &#x27;city&#x27;),
           &#x27;rename&#x27; => array(&#x27;noc&#x27; => &#x27;country&#x27;),
           &#x27;preset&#x27; => array(&#x27;year&#x27; => 2002),
           &#x27;prefill&#x27; => array(&#x27;sport&#x27; => &#x27;skiing&#x27;,
                              &#x27;medal&#x27; => &#x27;gold&#x27;),
           &#x27;uppercase&#x27; => true  
          )  
); 
if($content) {
   if($content[&#x27;form&#x27;]) {
      echo$content[&#x27;form&#x27;]; 
   }
   if($content[&#x27;table&#x27;]) {
      echo$content[&#x27;table&#x27;]; 
   }
} 
</code></pre>    

   <p>This is already a complex example, the simplest way to show a form and a result table for any CSV file is the following:</p>

<pre><code>
include('csvtoservice.php');
$content = csvtoservice(&#x27;http://winterolympicsmedals.com/medals.csv&#x27;);
if($content) {
   if($content[&#x27;form&#x27;]) {
      echo$content[&#x27;form&#x27;]; 
   }
   if($content[&#x27;table&#x27;]) {
      echo$content[&#x27;table&#x27;]; 
   }
} 
</code></pre>    
   <p>You can view in action <a href="demo.php">here</a></p>
<h2>The parameters and options</h2>
<p>In essence, all you need to provide is a URL that points to a CSV file and the script does the rest. You assign a variable to the main function that will get the HTML as properties. For example: </p>
<pre><code>
$myservice = csvtoservice('http://winterolympicsmedals.com/medals.csv');
</code></pre>
<p>The returned properties will be:</p>
<ul>
<li><code>$myservice['form']</code> - the HTML form with all possible fields contained in the dataset.</li>
<li><code>$myservice['table']</code> - the data table of the information returned by the form submission - this will only show up once the form is submitted.</li>
<li><code>$myservice['query']</code> - the data in raw JSON (for debugging)</li>
<li><code>$myservice['json']</code> - the YQL statement (for debugging)</li>
</ul>

<p>You can see all of the information in the example for <a href="demo-with-logging.php">logging</a></p>

<p>If you want to tweak the outcome of the form and the table and you want to change the data names or remove parts of it you can set an options array:</p>
<pre><code>
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
</code></pre>

<ul>
<li><code>filter</code> - contains an array of fields to not show in the form or the table. This allows you to get rid of some parts of the data.</li>
<li><code>rename</code> - allows you to rename fields. In the above example, the country who won the medals was defined as 'NOC', which makes sense, but reads much better as 'country'</li>
<li><code>preset</code> - is an array of fields to preset with a hard value.These fields will be part of the query of the data but will not be added to the form or displayed. This allows you to pre-filter the data. In the above example this was  the year of the games.</li>
<li><code>prefil</code> - is an array of fields to pre-fill the form with in case you want to give the end user a hint  what they can search for.</li>
<li><code>uppercase</code> - is a boolean value if the script should uppercase the first letter of the field name or not ('Country' instead of 'city')</li>
</ul>

   </div><!-- end bd -->
   <div id="ft" role="contentinfo"><p>follow me @<a href="http://twitter.com/thinkphp">thinkphp</a> | demo CSV file <a href="http://www.guardian.co.uk/news/datablog">Guardian Data Blog</a></p></div>
</div>
</body>
</html>
