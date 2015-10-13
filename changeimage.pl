#!/usr/bin/perl
use Expect;
$Expect::Log_Stdout = 1;
 
$ENV{TERM} = "vt100";

#system('cp /tmp/test /usr/local/apache/htdocs/test1'); 


my ($host,$pass) = ("cnrd-eng-shell3.juniper.net","MaRtInI");
my $device = $ARGV[0];
my $image = $ARGV[1];
my $user = $ARGV[2];

$image =~ /.*\/(.*)/;
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
$exp->send("cd ~haojue\n") if ($exp->expect(undef,'$'));
my $read = $exp->before(); 
print "read is $read\n\n\n\n\n\n\n\n\n\n";
$exp->send("scp $image root\@$device:/var/log/\n") if ($exp->expect(300,'>>'));
$exp->send("Embe1mpls\n") if ($exp->expect(undef,'Password:'));	
$exp->send("./cimage.exp $device $file\n") if ($exp->expect(300,'>>'));
$exp->send("\n\n\n") if ($exp->expect(350,'>>'));
$exp->send("./sendnotify.pl $user\n")if ($exp->expect(350,'>>'));
#$exp->send("./ssl_sendback.exp 10.208.128.32 regress MaRtInI JX46_TPI21633_EWF_cache.pl.17165.log\n") if ($exp->expect(undef,'>>'));
#$exp->send("scp $ARGV[0] regress\@10.208.128.32:/tmp/\n") if ($exp->expect(undef,'>>'));
$exp->send("\n\n")if ($exp->expect(10,'>>'));
$exp->send("exit\n") if ($exp->expect(undef,'>>'));
#$exp->log_file(undef);
