#!/usr/bin/perl
use File::Basename;
use XML::Simple;
use Data::Dumper;

#my $xmlfile = dirname($0) . "\\employees.xml";
my $xmlfile = "employees.xml";
if (-e $xmlfile)
{
    print "-----------------------------------------\n";
    my $userxs = XML::Simple->new(KeyAttr => "name");
    my $userxml = $userxs->XMLin($xmlfile);
    # print output
    print Dumper($userxml);
    
    my %allemployees = %{$userxml->{employee}};
    foreach my $key (keys(%allemployees))
    {
      print $key . " ";
      print $allemployees{$key}{"age"} . "\n";
    }

    print "-----------------------------------------\n";
       my $userxsT = XML::Simple->new(ForceArray => 1);
    my $userxmlT = $userxsT->XMLin($xmlfile);
    # print output
    print Dumper($userxmlT); 
    
    my @allemployeeT = @{$userxmlT->{"employee"}};
    foreach my $employee (@allemployeeT)
    {
      print $employee->{"name"}[0] . " ";
      print $employee->{"age"} . "\n";
    }    
}
