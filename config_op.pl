#!/usr/bin/perl
use XML::DOM;



print "ARGv0 $ARGV[0] ARGV1 $ARGV[1] ARGV2 $ARGV[2] \n";


if($ARGV[0] eq "add") {
   &add_config("$ARGV[1]","$ARGV[2]","$ARGV[3]","$ARGV[4]");
} elsif ($ARGV[0] eq "del") {
   &delete_config("$ARGV[1]");
} elsif($ARGV[0] eq "attr") {
   &set_config_attr("$ARGV[1]","$ARGV[2]","$ARGV[3]");
}


sub add_config{
    my $file = "config.xml";
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $id = shift;
    my $type = shift;
    my $des = shift;
    my $param = shift;
    my $config = $dom->createElement("config");
    $config->setAttribute("id", "$id");
    $config->setAttribute("type", "$type");
    $config->setAttribute("des", "$des");
    $config->setAttribute("param", "$param");
    my $params = $dom->createElement("param");
    my $para = $dom->createTextNode("$param");
    $params->appendChild($para);
    $config->appendChild($params);
    $dom->getDocumentElement->appendChild($config);
    $dom->printToFile ("$file");
}





sub delete_config{
    my $file = "config.xml";   
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $id = shift;
    my @configs = $dom->getElementsByTagName("config");
    foreach my $config (@configs) { 
	    if($config->getAttribute("id") eq $id ) {
	       my $parent = $config->getParentNode;
	       $parent->removeChild($config);
	     }
    }
    $dom->printToFile ("$file");
}

sub set_config_attr {
    my $file = "config.xml";
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $id = shift;
    my $attr = shift;
    my $value = shift;
    my @configs = $dom->getElementsByTagName("config");
    foreach my $config (@configs) {
            if($config->getAttribute("id") eq $id ) {
            $config->setAttribute("$attr", "$value");
            $dom->printToFile ("$file");
            }
    }
}
