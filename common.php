<?php
	namespace common;
date_default_timezone_set('Asia/Tokyo');

function get_nTry(){
return isset($_REQUEST["second"]) ? 2 : 1;//1回目か2回目か
}

function print_hooter(){
echo("<p class=\"copyright\">Copyright (C) 2019 Yukio Nozawa</p>");
}
?>