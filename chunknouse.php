<?php
$data = "chunked+gzip test <br> <h3> haojue is great </h3> <br>";
$gzdata = gzencode($data, 9);
$chunk_array = $str_split($gzdata,5);
?>
