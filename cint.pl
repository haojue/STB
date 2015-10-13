#!/usr/bin/perl -w
use Data::Dumper;
use XML::DOM;
use Thread;
use threads;
use Expect;
#$Expect::Log_Stdout = 1;

$ENV{TERM} = "vt100";

#system('cp /tmp/test /usr/local/apache/htdocs/test1'); 
#
use Data::Dumper;

#open (FILE, "$ARGV[0]") or die "Can't open myfile: $!";
#system `echo > xxxdomain.stats`;
#system `echo > "$ARGV[1]"`;
print "ARGv0 $ARGV[0] ARGV1 $ARGV[1] ARGV2 $ARGV[2] \n";                                                                                                                                             
my $i;
my @threads;
my $profile = $ARGV[0];
my @arr = split /,/, $ARGV[1]; 
#my $scalar = @arr;
print "arr @arr\n\n";
#print "scalar $scalar\n\n";

my $file = "int.xml";

#   &add_job("$ARGV[1]","$ARGV[2]", "$ARGV[3]", "$ARGV[4]", "$ARGV[5]");


sub add_int{
    my $file = shift;   
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $profileid = shift;
    my $config = shift; 
    my $int = $dom->createElement("int");
    $int->setAttribute("id", "$profileid");
    $int->setAttribute("param", "$config");
    my $param = $dom->createElement("param");
    #  my $para = $dom->createTextNode("@para");
    #  $param->appendChild($para);
    $int->appendChild($param);
    $dom->getDocumentElement->appendChild($int); 
    $dom->printToFile ("$file");
}


my $config = &config_int($profile,@arr);
print "file is $file, profile is $profile, config is $config\n";

&add_int("$file", "$profile", "$config");

sub config_int 
{
my $pro = shift;
my @conn = @_;
my $scalar = @conn;
print "\@conn @conn\n\n";
print "scalar $scalar\n\n";
my @config;
#push @config, qq(delete interfaces,);
#push @config, qq(delete security,);



for($i=0;$i<$scalar;$i++){  
print "array $i $arr[$i]\n\n";
my($int, $ip, $zone) = split /\s+/, $arr[$i];
push @config, qq(set interfaces $int unit 0 family inet address $ip);
push @config, qq(set security zones security-zone $zone host-inbound-traffic system-services all);
push @config, qq(set security zones security-zone $zone host-inbound-traffic protocols all);
push @config, qq(set security zones security-zone $zone interfaces $int\.0);
}
my $str = join(',', @config);
return $str;
print "exit config_int\n\n";
}
