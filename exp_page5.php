<?php
if (!isset($_REQUEST["name"]) || !isset($_REQUEST["subtotal"]) || !isset($_REQUEST["price"]) || !isset($_REQUEST["tax"]) || !isset($_REQUEST["postage"])) {
    die("このページを直接開くことはできません。");
}
require_once "common.php";
common\run_timekeeper_command("report-elapsed");
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<?php
echo ("<title> " . common\get_nTry() . "回目 - 実験ページ (5)</title>");
?>
<link rel="stylesheet" type="text/css" href="common.css">
<link rel="stylesheet" type="text/css" href="exp_common.css">
<link rel="stylesheet" type="text/css" href="exp_page5.css">
</head>
<body >
<script src="exp_page5.js"></script>
<h1 class="exp_title_header">視覚障害者を対象とした、モダンなウェブ技術の<br>学習フレームワークの開発と評価</h1>

<h2 class="exp_page_nav">ページ5: 認証</h2>
<p>セキュリティ確保のため、手続きを完了するまえに、音声による認証を行う必要があります。「再生」ボタンを押し、聞こえてくる5桁の数字を、下のボックスに入力してください。入力が完了したら、「確認」ボタンを押してください。</p>
<h2>商品情報</h2>
<?php
echo ("<p>" . $_REQUEST["name"] . "</p>\r\n");
$tax = $_REQUEST["tax"] == "1" ? "税抜き" : "税込み";
$postage = $_REQUEST["postage"] == "1" ? "送料別" : "送料込み";
echo ("通常価格: " . $_REQUEST["price"] . "円(" . $tax . "、" . $postage . ")</p>\r\n");
echo ("今回のお支払金額: " . $_REQUEST["subtotal"] . "円\r\n");
?>
<h2>音声による認証</h2>
<form action="exp_page6.php" onsubmit="return submitHook();">
<p><button type="button" id="play_button" onclick="playCaptcha();">再生</button></p>
<label>聞こえた数字: <input class="captcha_textfield" type="text" maxlength="5" id="captcha_input" name="captcha" required="true"></label>
<?php
echo ("<input type=\"hidden\" name=\"name\" value=\"" . $_REQUEST["name"] . "\">");
echo ("<input type=\"hidden\" name=\"price\" value=\"" . $_REQUEST["price"] . "\">");
echo ("<input type=\"hidden\" name=\"subtotal\" value=\"" . $_REQUEST["subtotal"] . "\">");
echo ("<input type=\"hidden\" name=\"tax\" value=\"" . $_REQUEST["tax"] . "\">");
echo ("<input type=\"hidden\" name=\"postage\" value=\"" . $_REQUEST["postage"] . "\">");
echo ("<input type=\"hidden\" name=\"second\" value=\"" . common\get_second_param() . "\">");
?>
<p><input type="submit" value="認証"></p>
</form>
<?php
common\print_hooter();
?>
</body>
</html>
