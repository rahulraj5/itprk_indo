<?php defined('BASEPATH') OR exit('No direct script access allowed');
function getWebOption($option_name)
{
	$ci =&get_instance();
	$data = $ci->UserModel->getSingleData("common_setting",array("option_name" => $option_name));
	return $data;
}

if (!function_exists('single_price')){
    function single_price($price)
    {
        return format_price(convert_price($price));
    }
}

function getWebOptionValue($option_name)
{
	$ci =&get_instance();
	$optdata = $ci->UserModel->getWhereDataByCol("common_setting",array("option_name" => $option_name),"option_value");
  	$opt = (!empty($optdata))? $optdata : "";
	return $opt;
}

function getWebPagesValue($option_name,$col)
{
	$ci =&get_instance();
	$optdata = $ci->Common_model->getWhereDataByCol("pages",array("option_name" => $option_name),$col);
  	$opt = (!empty($optdata))? $optdata : "";
	return $opt;
}

function getcolornamebyid($code)
{
	$ci =&get_instance();
	$optdata = $ci->Common_model->getWhereDataByCol("colors",array("code" => $code),'name');
  	$opt = (!empty($optdata))? $optdata : "";
	return $opt;
}

function shoptypebytid($shop_type_id){
	$ci =&get_instance();
	$optdata = $ci->UserModel->getWhereDataByCol("shop_types",array("shop_type_id" => $shop_type_id),"shop_type_name");
  	$opt = (!empty($optdata))? $optdata : "";
	return $opt;
}

function getcategoryidbyname($catname){
    $ci =&get_instance();
    $optdata = $ci->Common_model->getSingleRecordById("categories",array("category_name" => $catname));
    $opt = (!empty($optdata))? $optdata['categories_id'] : "";
    return $opt;
}

function createRandomCode(){ 
	$chars = "023456789ABCDEFGHIJKLMNOPQRST";
	srand((double)microtime()*1000000);
	$i = 0; 
	$pass = '' ; 
	while ($i <= 8) { 
		$num = rand() % 33;
		$tmp = substr($chars, $num, 1);
		$pass = $pass . $tmp; 
		$i++; 
	} 
	return $pass; 
}

function checkTabActive($fun)
{ 
  $ci = &get_instance();
  $f_name = $ci->router->fetch_method();
  //p($fun);
  if(in_array($f_name, $fun))   
    {
      return true;
    }else
    {
      return false;
    }
}

function generateRandomStringbylnth($length) {
    $characters = '01234567890123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sendsms($to,$countrycode,$sms){
	return true;
	// $curl = curl_init();

 //    curl_setopt_array($curl, array(
 //        CURLOPT_URL => "https://api.msg91.com/api/v2/sendsms",
 //        CURLOPT_RETURNTRANSFER => true,
 //        CURLOPT_ENCODING => "",
 //        CURLOPT_MAXREDIRS => 10,
 //        CURLOPT_TIMEOUT => 30,
 //        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
 //        CURLOPT_CUSTOMREQUEST => "POST",
 //        CURLOPT_POSTFIELDS => "{ \"sender\": \"MLMART\", \"route\": \"4\", \"country\": \"".$countrycode."\", \"sms\": [ { \"message\": \"".$sms."\", \"to\": [ \"".$to."\"] } ] }",
 //        CURLOPT_SSL_VERIFYHOST => 0,
 //        CURLOPT_SSL_VERIFYPEER => 0,
 //        CURLOPT_HTTPHEADER => array(
 //            "authkey: 323918AbqIo0skI4q5e71ee7aP1",
 //            "content-type: application/json"
 //        ),
 //    ));
    
 //    $response = curl_exec($curl);
 //    $err = curl_error($curl);
    
 //    curl_close($curl);
    
 //    if ($err) {
	//   echo "cURL Error #:" . $err;
	// 	return false;
	// } else {
	//   return true;
	// }
	
	
	
}

function sendotp($to,$countrycode,$otp){
// 	return true;
// 	$curl = curl_init();

// 	curl_setopt_array($curl, array(CURLOPT_URL => "https://api.msg91.com/api/v5/otp?authkey=323918AbqIo0skI4q5e71ee7aP1&template_id=5ef32ab2d6fc0550a53f2e48&otp=".$otp."&extra_param=%7B%2522COMPANY_NAME%2522:%2522Meralocal%2520Mart%2522%7D&mobile=".$countrycode.$to."",
// 	  CURLOPT_RETURNTRANSFER => true,
// 	  CURLOPT_ENCODING => "",
// 	  CURLOPT_MAXREDIRS => 10,
// 	  CURLOPT_TIMEOUT => 30,
// 	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	  CURLOPT_CUSTOMREQUEST => "GET",
// 	  CURLOPT_SSL_VERIFYHOST => 0,
// 	  CURLOPT_SSL_VERIFYPEER => 0,
// 	  CURLOPT_HTTPHEADER => array(
// 	    "content-type: application/json"
// 	  ),
// 	));
    
//      $response = curl_exec($curl);
//      $err = curl_error($curl);
    
//      curl_close($curl);
    
//      if ($err) {
// 	  echo "cURL Error #:" . $err;
// 		return false;
// 	} else {
// 	  return true;
// 	}

    // $apiKey = urlencode('7VW6mkvKPvQ-lj5LASCrpGRup9t0UHTQweqlMtQDjL');
	
	// // Message details
	$numbers = $countrycode.$to;
	// $sender = urlencode('TXTLCL');
	$message = $otp;
 
	// $numbers = implode(',', $numbers);
 
	// // Prepare data for POST request
	// $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// // Send the POST request with cURL
	// $ch = curl_init('https://api.textlocal.in/send/');
	// curl_setopt($ch, CURLOPT_POST, true);
	// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// $response = curl_exec($ch);
	// curl_close($ch);
	
	// // Process your response here
	// echo $response;

	//Your authentication key
	$authKey = "17049A3fMrSex5f51bef3P15";

	//Multiple mobiles numbers separated by comma
	$mobileNumber = $to;

	//Sender ID,While using route4 sender id should be 6 characters long.
	$senderId = "INDOCQ";

	//Your message to send, Add URL encoding here.
	$message = urlencode($message);

	//Define route 
	$route = "8";
	//Prepare you post parameters
	$postData = array(
		'authkey' => $authKey,
		'mobiles' => $numbers,
		'message' => $message,
		'sender' => $senderId,
		'route' => $route
	);

	//API URL
	$url="http://login.ibittechnologies.in/api/sendhttp.php";

	// init the resource
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $postData
		//,CURLOPT_FOLLOWLOCATION => true
	));


	//Ignore SSL certificate verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


	//get response
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;

	// //Print error if any
	// if(curl_errno($ch))
	// {
	// 	echo 'error:' . curl_error($ch);
	// }

	// curl_close($ch);

	// $url = 'http://login.ibittechnologies.in/api/optout.php?authkey=17049A3fMrSex5f51bef3P15?curl=basic&method=get';
	// $crl = curl_init();
	
	// curl_setopt($crl, CURLOPT_URL, $url);
	// curl_setopt($crl, CURLOPT_FRESH_CONNECT, true);
	// curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
	// $response = curl_exec($crl);
	
	// if(!$response){
	// 	die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
	// }
	// curl_close($crl);
	// print_r($response);die;
}

if (! function_exists('combinations')) {
    function combinations($arrays) {
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = array();
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }
}

function customersessionid(){
	$ci =&get_instance();	
	$session_userdata = $ci->session->userdata(USER_SESSION);
	return (isset($session_userdata['id']) ? $session_userdata['id'] : '');
}

function customerdata($id){
	$ci = &get_instance();
	$customerdata = $ci->Common_model->getSingleRecordById('users',array('id' => $id));
	return $customerdata;
}

function dateformatedmy($date){
	return date("d-m-Y", strtotime($date));  
}

function p($data)
{
	echo "<pre>"; print_r($data); die();
}

function dd($data)
{
	echo "<pre>"; print_r($data); die();
}
