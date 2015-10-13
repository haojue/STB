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
my @arr = split /,/, $ARGV[0]; 
my $scalar = @arr;
print "arr @arr\n\n";
print "scalar $scalar\n\n";

if(0) {
for($i=0;$i<$scalar;$i++){  
print "arr[$i] $arr[$i]\n\n";
my $tmp = threads->create('plink', $arr[$i]);
#my $tmp = threads->create('ss', 10);
#$tmp->detach(); 
#my $tmp = Thread->new(\&plink, $arr[$i]);
sleep 2;
print "thread $tmp\n";
push @threads, $tmp;
}
}

for($i=0;$i<$scalar;$i++){  
plink($arr[$i]);
}

sub ss()
{ my $t=shift;
	print "sleep $t\t";
	sleep($t); 
}



sub plink 
{
my $conn = shift;
my ($host,$pass) = ("cnrd-eng-shell3.juniper.net","Netcis40");
my $exp = Expect->new;
$exp = Expect->spawn("ssh -l haojue $host");
#$exp->log_file("output.log", "w");
$exp->send("$pass\n") if ($exp->expect(undef,'Password:'));
#print "$ARGV[0]\n\n\n\n";

$exp->send("touch testtest\n") if ($exp->expect(undef,'>>'));
print "conn $conn\n\n";

$exp->send("plinker -l $conn\n") if ($exp->expect(undef,'>>'));                                                                                                             
$exp->send("exit\n") if ($exp->expect(undef,'>>'));
#$exp->log_file(undef);
print "exit plink\n\n";
}

if(0) {
for($i=0;$i<$scalar;$i++){ 
print "Before join\n\n\n";
$threads[$i]->join;
}
}
