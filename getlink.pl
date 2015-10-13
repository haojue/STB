#!/usr/bin/perl
use Expect;
$Expect::Log_Stdout = 1;
 
$ENV{TERM} = "vt100";

#system('cp /tmp/test /usr/local/apache/htdocs/test1'); 


my ($host,$pass) = ("cnrd-eng-shell3.juniper.net","MaRtInI");
my $device = $ARGV[0];

my $image =~ /.*\/(.*)/;
my $file = $1; 

print $file;


my $exp = Expect->new;
$exp = Expect->spawn("ssh -l regress $host");
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
#print "$ARGV[1]\n\n\n\n";
#$exp->interact() if ($exp->expect(undef,'#'));
$exp->send("$pass\n") if ($exp->expect(undef,'Password:'));
$exp->send("params-info $device\n") if ($exp->expect(undef,'$'));
sleep 5;
my $read = $exp->before(); 
#print "read is $read\n\n\n\n\n\n\n\n\n\n";
#$exp->send("scp $ARGV[0] regress\@10.208.128.32:/tmp/\n") if ($exp->expect(undef,'>>'));
$exp->send("exit\n") if ($exp->expect(undef,'$'));
$exp->log_file(undef);
