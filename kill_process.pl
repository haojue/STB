#!/usr/bin/perl
use Expect;
$Expect::Log_Stdout = 1;
use XML::DOM;
use Job;
 
$ENV{TERM} = "vt100";

my $processid = $ARGV[1]; 

my $timeout = 30;
my $timeoutlong = 20;
my ($host,$pass) = ("$ARGV[0]","Embe1mpls");
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
#$exp->send("killall -9 creat_log.pl\n") if ($exp->expect($timeout,']#'));


$exp->send("kill $processid \n") if ($exp->expect($timeout,']#'));
#$exp->send("touch tested\n") if ($exp->expect(undef,'>>'));
#$exp->send("./ssl_sendback.exp 10.208.128.32 regress MaRtInI JX46_TPI21633_EWF_cache.pl.17165.log\n") if ($exp->expect(undef,'>>'));
if($processid != undef) {
&move_job_to_finish("job.xml", "finishedjob.xml", "$processid");
my $id = &find_id_by_pid("finishedjob.xml","$processid");
&set_job_attr("finishedjob.xml",$id,"kill","yes");
}


$exp->send("exit\n") if ($exp->expect($timeout,']#'));
$exp->log_file(undef);

