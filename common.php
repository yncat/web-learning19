<?php
namespace common;

date_default_timezone_set('Asia/Tokyo');

function run_timekeeper_command($cmd)
{
    $cwd = dirname(__FILE__);
    $f = fopen($cwd . "\\timekeeper\\__interprocessing__", "w");
    fwrite($f, $cmd);
    fclose($f);
}

function get_nTry()
{
    return get_second_param() == "true" ? 2 : 1; //1回目か2回目か
}

function get_second_param()
{
    if (!isset($_REQUEST["second"])) {
        $second = "false";
    } else {
        $second = $_REQUEST["second"];
        if ($second != "true") {
            $second = "false";
        }

    }
    return $second;
}

function print_hooter($showgiveup = true)
{
    if ($showgiveup && get_nTry() == 1) {
        echo ("<p><a href=\"giveup.php\">ギブアップする</a></p>");
    }
    echo ("<p class=\"uk-section uk-section-small\">Copyright (C) 2019 Yukio Nozawa</p>");
}

function uikit_loading_code(){
return '
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="uikit/css/uikit.min.css" />
<script src="uikit/js/uikit.min.js"></script>
';
}
