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

commit_config($device,@arr);

sub commit_config 
{
my $dev = shift;
my @conn = @_;
my $scalar = @conn;
print "\@conn @conn\n\n";
print "scalar $scalar\n\n";
my $config;

for($i=0;$i<$scalar;$i++){  
print "array $i $arr[$i]\n\n";
#push @config, qq($arr[$i],);
#chomp($arr[$i]);
$config .= $arr[$i];
$config .= ","; 
}

print "config is $config\n";

my ($host,$pass) = ("cnrd-eng-shell3.juniper.net","MaRtInI");                                                                                                                  
my $exp = Expect->new;
$exp = Expect->spawn("ssh -l regress $host");
$exp->log_file("output.log", "w");
$exp->send("$pass\n") if ($exp->expect(undef,'Password:'));
$exp->send("cd ~haojue\n") if ($exp->expect(undef,'$'));
$exp->send("./util.pl $dev \"$config\"\n") if ($exp->expect(20,'>>'));

my $string =  $exp->get_accum();

#print "conn $conn\n\n";

$exp->send("exit\n") if ($exp->expect(undef,'>>'));
$exp->log_file(undef);
print "exit commit_config\n\n";

if($string =~ "Configuration commit failed!")  
	{
        return 0;       
	} else {
	return 1;
}

}
