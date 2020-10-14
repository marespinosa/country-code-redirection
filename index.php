<?php
// /include __DIR__."/vars/default_vars.php";
function ip_info(){
  if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      //ip from share internet
      $ip = $_SERVER['HTTP_CLIENT_IP'];
  }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      //ip pass from proxy
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }else{
      $ip = $_SERVER['REMOTE_ADDR'];
  }
  $api_url="http://pro.ip-api.com/json/".$ip."?key=zHxTTJx30pJ4CNs";
  $json=json_decode(file_get_contents($api_url),TRUE);
  return strtolower($json['countryCode']);
}

error_reporting(0);
if(ip_info()){
  $country=ip_info();
}else{
  $country='us';
}

if ($country === 'gb') {
  require('gb-index.php');
} else {
  require('us-index.php');
}

?>