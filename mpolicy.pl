#!/usr/bin/perl -w
use Data::Dumper;
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
my $device = $ARGV[0];
my @arr = split /,/, $ARGV[1]; 
#my $scalar = @arr;
print "arr @arr\n\n";
#print "scalar $scalar\n\n";

config_policy($device,@arr);

sub config_policy 
{
my $dev = shift;
my @conn = @_;
my $scalar = @conn;
print "\@conn @conn\n\n";
print "scalar $scalar\n\n";
my @config;

for($i=0;$i<$scalar;$i++){  
print "array $i $arr[$i]\n\n";
my($name, $fromzone, $tozone,$srcaddr,$dstaddr,$service, $action) = split /\s+/, $arr[$i];
push @config, qq(set security policies from-zone $fromzone to-zone $tozone policy $name match source-address $srcaddr destination-address $dstaddr application $service,);
push @config, qq(set security policies from-zone $fromzone to-zone $tozone policy $name then $action,);
}

my ($host,$pass) = ("cnrd-eng-shell3.juniper.net","MaRtInI");                                                                                                                  
my $exp = Expect->new;
$exp = Expect->spawn("ssh -l regress $host");
$exp->log_file("output.log", "w");
$exp->send("cd ~haojue\n") if ($exp->expect(undef,'$'));
$exp->send("./util.pl $dev \"@config\"\n") if ($exp->expect(undef,'>>'));

#print "conn $conn\n\n";

$exp->send("exit\n") if ($exp->expect(undef,'>>'));
$exp->log_file(undef);
print "exit config_int\n\n";
}
