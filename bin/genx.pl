#!/usr/bin/perl
use MIME::Base64;
use Digest::SHA qw(sha1);
use POSIX;
use String::Random qw(random_string);
if ( $ARGV[0] ne "clean" )
{
	print "Nonce>";
	$nonce = <STDIN>;
	chomp $nonce;
	if ( $nonce eq "" )
	{
		print "No nonce provided. Using random string";
		$nonce = random_string("............");
		chomp($nonce);
		$nonce =~ s/\/|\\//g;
	}
	print "nonce is |$nonce|\n";
	print "Date>";
	$date = <STDIN>;
	chomp($date);
	if ( $date eq "" )
	{
		$date = strftime "%F %T", localtime $^T;
	}
	print "Username>";
	$username = <STDIN>;
	chomp($username);
	print "Password>";
	$password = <STDIN>;
	chomp($password);
}
else
{
	$date = strftime "%F %T", localtime $^T;
	$nonce = random_string("............");
	chomp($nonce);
	$username="dbuser";
	$password="salt";
}
print "Building new x-wsse token with \nDate of '$date'\nnonce of '$nonce'\nuser $username\npassword $password\n";
print "sha1 of nonce+date+password is: " . sha1($nonce.$date.$password) . "\n";
$digest = encode_base64(sha1($nonce.$date.$password));
print "digest is: " . $digest . "\n";
chomp($digest);
print "digest after chomp is: " . $digest . "\n";
$nonce_en = encode_base64($nonce);
print "base_64 encoded nonce is: " . $nonce_en . "\n";
chomp($nonce_en);
print "base_64 encoded nonce after chomp is: " . $nonce_en . "\n";
print 'UsernameToken Username="'.$username.'", PasswordDigest="'.$digest.'", Nonce="'.$nonce_en.'", Created="'.$date.'"'."\n";
