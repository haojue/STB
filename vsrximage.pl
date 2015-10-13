#!/usr/bin/perl
use Expect;
$Expect::Log_Stdout = 1;
 
$ENV{TERM} = "vt100";

#system('cp /tmp/test /usr/local/apache/htdocs/test1'); 


my ($host,$pass) = ("eng-shell1.juniper.net","MaRtInI");
#my $device = $ARGV[0];
#my $image = $ARGV[1];

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

$exp->send("$pass\n") if ($exp->expect(undef,'password:'));
$exp->send("cd /volume/ngsrx-dev-store/ngsrx-yocto-daily\n") if ($exp->expect(undef,'#'));


$exp->send("cd LATEST/ship/cli/\n") if ($exp->expect(undef,'#'));
$exp->send("ls junos-srx-ffp-vsrx-15.1-2015-04-22.1_X_151_X49-domestic.tgz\n") if ($exp->expect(undef,'#'));
#print "read is $read\n\n\n\n\n\n\n\n\n\n" if ($exp->expect(undef,'#'));

if ($exp->expect(undef,'#')) {

my $read = $exp->match(); 
print "read $read #############\n\n";
#$read = "junos-srx-ffp-vsrx-15.1-2015-04-22.1_X_151_X49-domestic.tgz";
#if ($read =~ /.*(junos.*tgz).*/m) {
if ($read =~ /.*/) {
    my $image = $1;
    print "image is $image\n\n\n\n\n\n\n\n\n\n"; 
#    put_log("\n Create daily signature files directory successfully! \n\n");
}
}
$exp->send("scp $image root\@$device:/var/log/\n") if ($exp->expect(300,'>>'));
$exp->send("Embe1mpls\n") if ($exp->expect(undef,'Password:')); 
$exp->send("./cimage.exp $device $file\n") if ($exp->expect(300,'>>'));
#$exp->send("./ssl_sendback.exp 10.208.128.32 regress MaRtInI JX46_TPI21633_EWF_cache.pl.17165.log\n") if ($exp->expect(undef,'>>'));
#$exp->send("scp $ARGV[0] regress\@10.208.128.32:/tmp/\n") if ($exp->expect(undef,'>>'));
$exp->send("exit\n") if ($exp->expect(undef,'>>'));
#$exp->log_file(undef);
