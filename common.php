<?php
	namespace common;
date_default_timezone_set('Asia/Tokyo');

function run_timekeeper_command($cmd){
$descriptorspec = array(
0 => array("pipe", "r"),
1 => array("pipe", "w"),
2 => array("pipe", "w")
);
$cwd=dirname(__FILE__);
proc_open("timekeeper\\timekeeper.exe ".$cmd,$descriptorspec,$pipes,$cwd,null,array('bypass_shell'=>true));
}

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
if(get_nTry()==1){
echo("<a href=\"giveup.php\">ギブアップする</a>");
}
echo("<p class=\"copyright\">Copyright (C) 2019 Yukio Nozawa</p>");
}

?>