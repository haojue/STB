#!/usr/bin/perl
use XML::DOM;

my $parser = new XML::DOM::Parser;
my $dom = $parser->parsefile("book.xml");
#my $book = $dom->getElementsByTagName("Book");
#my @chapter = $dom->getElementsByTagName("Chapter");

my $book = $dom->createElement("Book");
$book->setAttribute("title", "My First Book");
$book->setAttribute("author", "charlee");
my $chapter = $dom->createElement("Chapter");
$chapter->setAttribute("id", "1");
my $title = $dom->createTextNode("My First Chapter");
$chapter->appendChild($title);
$book->appendChild($chapter);
my $chapter = $dom->createElement("Chapter");
$chapter->setAttribute("id", "2");
my $title = $dom->createTextNode("My Second Chapter");
$chapter->appendChild($title);
$book->appendChild($chapter);
$dom->getDocumentElement->appendChild($book);
$dom->printToFile ("book.xml");

if (0) {
foreach my $chap (@chapter) { 
if($chap->getAttribute("id") == 1) {
   my $parent = $chap->getParentNode;
	$parent->removeChild($chap);
}
}

$dom->printToFile ("book.xml");
}
#  print $doc->toString;
