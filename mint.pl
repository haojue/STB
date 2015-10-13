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

config_int($device,@arr);

sub config_int 
{
my $dev = shift;
my @conn = @_;
my $scalar = @conn;
print "\@conn @conn\n\n";
print "scalar $scalar\n\n";
my @config;
push @config, qq(delete interfaces,);
push @config, qq(delete security,);


open(FH, ">> toponame.txt") || die "can't open $! \n" ;

	     print FH "\n";
     close(FH) ;

for($i=0;$i<$scalar;$i++){  
print "array $i $arr[$i]\n\n";
my($int, $ip, $zone) = split /\s+/, $arr[$i];
push @config, qq(set interfaces $int unit 0 family inet address $ip,);
push @config, qq(set security zones security-zone $zone host-inbound-traffic system-services all,);
push @config, qq(set security zones security-zone $zone host-inbound-traffic protocols all,);
push @config, qq(set security zones security-zone $zone interfaces $int\.0,);
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
