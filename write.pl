#!/usr/bin/perl
use Expect;
$Expect::Log_Stdout = 1;
 
$ENV{TERM} = "vt100";

#system('cp /tmp/test /usr/local/apache/htdocs/test1'); 

my $device = $ARGV[0];
my $doc = $ARGV[1];

system("echo $doc >> $device");



