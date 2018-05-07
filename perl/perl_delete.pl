 #
 # Copyright (c) 2017-2018 Barchampas Gerasimos <makindosx@gmail.com>
 # QR-sms is a sms getaway with qrcode for verification (etc).
 #
 # QR-sms is free software: you can redistribute it and/or modify
 # it under the terms of the GNU Affero General Public License as
 # published by the Free Software Foundation, either version 3 of the
 # License, or (at your option) any later version.
 #
 #
 # QR-sms is distributed in the hope that it will be useful,
 # but WITHOUT ANY WARRANTY; without even the implied warranty of
 # MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 # GNU Affero General Public License for more details.
 #
 # You should have received a copy of the GNU Affero General Public License, version 3,
 # along with this program.  If not, see <http://www.gnu.org/licenses/>
 #
 #


#!/usr/bin/perl


print "---------------------------------------------------\n";
print "SMS PROGRAM DELETE USER PASSWORD FOR CONTROL PANEL:\n";
print "---------------------------------------------------\n";

print "Give your username:";
$username =  <STDIN>;
chomp ($username);


print "Give new password:";
$pass =  <STDIN>;
chomp ($pass);


use Digest::MD5 qw(md5 md5_hex md5_base64);

my $password = $pass;

my $encpass = md5_hex($password);



my @chars = ("a".."z", "0".."9");
my $cookies;
$cookies .= $chars[rand @chars] for 1..32;


use DBI;

my $driver = "mysql"; 
my $db = "sms";
my $link = "DBI:$driver:database=$db";
my $user = "sms";
my $pass = "6983450";

my $conn = DBI->connect($link, $user, $pass ) or die $DBI::errstr;



my $sth = $conn->prepare("delete from login
                          where username = '$username' and password='$encpass'");


$sth->execute();
$sth->finish();

;
