#!/usr/bin/perl
use XML::DOM;
use Job;


if($ARGV[0] eq "add") {
   &add_job("$ARGV[1]","$ARGV[2]", "$ARGV[3]", "$ARGV[4]", "$ARGV[5]","$ARGV[6]","$ARGV[7]", "$ARGV[8]");
} elsif ($ARGV[0] eq "del") {
   &delete_job("$ARGV[1]","$ARGV[2]");
} elsif($ARGV[0] eq "search") {
   my ($serverip, $params) = &search_job("$ARGV[1]","$ARGV[2]");
} elsif($ARGV[0] eq "delbyprocessid") {
  &delete_job_by_processid("$ARGV[1]","$ARGV[2]"); 
} elsif($ARGV[0] eq "attr") {
    &set_job_attr("$ARGV[1]","$ARGV[2]","$ARGV[3]","$ARGV[4]"); 
} elsif($ARGV[0] eq "rerun") {
   &job_rerun("$ARGV[1]"); 
} elsif($ARGV[0] eq "move") {
   &move_job_to_finish("$ARGV[1]", "$ARGV[2]", "$ARGV[3]");
} elsif($ARGV[0] eq "abort") {
   &abort_job("$ARGV[1]");
} elsif($ARGV[0] eq "count") {
   &add_count("stats.xml","$ARGV[1]");
} elsif($ARGV[0] eq "setcount") {
   &set_count("stats.xml","$ARGV[1]","$ARGV[2]");
} elsif($ARGV[0] eq "add_testprofile") {
   &add_testprofile("stats.xml","$ARGV[1]");
}



return($serverip, $params);

#  print $doc->toString;
