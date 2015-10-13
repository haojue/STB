#!/usr/bin/perl
use Expect;
$Expect::Log_Stdout = 1;
 
$ENV{TERM} = "vt100";

my $timeout = 30;
my $timeoutlong = 20;
my ($host,$pass) = ("10.208.130.44","Embe1mpls");
my $exp = Expect->new;
$exp = Expect->spawn("ssh -l root $host");
$exp->send("$pass\n") if ($exp->expect(undef,'password:')); 
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
$exp->send("nohup ./cps_calculator_haojue.tcl 10.208.131.129 wangwei-utm  2000 1000 10000 50 50 50 > /var/www/html/testresult &\n") if ($exp->expect($timeout,']#'));
#$exp->send("touch tested\n") if ($exp->expect(undef,'>>'));
#$exp->send("./ssl_sendback.exp 10.208.128.32 regress MaRtInI JX46_TPI21633_EWF_cache.pl.17165.log\n") if ($exp->expect(undef,'>>'));
$exp->send("exit\n") if ($exp->expect($timeout,']#'));
$exp->log_file(undef);
