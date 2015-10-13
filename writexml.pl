#!/usr/bin/perl -w 
use File::Basename;
use XML::Simple;
use Data::Dumper;
use XML::DOM;

print "-----------------------------------------\n";
# create array
my @arr = [
        {'country'=>'england', 'capital'=>'london'},
        {'country'=>'norway', 'capital'=>'oslo'},
        {'country'=>'india', 'capital'=>'new delhi'} ];


# create object
my $xml = new XML::Simple(NoAttr=>1, RootName=>'dataroot');


# convert Perl array ref into XML document 
my $data = $xml->XMLout(\@arr,outputfile => "output1.xml");




print "-----------------------------------------\n";
my $str=<<_XML_STRING_;
<config logdir="/var/log/foo/" debugfile="/tmp/foo.debug">
<server name="sahara" osname="solaris" osversion="2.6">
  <address>10.0.0.101</address>
  <address>10.0.1.101</address>
</server>
<server name="gobi" osname="irix" osversion="6.5">
  <address>10.0.0.102</address>
</server>
<server name="kalahari" osname="linux" osversion="2.0.34">
  <address>10.0.0.103</address>
  <address>10.0.1.103</address>
</server>
</config>
_XML_STRING_


my $xml_ref=XMLin($str,KeepRoot => 1);
my $xml_str=XMLout($xml_ref,outputfile => "output2.xml");
print "-----------------------------------------\n";
