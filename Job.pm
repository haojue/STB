#!/usr/bin/perl
package Job;
use XML::DOM;

@ISA = qw(Exporter);


@EXPORT = qw (
     
    add_job
    delete_job
    delete_job_by_processid
    search_job
    move_job_to_finish   
    abort_job
    job_rerun
    insert_job_process_id
    get_runningjob_pid
    get_queuedjob_id
    find_dev_by_pid
    find_id_by_pid
    find_dev_by_id
    find_serverip_by_pid
    set_job_status
    find_cmd_by_id
    set_job_attr
    find_id_by_date
    add_count
    start_count
    set_count
    testname_exists
    add_test
    add_testprofile   
);


sub add_job{
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $jobid = shift;
    my $serverip = shift;
    my $scriptname = shift;
    my @para = @_;
    my $params = shift;
    my $dev = shift;
    my $status = shift;
    my $cmd = shift;
    my $job = $dom->createElement("job");
    $job->setAttribute("id", "$jobid");
    $job->setAttribute("serverip", "$serverip");
    $job->setAttribute("scriptname", "$scriptname");
    $job->setAttribute("params","$params");
    $job->setAttribute("dev","$dev");
    $job->setAttribute("status","$status");
    $job->setAttribute("cmd",$cmd);
    my $param = $dom->createElement("param");
    my $para = $dom->createTextNode("@para");
    $param->appendChild($para);
    $job->appendChild($param);
    $dom->getDocumentElement->appendChild($job); 
    $dom->printToFile ("$file");
    my $date = $1 if ($jobid =~ /(\d{6}).*/); 
     if(find_id_by_date("stats.xml",$date)) {
     add_count("stats.xml",$date);  
     } else {
     start_count("stats.xml",$date); 
     }
}




sub delete_job{
    my $file = shift;   
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $jobid = shift;
    my @jobs = $dom->getElementsByTagName("job");
    foreach my $job (@jobs) { 
            if($job->getAttribute("id") eq $jobid ) {
               my $parent = $job->getParentNode;
               $parent->removeChild($job);
             }
    }
    $dom->printToFile ("$file");
}


sub delete_job_by_processid {
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $pid = shift;
    my @jobs = $dom->getElementsByTagName("job");
    foreach my $job (@jobs) {
            if($job->getAttribute("processid") eq $pid ) {
               my $parent = $job->getParentNode;
               $parent->removeChild($job);
             }
    }
    $dom->printToFile ("$file");
}

sub search_job{
    my $file = shift;   
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $jobid = shift;
    my @jobs = $dom->getElementsByTagName("job");
    foreach my $job (@jobs) { 
            if($job->getAttribute("id") == $jobid ) {
             my $serverip = $job->getAttribute("serverip");
             my $params = $job->getAttribute("params");
             return ($serverip, $params);
             }
    }
  
}



sub move_job_to_finish {
    my $from = shift;
    my $to = shift;
    my $pid = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$from");
    my @jobs = $dom->getElementsByTagName("job");
    my ($id,$scriptname,$serverip,$params,$cmd);
    foreach my $job (@jobs) {
            if($job->getAttribute("processid") == $pid ) {
            $id = $job->getAttribute("id");
            $scriptname = $job->getAttribute("scriptname");
            $serverip = $job->getAttribute("serverip");
            $params = $job->getAttribute("params");
            $dev = $job->getAttribute("dev");
            $submitter = $job->getAttribute("submitter");
            $cmd = $job->getAttribute("cmd");
            my $parent = $job->getParentNode;
            $parent->removeChild($job);
            $dom->printToFile ($from);
            }
    }

    my $dom2 = $parser->parsefile("$to");
    my $job = $dom2->createElement("job");
    $job->setAttribute("id", "$id");
    $job->setAttribute("serverip", "$serverip");
    $job->setAttribute("scriptname", "$scriptname");
    $job->setAttribute("params","$params");
    $job->setAttribute("processid","$pid");
    $job->setAttribute("dev","$dev");
    $job->setAttribute("submitter","$submitter");
    $job->setAttribute("cmd","$cmd");
    my $param = $dom2->createElement("param");
    $job->appendChild($param);
    $dom2->getDocumentElement->appendChild($job);
    $dom2->printToFile ($to);
}


sub abort_job {
    my $from = "job.xml";
    my $to = "finishedjob.xml";
    my $id = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$from");
    my @jobs = $dom->getElementsByTagName("job");
    my ($pid,$scriptname,$serverip,$params,$cmd);
    foreach my $job (@jobs) { 
	    #    if(($job->getAttribute("id") == $id) && ($job->getAttribute("status") eq "queued") ) {
            if($job->getAttribute("id") == $id ) {
            $pid = $job->getAttribute("processid");
            $scriptname = $job->getAttribute("scriptname");
            $serverip = $job->getAttribute("serverip");
            $params = $job->getAttribute("params");
            $dev = $job->getAttribute("dev");
            $submitter = $job->getAttribute("submitter");
            $cmd = $job->getAttribute("cmd");
            my $parent = $job->getParentNode;
            $parent->removeChild($job);
            $dom->printToFile ($from);
            }
    }

    my $dom2 = $parser->parsefile("$to");
    my $job = $dom2->createElement("job");
    $job->setAttribute("id", "$id");
    $job->setAttribute("serverip", "$serverip");
    $job->setAttribute("scriptname", "$scriptname");
    $job->setAttribute("params","$params");
    $job->setAttribute("processid","abort when queued");
    $job->setAttribute("dev","$dev");
    $job->setAttribute("submitter","$submitter");
    $job->setAttribute("cmd","$cmd");
    my $param = $dom2->createElement("param");
    $job->appendChild($param);
    $dom2->getDocumentElement->appendChild($job);
    $dom2->printToFile ($to);
}


sub job_rerun {
    my $from = "finishedjob.xml";
    my $to = "job.xml";
    my $id = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$from");
    my @jobs = $dom->getElementsByTagName("job");
    my ($scriptname,$serverip,$params,$submitter, $cmd);
    foreach my $job (@jobs) {
            if($job->getAttribute("id") == $id ) {
            $scriptname = $job->getAttribute("scriptname");
            $serverip = $job->getAttribute("serverip");
            $params = $job->getAttribute("params");
            $dev = $job->getAttribute("dev");
            $submitter = $job->getAttribute("submitter");
            $cmd = $job->getAttribute("cmd");
            my $parent = $job->getParentNode;
       $parent->removeChild($job);
            $dom->printToFile ($from);
            }
    }

    my ($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime;
    $year += 1900; 
    $mon += 1; 
    #   $id = sprintf ("%02d%02d%02d%02d%02d", $mon,$mday,$hour,$min,$sec);

    my $dom2 = $parser->parsefile("$to");
    my $job = $dom2->createElement("job");
    $job->setAttribute("id", "$id");
    $job->setAttribute("serverip", "$serverip");
    $job->setAttribute("scriptname", "$scriptname");
    $job->setAttribute("params","$params");
    $job->setAttribute("dev","$dev");
    $job->setAttribute("submitter","$submitter");
    $job->setAttribute("status","queued");
    $job->setAttribute("cmd","$cmd");
    my $param = $dom2->createElement("param");
    $job->appendChild($param);
    $dom2->getDocumentElement->appendChild($job);
    $dom2->printToFile ($to);
}


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

sub get_runningjob_pid {
    my @pid;
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my @jobs = $dom->getElementsByTagName("job");
    foreach my $job (@jobs) {
      my $status = $job->getAttribute("status");
      if ($status eq "running") {
      push @pid, $job->getAttribute("processid");
      }
    }
    return @pid;
}

sub get_queuedjob_id {
    my @id;
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my @jobs = $dom->getElementsByTagName("job");
    foreach my $job (@jobs) {
      my $status = $job->getAttribute("status");
      if ($status eq "queued") {
      push @id, $job->getAttribute("id");
      }
    }
    return @id;
}


sub find_dev_by_pid {
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $pid = shift;
    my @jobs = $dom->getElementsByTagName("job");
    foreach my $job (@jobs) {
            if($job->getAttribute("processid") == $pid ) {
             my $dev = $job->getAttribute("dev");
             return $dev;
             }
    }
}

sub find_id_by_pid {
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $pid = shift;
    my @jobs = $dom->getElementsByTagName("job");
    foreach my $job (@jobs) {
            if($job->getAttribute("processid") == $pid ) {
             my $id = $job->getAttribute("id");
             return $id;
             }
    }
}

sub find_dev_by_id {
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $id = shift;
    my @jobs = $dom->getElementsByTagName("job");
    foreach my $job (@jobs) {
            if($job->getAttribute("id") == $id ) {
             my $dev = $job->getAttribute("dev");
             return $dev;
             }
    }
}

sub find_serverip_by_pid {
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $pid = shift;
    my @jobs = $dom->getElementsByTagName("job");
    foreach my $job (@jobs) {
            if($job->getAttribute("processid") == $pid ) {
             my $serverip = $job->getAttribute("serverip");
             return $serverip;
             }
    }
}

sub set_job_status {
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $jobid = shift;
    my $status = shift;
    my @jobs = $dom->getElementsByTagName("job");
    foreach my $job (@jobs) {
            if($job->getAttribute("id") == $jobid ) {
            $job->setAttribute("status", "$status");
            $dom->printToFile ("$file");
            }
    }
}

sub find_cmd_by_id {
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $id = shift;
    my @jobs = $dom->getElementsByTagName("job");
    foreach my $job (@jobs) {
            if($job->getAttribute("id") == $id ) {
             my $cmd = $job->getAttribute("cmd");
             return $cmd;
             }
    }
}

sub set_job_attr {
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $jobid = shift;
    my $attr = shift;
    my $value = shift;
    my @jobs = $dom->getElementsByTagName("job");
    foreach my $job (@jobs) {
            if($job->getAttribute("id") == $jobid ) {
            $job->setAttribute("$attr", "$value");
            $dom->printToFile ("$file");
            }
    }
}


sub find_id_by_date {
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $id = shift;
    my @stats = $dom->getElementsByTagName("stat");
    foreach my $stat (@stats) {
            if($stat->getAttribute("id") == $id ) {
             return $id;
             } 
    }
    return 0;
}

sub testname_exists {
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $id = shift;
    my @stats = $dom->getElementsByTagName("test");
    foreach my $stat (@stats) {
            if($stat->getAttribute("name") eq $id ) {
	     return 1;
             }
    }
    return 0;
}

sub add_count {
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $id = shift;
    my @stats = $dom->getElementsByTagName("stat");
    foreach my $stat (@stats) {
            if($stat->getAttribute("id") eq $id ) {
               my $num = $stat->getAttribute("num");
               $num += 1;
               $stat->setAttribute("num", "$num");
               last;  
             }
    }
    $dom->printToFile ("$file");
}


sub start_count {
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $id = shift;
    my $stat = $dom->createElement("stat");
    $stat->setAttribute("id", "$id");
    $stat->setAttribute("num", "1");
    $dom->getDocumentElement->appendChild($stat); 
    $dom->printToFile ("$file");
}

sub set_count {
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $id = shift;
    my $num = shift;
    my @stats = $dom->getElementsByTagName("stat");
    foreach my $stat (@stats) {
            if($stat->getAttribute("id") eq $id ) {
               $stat->setAttribute("num", "$num");
               last;
             }
    }
    $dom->printToFile ("$file");
}

sub add_test {
    my $file = shift;
    my $parser = new XML::DOM::Parser;
    my $dom = $parser->parsefile("$file");
    my $id = shift;
    my $stat = $dom->createElement("test");
    $stat->setAttribute("name", "$id");
    $dom->getDocumentElement->appendChild($stat); 
    $dom->printToFile ("$file");
}

sub add_testprofile {
    my $file = shift;
    my $name = shift; 
    if(!testname_exists($file,$name)) {
    add_test($file,$name);                                                                                                                                           
    }
}
