                <?php
		$data = "My Title, My introduction, My section introduction, My section content";
   		$gzdata = gzencode($data,9);
#                $content = str_split($gzdata,4);
		$content = array("My Title", "My introduction", "My section introduction", "My section content",);
	                                         $buffer_size = 4096;
		                        foreach ($content as $c) {
						                                echo str_pad( "<p>$c</p>", $buffer_size);
										                                ob_flush();
										                                flush();
	            	sleep(1);                 
                         }
                ?>
