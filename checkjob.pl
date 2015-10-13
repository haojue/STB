#!/usr/bin/perl
use Expect;
$Expect::Log_Stdout = 1;
use XML::DOM;
use Job;
use Dev;


$ENV{TERM} = "vt100";

#my $processid = $ARGV[1]; 

my $timeout = 10;
my $timeoutlong = 20;
#my ($host,$pass) = ("$ARGV[0]","Embe1mpls");
my $pass = "Embe1mpls";

my @hosts = qw(tunian cnrdvm31); 

my %hash=("cnrdvm31"=>"10.208.130.44","tunian"=>"10.208.133.79");

while(1) {
foreach my $host (@hosts) { 

my @pids = get_runningjob_pid("job.xml");
my $exp = Expect->new;

$exp = Expect->spawn("ssh -l root $host");


$exp->send("$pass\n") if ($exp->expect(undef,'password:')); 
$exp->log_file("output1.log", "w");

# $exp->send("\n") if ($exp->expect($timeout,']#'));

#$exp->send("ps -aux | grep 11111 | grep -v grep\n") if ($exp->expect($timeout,']#'));


foreach my $pid (@pids)
{
if($pid =~ /\d{3,5}/) {
$exp->send("ps -aux | grep $pid | grep -v grep\n") if ($exp->expect($timeout,']#'));

$exp->send("\n") if ($exp->expect($timeout,']#'));
my $read = $exp->before();
print "read is $read\n";

my @lines = split ("\n",$read);

shift(@lines);

#use Data::Dumper;
#print Dumper(@lines);
#print "###########after lines#######\n";


foreach my $line (@lines)
{
    if($line =~ /$pid/) {
    print "process id found\n";
    goto FINISH; 
    }
}

my $hostip = $hash{$host};
my $ip = find_serverip_by_pid("job.xml", "$pid");

print "hostip is $hostip, ip is $ip\n";
if( $hostip eq $ip) {
my $dev = find_dev_by_pid("job.xml", "$pid");
my $id = find_id_by_pid("job.xml", "$pid");

# exec("./getrsi.pl $dev $id");

my @childs;
 my $ppid = fork();
  if ($ppid) {
    # parent
    push(@childs, $ppid);
  } elsif ($pid == 0) {
    # child
#   exec("$cmd &");
    exec("./getrsi.pl $dev $id");
    exit(0);
  } else {
    die "couldn't fork: $!\n";
  }
foreach (@childs) {
waitpid($_, 0);
}

&set_status("$dev","free");
&move_job_to_finish("job.xml", "finishedjob.xml", "$pid");
print "hostip equals ip, move job to finish\n";
}
}
FINISH: 
print "next pid\n";
}

$exp->send("exit\n") if ($exp->expect($timeout,']#'));
$exp->log_file(undef);
}


############### check queued job and move it to running #############
my @ids = get_queuedjob_id("job.xml");
foreach my $id (@ids)
{
my $dev = find_dev_by_id("job.xml", "$id");
my $status = get_status($dev);
if ($status eq "free") {
set_job_status("job.xml", $id, "running");
my $cmd = find_cmd_by_id("job.xml", $id); 
set_status($dev,"inuse");
sleep 5;
#exec("$cmd &");
my @childs;
 my $ppid = fork();
  if ($ppid) {
    # parent
    push(@childs, $ppid);
  } elsif ($pid == 0) {
    # child
    exec("$cmd &");
    exit(0);
  } else {
    die "couldn't fork: $!\n";
  }
foreach (@childs) {
waitpid($_, 0);
}
}
}
sleep 10;
}
