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

table{width:100%;margin:1em 0;border:1px solid #000;border-collapse:collapse;}
th,td{border:1px solid #ccc;padding:5px;}
thead th{background:#69c;font-weight:bold;color:#fff;}

#yql{padding:1em;background:#eee;border:1px solid #999;-moz-border-radius:5px;}

h1{font-size:140%;font-weight:bold;color:#036;margin:.5em 0;}
h2{font-size:130%;font-weight:bold;color:#000;margin:.5em 0;}
h3{font-size:120%;font-weight:bold;color:#369;margin:.5em 0;border-bottom:2px solid #999}

pre{border:1px solid #999;padding:.5em;margin:1em 0;border:1px solid #999;background:#eee;-moz-box-shadow:2px 2px 2px rgba(33,33,33,.3);-moz-border-radius:5px;}
p{margin:1em 0} 
a{color:#333;}

#ft{font-size:90%;text-align:left;margin:2em 0;}

   </style>
</head>
<body>
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1>csv2service - Logging and properties</h1></div>
   <div id="bd" role="main">
<?php
include('csvtoservice.php');
$content = csvtoservice('http://winterolympicsmedals.com/medals.csv',
     array(
           'filter' => array('eventgender','city'),
           'rename' => array('noc' => 'country'),
           'preset' => array('year'=>'2006'),
           'prefill' => array('medal'=>'gold'),
           'uppercase' => true
          )
);

//in the beggining was the void ergo all 
//is parsed then we have the content
if($content) {
 
   /* Show the form */
   if($content['form']) {
       echo'<h2>(Input) Filters:</h2>';
       echo$content['form'];  
   }

   /* Show the query for debugging */
   if($content['query']) {
       echo'<h2>YQL Query:</h2>';
       echo$content['query'];  
   }

   /* Show the table */
   if($content['table']) {
       echo'<h2>(Output) Results:</h2>';
       echo$content['table'];  
   }

   /* Display the JSON for debugging */
   if($content['json']) {
       echo'<h2>(Output JSON) Results:</h2>';
       echo$content['json'];  
   }
}
?>
	</div>
   <div id="ft" role="contentinfo"><p>follow me @<a href="http://twitter.com/thinkphp">thinkphp</a> | return to <a href="index.php">index.php</a> | source on <a href="https://github.com/thinkphp/csv2service">GitHub</a></p></div>
</div>
</body>
</html>
