#!/usr/bin/perl
use Expect;
$Expect::Log_Stdout = 1;
 
$ENV{TERM} = "vt100";


#system('cp /tmp/test /usr/local/apache/htdocs/test1'); 

my ($host,$pass) = ("cnrd-eng-shell1.juniper.net","MaRtInI");

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

$exp->send("MaRtInI\n") if ($exp->expect(undef,'Password:'));
$exp->send("ssh root\@$device\n") if ($exp->expect(undef,'$'));

#if ($exp->expect(undef,'Password:')){
#$exp->send("Embe1mpls\n");	
#} else {
#$exp->send("yes\n");
#}
$exp->send("yes\n")if ($exp->expect(2,'yes/no)?')); 
$exp->send("Embe1mpls\n") if ($exp->expect(undef,'Password:'));
$exp->send("cli\n") if ($exp->expect(30,'%'));
$exp->send("config\n") if ($exp->expect(undef,'>'));
#$exp->send("show interfaces | display set\n") if ($exp->expect(undef,'#'));
#$exp->send("show security | display set | no-more\n") if ($exp->expect(undef,'#'));
$exp->send("run show configuration | display set | no-more\n") if ($exp->expect(undef,'#'));
#$exp->send("./ssl_sendback.exp 10.208.128.32 regress MaRtInI JX46_TPI21633_EWF_cache.pl.17165.log\n") if ($exp->expect(undef,'>>'));
my $read = $exp->before(); 
print "read is $read\n\n\n\n\n\n\n\n\n\n";
#$exp->send("scp $ARGV[0] regress\@10.208.128.32:/tmp/\n") if ($exp->expect(undef,'>>'));
$exp->send("exit\n") if ($exp->expect(undef,'#'));
$exp->log_file(undef);
