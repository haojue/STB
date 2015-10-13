#!/usr/bin/perl
use XML::DOM;



if($ARGV[0] eq "add") {
   &add_profile("$ARGV[1]","$ARGV[2]", "$ARGV[3]", "$ARGV[4]");
} elsif ($ARGV[0] eq "del") {
   &delete_profile("$ARGV[1]","$ARGV[2]");
} elsif($ARGV[0] eq "search") {
   my ($serverip, $params) = &search_profile("$ARGV[1]","$ARGV[2]");
}

#return($serverip, $params);





sub add_profile{
    my $file = shift;	
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $name = shift;
    my $type = shift;
    my $des = shift;
    my @para = @_;
    my $profile = $dom->createElement("profile");
    $profile->setAttribute("name", "$name");
    $profile->setAttribute("type", "$type");
    $profile->setAttribute("des", "$des");
    $profile->setAttribute("params","$params"); 
    my $param = $dom->createElement("param");
    my $para = $dom->createTextNode("@para");
    $param->appendChild($para);
    $profile->appendChild($param);
    $dom->getDocumentElement->appendChild($profile); 
    $dom->printToFile ("$file");
}




sub delete_profile{
    my $file = shift;   
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $jobid = shift;
    my @jobs = $dom->getElementsByTagName("job");
    foreach my $job (@jobs) { 
	    if($job->getAttribute("id") == $jobid ) {
	       my $parent = $job->getParentNode;
	       $parent->removeChild($job);
	     }
    }
    $dom->printToFile ("$file");
}

sub search_profile{
    my $file = shift;   
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $jobid = shift;
    my @jobs = $dom->getElementsByTagName("job");
    foreach my $job (@jobs) { 
            if($job->getAttribute("id") == $jobid ) {
             my $serverip = $job->getAttribute("serverip");
             my $params = $job->getAttribute("params");
             return ($serverip, $params);
             }
    }
  
}


#  print $doc->toString;
