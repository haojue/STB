#!/usr/bin/perl
use Expect;
$Expect::Log_Stdout = 1;
use XML::DOM;


$ENV{TERM} = "vt100";
#print "ARGv0 $ARGV[0] ARGV1 $ARGV[1] ARGV2 $ARGV[2] \n";
my $tclserver = $ARGV[0]; 
my $tclname = $ARGV[1];
my $chassisip = $ARGV[2]; 
my $cardname = $ARGV[3]; 
my $startport= $ARGV[4];
my $endport= $ARGV[5];
my $value = $ARGV[6];
my $sustaintime = $ARGV[7];
my $jobid = $ARGV[8];
print "#########  $tclserver $tclname $chassisip $cardname $startport $endport $value $sustaintime\n\n\n";
my $timeout = 40;
my $timeoutlong = 20;
my ($host,$pass) = ("10.208.133.79","Embe1mpls");
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
$exp->send("nohup ./$tclname  $chassisip $cardname $startport $endport $value $sustaintime > /var/www/html/$tclname.$jobid.results &\n") if($exp->expect($timeout,']#'));
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



sub insert_job_process_id {
    my $file = shift;   
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $jobid = shift;
    my $processid = shift;
    my @jobs = $dom->getElementsByTagName("job");
    foreach my $job (@jobs) { 
            if($job->getAttribute("id") == $jobid ) {
	    $job->setAttribute("processid", "$processid");	    
		    #           my $serverip = $job->getAttribute("serverip");
		    # my $params = $job->getAttribute("params");
            $dom->printToFile ("$file");
	    }
    }
  
}

