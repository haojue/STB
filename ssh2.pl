#!/usr/bin/perl
use Expect;
$Expect::Log_Stdout = 1;
 
$ENV{TERM} = "vt100";

#system('cp /tmp/test /usr/local/apache/htdocs/test1'); 

my $timeout = 20;
my ($host,$pass) = ("cnrd-eng-shell3.juniper.net","MaRtInI");
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
print "$ARGV[1]\n\n\n\n";
#$exp->interact() if ($exp->expect(undef,'#'));
$exp->send("cd ~$ARGV[1]\n") if ($exp->expect($timeout,'$'));
#$exp->send("touch tested\n") if ($exp->expect(undef,'>>'));
#$exp->send("./ssl_sendback.exp 10.208.128.32 regress MaRtInI JX46_TPI21633_EWF_cache.pl.17165.log\n") if ($exp->expect(undef,'>>'));
$exp->send("scp $ARGV[0] regress\@10.208.128.32:/tmp/\n") if ($exp->expect($timeout,'>>'));
$exp->send("exit\n") if ($exp->expect($timeout,'>>'));
$exp->log_file(undef);
