<?php
 

 class Page {
     private $each_disNums; 
     private $nums; //
     private $current_page; 
     private $sub_pages;
     private $pageNums; 
     private $page_array = array (); 
     private $subPage_link; 

     function Page($each_disNums, $nums, $current_page, $sub_pages, $subPage_link) {
         $this->each_disNums = intval($each_disNums);
         $this->nums = intval($nums);
         if (!$current_page) {
             $this->current_page = 1;
         } else {
             $this->current_page = intval($current_page);
         }
         $this->sub_pages = intval($sub_pages);
         $this->pageNums = ceil($nums / $each_disNums);
         $this->subPage_link = $subPage_link;
     }

     function __construct($each_disNums, $nums, $current_page, $sub_pages, $subPage_linke) {
         $this->Page($each_disNums, $nums, $current_page, $sub_pages, $subPage_link);
     }
 

     function __destruct() {
         unset ($each_disNums);
         unset ($nums);
         unset ($current_page);
         unset ($sub_pages);
         unset ($pageNums);
         unset ($page_array);
         unset ($subPage_link);
     }
 

     function initArray() {
         for ($i = 0; $i < $this->sub_pages; $i++) {
             $this->page_array[$i] = $i;
         }
         return $this->page_array;
     }
 

     function construct_num_Page() {
         if ($this->pageNums < $this->sub_pages) {
             $current_array = array ();
             for ($i = 0; $i < $this->pageNums; $i++) {
                 $current_array[$i] = $i +1;
             }
         } else {
             $current_array = $this->initArray();
             if ($this->current_page <= 3) {
                 for ($i = 0; $i < count($current_array); $i++) {
                     $current_array[$i] = $i +1;
                 }
             }
             elseif ($this->current_page <= $this->pageNums && $this->current_page > $this->pageNums - $this->sub_pages + 1) {
                 for ($i = 0; $i < count($current_array); $i++) {
                     $current_array[$i] = ($this->pageNums) - ($this->sub_pages) + 1 + $i;
                 }
             } else {
                 for ($i = 0; $i < count($current_array); $i++) {
                     $current_array[$i] = $this->current_page - 2 + $i;
                 }
             }
         }
 
        return $current_array;
     }
 

     function subPageCss1() {
         $subPageCss1Str = "";
         $subPageCss1Str .= "total" . $this->nums . "records";
         $subPageCss1Str .= "show per page" . $this->each_disNums;
         $subPageCss1Str .= "current" . $this->current_page . "/" . $this->pageNums . "page ";
         if ($this->current_page > 1) {
             $firstPageUrl = $this->subPage_link . "1";
             $prewPageUrl = $this->subPage_link . ($this->current_page - 1);
             var_dump($this->subPage_link);
 echo "<br>";
 echo "<br>";
 echo "<br>";
	     $subPageCss1Str .= "[<a href='$firstPageUrl'>first page</a>] ";
             $subPageCss1Str .= "[<a href='$prewPageUrl'> last page</a>] ";
         } else {
             $subPageCss1Str .= "[first page] ";
             $subPageCss1Str .= "[last page] ";
         }
 
        if ($this->current_page < $this->pageNums) {
             $lastPageUrl = $this->subPage_link . $this->pageNums;
             $nextPageUrl = $this->subPage_link . ($this->current_page + 1);
             $subPageCss1Str .= " [<a href='$nextPageUrl'>next page</a>] ";
             $subPageCss1Str .= "[<a href='$lastPageUrl'>final page</a>] ";
         } else {
             $subPageCss1Str .= "[next page] ";
             $subPageCss1Str .= "[final page] ";
         }
 
        return $subPageCss1Str;
 
    }
 

     function subPageCss2() {
         $subPageCss2Str = "";
         $subPageCss2Str .= "current" . $this->current_page . "/" . $this->pageNums ;
 
        if ($this->current_page > 1) {
             $firstPageUrl = $this->subPage_link . "1";
             $prewPageUrl = $this->subPage_link . ($this->current_page - 1);
             $subPageCss2Str .= "[<a href='$firstPageUrl'>first page</a>] ";
             $subPageCss2Str .= "[<a href='$prewPageUrl'>last page</a>] ";
         } else {
             $subPageCss2Str .= "[first page] ";
             $subPageCss2Str .= "[last page] ";
         }
 
        $a = $this->construct_num_Page();
         for ($i = 0; $i < count($a); $i++) {
             $s = $a[$i];
             if ($s == $this->current_page) {
                 $subPageCss2Str .= "[<span style='color:red;font-weight:bold;'>" . $s . "</span>]";
             } else {
                 $url = $this->subPage_link . $s;
                 $subPageCss2Str .= "[<a href='$url'>" . $s . "</a>]";
             }
         }
 
        if ($this->current_page < $this->pageNums) {
             $lastPageUrl = $this->subPage_link . $this->pageNums;
             $nextPageUrl = $this->subPage_link . ($this->current_page + 1);
             $subPageCss2Str .= " [<a href='$nextPageUrl'>next page</a>] ";
             $subPageCss2Str .= "[<a href='$lastPageUrl'>final page</a>] ";
         } else {
             $subPageCss2Str .= "[next page] ";
             $subPageCss2Str .= "[final page] ";
         }
         return $subPageCss2Str;
     }
 }
 

 $t = new Page(10, 100, $_GET['p'], 5, 'pagediv.php?p=');
 echo $t->subPageCss2();
 echo "<br>";
 echo $t->subPageCss1();
 ?>
