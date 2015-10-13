#!/usr/bin/perl
use XML::DOM;
use Data::Dumper;

 my $parser = new XML::DOM::Parser;
 my $doc = $parser->parsefile ("employees.xml");

 # print all HREF attributes of all CODEBASE elements
 my $nodes = $doc->getElementsByTagName ("employee");
 my $n = $nodes->getLength;

 for (my $i = 0; $i < $n; $i++)
 {
     my $node = $nodes->item ($i);
         my $href = $node->getAttributeNode ("age");
         my $age = $href->getValue;
	 if($age=30) { my $parent=$node->getParentNode();  $doc->removeChild($node); }
#   print $href->getValue . "\n";
 }

 # Print doc file
 $doc->printToFile ("out.xml");

 # Print to string
 print $doc->toString;

 # Avoid memory leaks - cleanup circular references for garbage collection
 $doc->dispose;
