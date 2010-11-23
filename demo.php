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
thead th{background:#369;font-weight:bold;color:#fff;}

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
   <div id="hd" role="banner"><h1>Simplest example of csv2service</h1></div>
   <div id="bd" role="main">
<?php
include('csvtoservice.php');
$content = csvtoservice('http://winterolympicsmedals.com/medals.csv');
//if loaded and parsed then show me
if($content){
  if($content['form']) {
     echo$content['form'];  
  }
  if($content['table']) {
     echo$content['table'];  
  }
 }
?>
	</div>
   <div id="ft" role="contentinfo"><p>follow me @<a href="http://twitter.com/thinkphp">thinkphp</a> | return to <a href="index.php">index.php</a> | source on <a href="https://github.com/thinkphp/csv2service">GitHub</a> | <a href="demo.phps">demo.phps</a></p></div>
</div>
</body>
</html>