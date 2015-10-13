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
function foo() {
var checkbox01 = document.getElementsByName("checkbox01");

if(checkbox01[0].checked && checkbox01[1].checked) {
checkbox01[0].checked = false ;
var p = document.createElement("p");  
var tp = document.createTextNode("createTextNode"); 
p.appendChild(tp);
document.body.appendChild(p);
alert("only one box can be selected!");
}
}

function appendtxt(value){
        var div = document.createElement("div");
        div.innerText=value;            
        document.body.appendChild(div);
}       

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

<div class="row">
  <div class="col-lg-6">
    <div class="input-group">
      <div class="input-group-btn">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">11111 <span class="caret"></span></button>
        <ul class="dropdown-menu" role="menu">
          <li><a href="#"onclick="add(1)">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li class="divider"></li>
          <li><a href="#">5</a></li>
        </ul>
      </div><!-- /btn-group -->
      <input type="text" class="form-control" id="input1">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  <div class="col-lg-6">
    <div class="input-group">
      <input type="text" class="form-control">
      <div class="input-group-btn">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">222222 <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right" role="menu">
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li class="divider"></li>
          <li><a href="#">4</a></li>
        </ul>
      </div><!-- /btn-group -->
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
</body>
