<html>
<head>
<title>Highcharts</title>
   <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
   <script src="http://code.highcharts.com/highcharts.js"></script>
</head>
<body>
<div id="container" align= "left" style="width: 1000px; height: 250px; "></div>

<script language="JavaScript">
<?php
#$date = array('0727','0728','0729'); 
#$num = array('3','2','1');

  $doc = new DOMDocument();
  $doc->load( 'stats.xml' );
   
  $count = 0;
  $stats = $doc->getElementsByTagName( "stat" );
  foreach( $stats as $stat )
  {
  $count += 1;
  if($count < 30) {
  $date =  $stat->getAttribute("id");
  $num =  $stat->getAttribute("num");
  $string1 .= $date;  
  $string1 .= ',';  
  $string2 .= $num;  
  $string2 .= ','; 
  } else {
  break;
  } 
  }
#  echo "$string1";
#echo "$string2";
#$string1 =  '0727' . ',' . '0728' . ',' .'0729';
#$string2 =  '3' . ',' . '2' . ',' . '1';
echo "$(document).ready(function() { 
   var chart = {
       type: 'column'
       };

   var title = { 
       text: 'Usage Statistics'   
       }; 
   var xAxis = { 
      title: {
	   text: 'Date'
      },	      
   categories: [$string1],
   }; 
  var yAxis = {
      title: {
         text: 'Job Number'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   


   var plotOptions = {
      column: {
         pointPadding: 0.2,
         borderWidth: 0
      }
   };  
   var credits = {
      enabled: false
   };


 var series =  [
      {
         name: 'Job Number',
         data: [ $string2]
      }
   ]; 

   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };


  var json = {}; 

   json.chart = chart; 
   json.title = title;   
   json.xAxis = xAxis;
   json.yAxis = yAxis;  
   json.series = series;
   json.plotOptions = plotOptions;  
   json.credits = credits;
   json.legend = legend;


   $('#container').highcharts(json); 
});";
?>
</script>
</body>
</html>
