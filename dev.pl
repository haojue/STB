#!/usr/bin/perl
use XML::DOM;
use Dev;


if($ARGV[0] eq "add") {
   &add_dev("$ARGV[1]", "$ARGV[2]", "$ARGV[3]", "$ARGV[4]");
} elsif ($ARGV[0] eq "del") {
   &delete_dev("$ARGV[1]");
} elsif($ARGV[0] eq "set") {
#  my ($serverip, $params) = &search_job("$ARGV[1]","$ARGV[2]");
   &set_status("$ARGV[1]","$ARGV[2]");
} elsif($ARGV[0] eq "cluster") {
   &set_cluster("$ARGV[1]","$ARGV[2]");
} elsif($ARGV[0] eq "attr") {
   &add_attr("$ARGV[1]","$ARGV[2]", "$ARGV[3]");
}


#return($serverip, $params);
