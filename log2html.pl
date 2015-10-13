#!/usr/bin/perl -w
use Data::Dumper;
use threads;
#open (FILE, "$ARGV[0]") or die "Can't open myfile: $!";
#system `echo > xxxdomain.stats`;
system `echo > "$ARGV[1]"`;
#print "ARGv0 $ARGV[0] ARGV1 $ARGV[1]\n";                                                                                                                                             
&log2html($ARGV[0]);

sub log2html 
{
my $file=shift;
my @info;
open (FILE, "$file") or die "Can't open myfile: $!";
open(FH, "> $ARGV[1]") or die "can't open $! \n" ;
#my $blank = <FILE> if($file =~ /occur_0/);
print FH "<html>
<head>
<style type=text/css>
#result, #env
  {
  font-family:Trebuchet MS, Arial, Helvetica, sans-serif;
  width:100%;
  border-collapse:collapse;
  }

#result td, #result th, #env td, #env th  
  {
  font-size:1em;
  border:1px solid #98bf21;
  padding:3px 7px 2px 7px;
  }

#result th, #env th 
  {
  font-size:1.1em;
  text-align:left;
  padding-top:5px;
  padding-bottom:4px;
  background-color:#A7C942;
  color:#ffffff;
  }

#green {
   color: green;
   }
 
#red {
   color: red;  
}
#customers tr.alt td 
  {
  color:#000000;
  background-color:#EAF2D3;
  }
body { LINE-HEIGHT: 100%  }
html h5{
  line-height:2px;
  }

</style>
</head>
<body>";

while ($tmp = <FILE>) {
chomp($tmp);
if(($tmp =~ /\+\+ X-DUT/)||($tmp =~ /\+\+ Total_Tests/)) {
push @info, $tmp;
}	
}
close(FILE);

print FH "<div> <div> <h4> Main Info for Script</h4>";
print FH "<table id=env border=1>
<tr>
  <th>Name</th>
  <th>Model</th>
  <th>Image</th>
</tr>";

if($info[0] =~ /\+\+ X-DUT/) {
my ($nouse1,$nouse2, $nouse3, $name, $nouse4,$nouse5, $model, $nouse6, $image ) = split /\s+/,$info[0];
print FH "<tr>
  <td>$name</td>
  <td>$model</td>
  <td>$image</td>
</tr>
";
}
else {
#print FH "No info for name, model, image\n";
print FH "<tr>
  <td>N/A</td>
  <td>N/A</td>
  <td>N/A</td>
</tr>";
}
print FH "</table> </div>";

print FH "<div> <table id=result border=1>
<tr>
  <th>Total</th>
  <th>PASS</th>
  <th>RERUN</th>
  <th>FAIL</th>
  <th>UNTESTED</th>
</tr>";

if($info[1] =~ /\+\+ Total_Tests/) {
	my ($nouse1,$total, $pass,$rerun, $fail, $untested ) = split /\s+/,$info[1];
#	print FH "$total $pass $rerun $fail $untested\n";
print FH "<tr>
  <td>$total</td>
  <td>$pass</td>
  <td>$rerun</td>
  <td>$fail</td>
  <td>$untested</td>
</tr>
";
}
else {
#	print FH "No info for pass, fail\n";
print FH "<tr>
  <td>N/A</td>
  <td>N/A</td>
  <td>N/A</td>
  <td>N/A</td>
  <td>N/A</td>
</tr>";
}

print FH "</table></div> </br> <div>";

open (FILE, "$file") or die "Can't open myfile: $!";
while ($tmp = <FILE>) {
	chomp($tmp);
	if($tmp =~ /\[INFO/) {
	print FH "<h5 id=green>$tmp</h5>";
        } elsif($tmp =~ /\[ERROR/) {
        print FH "<h5 id=red>$tmp</h5>";
	} else {
	print FH "$tmp</br>";
        }  
	}
close(FILE);
print FH "</div> </div> </body>"; 
print FH "</html>";
close(FH);
}
