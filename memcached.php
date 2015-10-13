    <?php  
    $memcache = new Memcache; //´´½¨һ¸öcache¶Ôó    
    $memcache->connect('localhost', 11211) or die ("Could not connect"); //l½Óemcached·þÎÆ  
    $memcache->set('key', 'test'); //ÉÖһ¸ö¿µ½Ä´æ£¬Ã³ÆÇey ֵÊtest  
    $get_value = $memcache->get('key'); //´Óڴæȡ³öµÄµ  
    echo $get_value;  
    ?>  
