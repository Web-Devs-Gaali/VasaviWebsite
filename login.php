<?php
	$username = "1602-15-737-073"; 
$password = "chlore"; 
$fields = "txtLoginID=" . $username . "&txtPWD=" . $password . "&btnLogin=true"; 
$ch=curl_init(); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 

curl_setopt($ch, CURLOPT_URL, 'http://vce.ac.in/index.aspx'); 
curl_setopt($ch, CURLOPT_HEADER, 0); 
curl_setopt($ch, CURLOPT_COOKIEJAR, "ASPSESSIONIDSQADDRBQ=OCALKIGABGLPCJLKMGIKJLLF"); //I got this exact cookiename from LiveHTTPheaders (Firefox extension)
curl_setopt($ch, CURLOPT_COOKIEFILE, "ASPSESSIONIDSQADDRBQ=OCALKIGABGLPCJLKMGIKJLLF"); 
curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1000 ); 
curl_setopt($ch, CURLOPT_TIMEOUT, 10000 ); 
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.0.8) Gecko/20061025 Firefox/1.5.0.8' ); 
curl_setopt($ch, CURLOPT_AUTOREFERER, 1 ); 
curl_setopt ($ch, CURLOPT_REFERER, "http://vce.ac.in"); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0 ); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0 ); 
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields); 
ob_start(); //the issue with the script remains with/without ob_start/ob_end_clean
$raw_data=curl_exec($ch); 
curl_setopt($ch, CURLOPT_POST, 0); //at this point im trying to get another page using curl. since i will not be using post i have set it to 0.
curl_setopt($ch, CURLOPT_URL, 'http://vce.ac.in'); 
$ttable = curl_exec($ch); 
ob_end_clean(); 
echo $ttable; 
//curl_close($ch); 
//$raw_data = preg_replace('/\s(1,)/',' ',$raw_data); //clean it up 
//echo $raw_data; 
//$raw_data = stripslashes($raw_data); 
//$raw_data = explode("<strong>",$raw_data); 
//2 3 and 4 
//echo htmlentities($raw_data[4]); 
?> 

