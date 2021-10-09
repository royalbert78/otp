<?php
$access_key = 'access_key_here';
echo "1.telegram\n2.twitter\n3.facebook\n4.gojek\nJust input number : ";
$service = trim(fgets(STDIN));
//this just only example service maybe you can see other service at service.txt
if ($service == 1) {
	$service = 'tg';
}else if ($service == 2) {
	$service = 'tw';
}else if ($service == 3) {
	$service = 'fb';
}else if ($service == 4) {
	$service = 'ni';
}

	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://sms-activate.ru/stubs/handler_api.php?api_key='.$access_key.'&action=getNumber&service='.$service.'&country=6');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	$exec = curl_exec($ch);
	preg_match('/ACCESS_NUMBER:(.*?):/', $exec,$id);
	$number = explode(':', $exec);
	print_r($number[2]);
	echo "\nDone send otp? y/n : ";
	$getotp = trim(fgets(STDIN));
if ($getotp == 'y') {
	sleep(5);
	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://sms-activate.ru/stubs/handler_api.php?api_key=8eb63331f79cb7eAAA755e1624566A9b&action=getStatus&id='.$id[1].'');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	$exec = curl_exec($ch);
	$otp = explode('STATUS_OK:', $exec);
	print_r($otp[1]);
}
