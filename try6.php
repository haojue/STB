<html>                                                                                                                                                                                                                       
<head>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js">
</script>

<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
</script>
<link rel="stylesheet" type="text/css" href="mystyle.css" />
   <title>Scenario Testing Builder</title>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script> 

        <link rel="stylesheet" type="text/css" href="js/easyui.css">
        <link rel="stylesheet" type="text/css" href="js/icon.css">
        <link rel="stylesheet" type="text/css" href="js/demo.css">
   <script type="text/javascript" src="js/jquery-1.6.min.js"></script>                                                                                   
   <script type="text/javascript" src="js/jquery.easyui.min.js"></script>
<script>

function add(val) {
   //  alert();
var input1 = document.getElementById("input1");
    input1.value = val;
}	

</script>
</head>

<body>
<?php include 'navigator.php'; ?>
<br>
<br>

<a href="https://github.com/haojue">  
<img style="position: absolute; top: 0; right: 0; border: 0;" 
    src="https://camo.githubusercontent.com/e7bbb0521b397edbd5fe43e7f760759336b5e05f/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f677265656e5f3030373230302e706e67" 
    alt="Fork me on GitHub" 
    data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_green_007200.png">
</a>

<div class="row">
  <div class="col-lg-6">
    <div class="input-group">
      <div class="input-group-btn">
<button type="button" data-toggle="dropdown"> Test tcl name <span class="caret"></span></button>

	<ul class="dropdown-menu" role="menu">
<?php
  $doc = new DOMDocument();
  $doc->load( 'stats.xml' );

  $stats = $doc->getElementsByTagName( "test" );
  foreach( $stats as $stat )
  {
  $num =  $stat->getAttribute("name");
      echo  "<li onclick='add(\"$num\")'>" ."$num" . "</li>"; 
  }
  ?>
      <!--  <li onclick=add("t1222")>t1222 </li> -->
	</ul>
      </div><!-- /btn-group -->
      <input type="text"  id="input1">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
</body>
