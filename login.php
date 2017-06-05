<?php
	require("login.html");

	$postData = array(
    'txtLoginID' => '1602-15-737-073',
    'txtPWD' => 'chlore',
    'btnLogin' => true,
    'redirect_to' => 'http://vce.ac.in/index.aspx',
    'testcookie' => '1'
	);

	$ch=curl_init();
	curl_setopt_array($ch, array(
    CURLOPT_URL => 'http:/vce.ac.in',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_FOLLOWLOCATION => true
	));

$output = curl_exec($ch);
echo $output;
?>