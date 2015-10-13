#!/usr/bin/perl
use Expect;
$Expect::Log_Stdout = 1;
 
$ENV{TERM} = "vt100";

#system('cp /tmp/test /usr/local/apache/htdocs/test1'); 


my ($host,$pass) = ("cnrd-eng-shell3.juniper.net","MaRtInI");
my $name = $ARGV[0];
my $password = $ARGV[1];


my $exp = Expect->new;
$exp = Expect->spawn("ssh -l regress $host");
$exp->log_file("output2.log", "w");
$exp->send("$pass\n") if ($exp->expect(undef,'Password:'));
$exp->send("cd ~haojue\n") if ($exp->expect(undef,'$'));
$exp->send("./sendpass.pl $name $password\n") if ($exp->expect(undef,'>>'));
my $read = $exp->before(); 
#print "read is $read\n\n\n\n\n\n\n\n\n\n";
#$exp->send("scp $ARGV[0] regress\@10.208.128.32:/tmp/\n") if ($exp->expect(undef,'>>'));
$exp->send("exit\n") if ($exp->expect(undef,'>>'));
$exp->log_file(undef);
