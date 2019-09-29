<?php
if(!isset($_REQUEST["name"]) || !isset($_REQUEST["subtotal"]) || !isset($_REQUEST["price"]) || !isset($_REQUEST["tax"]) || !isset($_REQUEST["postage"])){
die("このページを直接開くことはできません。");
}
require_once "common.php";
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<?php
echo("<title> ".common\get_nTry()."回目 - 実験ページ (5)</title>");
?>
<link rel="stylesheet" type="text/css" href="common.css">
<link rel="stylesheet" type="text/css" href="exp_common.css">
<link rel="stylesheet" type="text/css" href="exp_page6.css">
</head>
<body >
<h1 class="exp_title_header">視覚障害者を対象とした、モダンなウェブ技術の学習フレームワークの開発と評価</h1>

<h2 class="exp_page_nav">ページ6: テスト終了</h2>
<h2>注文が完了しました</h2>
<?php
echo("<p>".$_REQUEST["name"]."</p>\r\n");
$tax=$_REQUEST["tax"] == "1" ? "税抜き" : "税込み";
$postage=$_REQUEST["postage"] == "1" ? "送料別" : "送料込み";
echo("通常価格: ".$_REQUEST["price"]."円(".$tax."、".$postage.")</p>\r\n");
echo("今回のお支払金額: ".$_REQUEST["subtotal"]."円\r\n");
?>
<h2>お疲れ様でした！</h2>
<?php
echo("<p>".common\get_nTry()."セット目の実験が終了しました。</p>");
echo("<p>担当者に、実験終了を伝えてください。</p>");
common\print_hooter();
?>
</body>
</html>
