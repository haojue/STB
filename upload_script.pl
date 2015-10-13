#!/usr/bin/perl
use Expect;
$Expect::Log_Stdout = 1;
use XML::DOM;
use Job;
 
$ENV{TERM} = "vt100";

my $file = $ARGV[1]; 

my $timeout = 30;
my $timeoutlong = 20;
my ($host,$pass) = ("$ARGV[0]","Embe1mpls");
my $exp = Expect->new;
$exp = Expect->spawn("ftp $host");
$exp->send("root\n") if ($exp->expect(undef,'):')); 
$exp->send("$pass\n") if ($exp->expect(undef,'Password:')); 
$exp->log_file("output.log", "w");
#$exp->expect(2,[
#                    qr/password:/i,
#                    sub {
#                            my $self = shift ;
#                            $self->send("$pass\n");
#                            exp_continue;
# 
#                        }
#                ],
#                [
#                    'connecting (yes/no)',
#                    sub {
#                            my $self = shift ;
#                            $self->send("yes\n");
#                         }
#                ]
#            );
#$exp->interact() if ($exp->expect(undef,'#'));
#$exp->send("killall -9 creat_log.pl\n") if ($exp->expect($timeout,']#'));


$exp->send("lcd upload \n") if ($exp->expect($timeout,'ftp>'));
$exp->send("put $file\n") if ($exp->expect($timeout,'ftp>'));
$exp->send("chmod 777 $file\n") if ($exp->expect($timeout,'ftp>'));
#$exp->send("bye\n") if ($exp->expect($timeout,'ftp>'));
#$exp->send("touch tested\n") if ($exp->expect(undef,'>>'));
#$exp->send("./ssl_sendback.exp 10.208.128.32 regress MaRtInI JX46_TPI21633_EWF_cache.pl.17165.log\n") if ($exp->expect(undef,'>>'));
$exp->send("exit\n") if ($exp->expect($timeout,'ftp>'));
$exp->log_file(undef);

