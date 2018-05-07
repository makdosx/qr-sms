<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta content="text/html; charset=UTF8" http-equiv="Content-Type"/>
</head>

<title>liveAll.eu sms tester</title>
<body>
<?php
	require_once 'terracom-sms-helper2.php';
	
	$sms = new SMSHelper();
	
	// SMS data array collection - msg_id => message id, provided by your system.
	$sms_data = array(
		array(
			'destination' => '',
			'message' => 'To api leitourgei kanonika..euxaristoumepou empisteuthkate thn hphresia mas'
		)

	);
	
     $api_token = "01966e46d7601d01c72bd12983bd4a75f142b8a01805342b7ec8bd2ddccbf2a7";		// Found on https://www.liveall.eu/user and doc reference is here: https://www.liveall.eu/sms-services/httpapi
	$sender_name = "i-cube.gr";		// Max 11 characters
	
	$res = $sms->sendSMSMulti($sms_data, $api_token, $sender_name, 0);
	
	echo '<div style="color: #047C02"><b>Input:</b></div>' .  "<pre>" . print_r($sms_data, true) . '</pre><hr>';
	echo '<div style="color: #2105A7"><b>Result of operation:</b></div>' .  "<pre>" . print_r($res, TRUE) . "</pre>";
?>
</body>
</html>
