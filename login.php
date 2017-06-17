<?php
//default raw post data for Vasavi website
//__VIEWSTATE=%2FwEPDwUKLTQzMjczNTk1OGRkSy5aZPIQCRnICRqsFtUMVV1Z1QE%3D&__VIEWSTATEGENERATOR=90059987&__EVENTVALIDATION=%2FwEWBAKF5%2BfkAwKdhdqTCgK9%2B7qcDgKC3IeGDO3I%2BiWkJ3Y14PHPL718yo5yjQgY&txtLoginID=1602-15-737-073&txtPWD=chlore&btnLogin=Go%21
//Upload a blank cookie.txt to the same directory as this file with a CHMOD/Permission to 777
// get simple_html_dom.php from : https://netix.dl.sourceforge.net/project/simplehtmldom/simple_html_dom.php
require_once('simple_html_dom.php');

function get_raw($url)
{

   $html = file_get_html( $url );

   foreach ($html->find('input') as $input){
       # echo "INPUTDOM". print_r($input);
       if ($input->attr['name']=="__VIEWSTATE"){
           //__VIEWSTATE
           //echo "__VIEWSTATE: {$input->attr['value']}\n";
           $form_data['__VIEWSTATE'] = $input->attr['value'];

       } elseif ($input->attr['name']=="__VIEWSTATEGENERATOR"){
           //__VIEWSTATEGENERATOR
           //echo "__VIEWSTATEGENERATOR: {$input->attr['value']}\n";
           $form_data['__VIEWSTATEGENERATOR'] = $input->attr['value'];

       } elseif ($input->attr['name']=="__EVENTVALIDATION"){
           //__EVENTVALIDATION
           //echo "__EVENTVALIDATION: {$input->attr['value']}\n";
           $form_data['__EVENTVALIDATION'] = $input->attr['value'];

       }
   };

   return $form_data;

}

function login($url,$data)
{
  $fp = fopen("cookie.txt", "w");
  fclose($fp);
  $login = curl_init();
  curl_setopt($login, CURLOPT_COOKIEJAR, "cookie.txt");
  curl_setopt($login, CURLOPT_COOKIEFILE, "cookie.txt");
  curl_setopt($login, CURLOPT_TIMEOUT, 40000);
  curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($login, CURLOPT_URL, $url);
  curl_setopt($login, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
  curl_setopt($login, CURLOPT_FOLLOWLOCATION, TRUE);
  curl_setopt($login, CURLOPT_POST, TRUE);
  curl_setopt($login, CURLOPT_POSTFIELDS, $data);
  ob_start();
  return curl_exec ($login);
  ob_end_clean();
  curl_close ($login);
  unset($login);
}

function grab_page($site)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
  curl_setopt($ch, CURLOPT_TIMEOUT, 40);
  curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
  curl_setopt($ch, CURLOPT_URL, $site);
  ob_start();
  return curl_exec ($ch);
  ob_end_clean();
  curl_close ($ch);
}

function post_data($site,$data)
{
  $datapost = curl_init();
  $headers = array("Expect:");
  curl_setopt($datapost, CURLOPT_URL, $site);
  curl_setopt($datapost, CURLOPT_TIMEOUT, 40000);
  curl_setopt($datapost, CURLOPT_HEADER, TRUE);
  curl_setopt($datapost, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($datapost, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
  curl_setopt($datapost, CURLOPT_POST, TRUE);
  curl_setopt($datapost, CURLOPT_POSTFIELDS, $data);
  curl_setopt($datapost, CURLOPT_COOKIEFILE, "cookie.txt");
  ob_start();
  return curl_exec ($datapost);
  ob_end_clean();
  curl_close ($datapost);
  unset($datapost);
}

function get_details($rawData)
{
  $loginID = $_POST['username'];
  $password = $_POST['password'];

  $loginData = "__VIEWSTATE=".urlencode($rawData['__VIEWSTATE'])."&__VIEWSTATEGENERATOR=".urlencode($rawData['__VIEWSTATEGENERATOR'])."&__EVENTVALIDATION=".urlencode($rawData['__EVENTVALIDATION'])."&txtLoginID=".$loginID."&txtPWD=".$password."&btnLogin=Go%21";
  
  login("http://vce.ac.in/index.aspx",$loginData);
  
  $grabHtml = grab_page("http://vce.ac.in/Student_Info.aspx");
  //save this to a cookie
  //helper function to identify div tags
  //changes here
}

/////code implementatiom/////
	
	include('login.html');
	if($_POST)
	{
		$html = ob_end_clean();
		get_details(get_raw('http://vce.ac.in/index.aspx'));
	}
	
	
?> 
