<?php
    $books=new DOMDocument();
    $books->load("books.xml");
$bookElements=$books->getElementsByTagName('book');

    foreach($bookElements as $book){
        foreach ($book->attributes as $attr) {
            echo strtoupper($attr->nodeName).'----'.$attr->nodeValue.'<br/>';
        }
        echo "AUTHOR: ";
        foreach ($book->getElementsByTagName('author') as $author) {
            echo $author->nodeValue.'&emsp;';
        }
        echo '<br/><br/>';
    }

?>
