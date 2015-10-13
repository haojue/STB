#!/usr/bin/perl
use Expect;
use Job;
$Expect::Log_Stdout = 1;
 
$ENV{TERM} = "vt100";
#print "ARGv0 $ARGV[0] ARGV1 $ARGV[1] ARGV2 $ARGV[2] \n";
my $tclserver = $ARGV[0]; 
my $tclname = $ARGV[1];
my $chassisip = $ARGV[2]; 
my $cardname = $ARGV[3]; 
my $port= $ARGV[4];
my $dstmac = $ARGV[5];
my $stime = $ARGV[6];
my $jobid = $ARGV[7]; 
print "#########  $tclserver $tclname $chassisip $cardname $port $dstmac\n\n\n";
my $timeout = 30;
my $timeoutlong = 20;
my ($host,$pass) = ("$tclserver","Embe1mpls");
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
$exp->send("nohup ./$tclname $chassisip $chassisip $cardname $port \"$dstmac\" $stime > /var/www/html/$tclname.$jobid.results &\n") if ($exp->expect($timeout,']#'));
#$exp->send("touch tested\n") if ($exp->expect(undef,'>>'));
#$exp->send("./ssl_sendback.exp 10.208.128.32 regress MaRtInI JX46_TPI21633_EWF_cache.pl.17165.log\n") if ($exp->expect(undef,'>>'));
$exp->send("\n") if ($exp->expect($timeout,']#'));
my $read = $exp->before();
print "read is $read\n";

my @lines = split ("\n",$read);

#use Data::Dumper;
#print Dumper(@lines);
#print "###########after lines#######\n";

my $process_id;
    foreach my $line (@lines)
    {
     if($line =~ /\[\d+\]\s+(\d{3,5})/) {
     $process_id = $1;
     print "process id is $process_id\n";
    }
    }

&insert_job_process_id("job.xml", $jobid, $process_id);

$exp->send("exit\n") if ($exp->expect($timeout,']#'));
$exp->log_file(undef);
