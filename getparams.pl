#!/usr/bin/perl -w
use Data::Dumper;
use Thread;
use threads;
use Expect;
#$Expect::Log_Stdout = 1;

$ENV{TERM} = "vt100";

use Data::Dumper;

#open (FILE, "$ARGV[0]") or die "Can't open myfile: $!";
#system `echo > xxxdomain.stats`;
#system `echo > "$ARGV[1]"`;
print "ARGv0 $ARGV[0]\n";                                                                                                                                             
my $device = $ARGV[0];

my ($host,$pass) = ("cnrd-eng-shell3.juniper.net","MaRtInI");                                                                                                                  
my $exp = Expect->new;
$exp = Expect->spawn("ssh -l regress $host");
$exp->log_file("output.log", "w");
#$exp->send("cd ~haojue\n") if ($exp->expect(undef,'$'));
$exp->send("params-info $device \n") if ($exp->expect(20,'$'));

#print "conn $conn\n\n";

$exp->send("exit\n") if ($exp->expect(undef,'$'));
#my $string =  $exp->get_accum();
my $string =  $exp->exp_before();
$exp->log_file(undef);
print "exit commit_config\n\n";

my @lines = split /\n/, $string;
print Dumper($string);
print Dumper(@lines);

my @lines2;
foreach my $line (@lines) {
 if($line =~ /(\w+\-\d\/\d\/\d)\s+([-_0-9a-zA-Z]+)\s+(.*)/ ) {  
  push @lines2, "$1,$2=>$3";
  }
}

print Dumper(@lines2);
#return @lines2;
