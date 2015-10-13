<html>
<head>
<title></title>
<script type="text/javascript">
function setCookie(name, value, expires, path, domain, secure) {
        var curCookie = name + "=" + escape(value) +
                ((expires) ? "; expires=" + expires.toGMTString() : "") +
                ((path) ? "; path=" + path : "") +
                ((domain) ? "; domain=" + domain : "") +
                ((secure) ? "; secure" : "")
        if ( (name + "=" + escape(value)).length <= 4000){
                document.cookie = curCookie
                }
        else
                if (confirm("Cookie exceeds 4KB and will be cut!"))
                        document.cookie = curCookie
}
function getCookie(name) {
        var prefix = name + "="
        var cookieStartIndex = document.cookie.indexOf(prefix)
        if (cookieStartIndex == -1)
                return null
        var cookieEndIndex = document.cookie.indexOf(";", cookieStartIndex + prefix.length)
        if (cookieEndIndex == -1)
                cookieEndIndex = document.cookie.length
        return unescape(document.cookie.substring(cookieStartIndex + prefix.length, cookieEndIndex))
}
function savecookie(){
         var cont=document.getElementById("te").value;
         if(cont){
         var data=new Date();
         data.setTime(data.getTime() + 1*24*3600*1000*1000); 
         setCookie("cont",cont,data);
         }
}

//window.onload=function(){
//    var cont=getCookie("cont");
//    if(cont) document.getElementById("te").value=cont;
// }
</script>
</head>
<body>
<?php
setcookie("cont", "trytrytry", time()+3600);
setcookie("cont", "trytrytry2", time()+3600);
?>
    <div >
       <input type=text id="te" ><input type=button value="save into cookie" id=cook onclick=savecookie() />
    </div>
 
</body>
</html>
