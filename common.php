<?php
	namespace common;
date_default_timezone_set('Asia/Tokyo');

function get_nTry(){
return get_second_param()=="true" ? 2 : 1;//1回目か2回目か
}

function get_second_param(){
if(!isset($_REQUEST["second"])){
$second="false";
}else{
$second=$_REQUEST["second"];
if($second!="true") $second="false";
}
return $second;
}

function print_hooter(){
echo("<p class=\"copyright\">Copyright (C) 2019 Yukio Nozawa</p>");
}

?>