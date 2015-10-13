#!/usr/bin/perl
package Dev;
use XML::DOM;

@ISA = qw(Exporter);

@EXPORT = qw (
    add_dev
    delete_dev
    set_status
    get_status
    set_cluster
    add_attr 
);




sub add_dev{
    my $file = "dev.xml";
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $name = shift;
    my $type = shift;
    my $cluster = shift;
    my $owner = shift;
    my @para = "device";
    my $dev = $dom->createElement("dev");
    $dev->setAttribute("name", "$name");
    $dev->setAttribute("type", "$type");
    $dev->setAttribute("cluster", "$cluster");
    $dev->setAttribute("owner", "$owner");
    $dev->setAttribute("inuse", "free");
    my $param = $dom->createElement("param");
       my $para = $dom->createTextNode("@para");
#    $param->appendChild($para);
    $dev->appendChild($param);
    $dom->getDocumentElement->appendChild($dev);
    $dom->printToFile ("$file");
}




sub delete_dev{
    my $file = "dev.xml";
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $name = shift;
    my @devs = $dom->getElementsByTagName("dev");
    foreach my $dev (@devs) {
            if($dev->getAttribute("name") =~ /$name/ ) {
               my $parent = $dev->getParentNode;
               $parent->removeChild($dev);
             }
    }
    $dom->printToFile ("$file");
}


sub set_status{
    my $file = "dev.xml";
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $name = shift;
    my $status = shift;
    my @devs = $dom->getElementsByTagName("dev");
    foreach my $dev (@devs) {
            if($dev->getAttribute("name") =~ /$name/ ) {
            $dev->setAttribute("inuse", "$status"); 
            }
    }
    $dom->printToFile ("$file");
}

sub get_status{
    my $file = "dev.xml";
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $name = shift;
    my @devs = $dom->getElementsByTagName("dev");
    foreach my $dev (@devs) {
            if($dev->getAttribute("name") =~ /$name/ ) {
            my $status = $dev->getAttribute("inuse"); 
            return $status; 
            }
    }
}

sub set_cluster{
    my $file = "dev.xml";
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $name = shift;
    my $status = shift;
    my @devs = $dom->getElementsByTagName("dev");
    foreach my $dev (@devs) {
            if($dev->getAttribute("name") =~ /$name/ ) {
            $dev->setAttribute("cluster", "$status"); 
            }
    }
    $dom->printToFile ("$file");
}

sub add_attr{
    my $file = "dev.xml";
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $name = shift;
    my $attr = shift;
    my $value = shift;
    my @devs = $dom->getElementsByTagName("dev");
    foreach my $dev (@devs) {
            if($dev->getAttribute("name") =~ /$name/ ) {
    $dev->setAttribute("$attr", "$value");
            }
    }
    $dom->printToFile ("$file");
}
