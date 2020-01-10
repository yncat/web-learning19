<?php
if (!isset($_REQUEST["code"])) {
    die("このページを直接開くことはできません。");
}
require_once "common.php";
require_once "lib/rakuten/autoload.php";
require_once "token.php";

$client = new RakutenRws_Client();
$client->setApplicationId($RAKUTEN_APPLICATION_ID);
$response = $client->execute('IchibaItemSearch', array('itemCode' => $_REQUEST["code"]));
if (!$response->isOk()) {
    die("API error: " . $response->getMessage());
}
$found_count = $response['count'];
foreach ($response as $item) {
    $target = array($item['itemName'], $item['itemPrice'], $item['itemCaption'], $item['taxFlag'], $item['postageFlag']);
}
common\run_timekeeper_command("report-elapsed");
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<?php
echo ("<title> " . common\get_nTry() . "回目 - 実験ページ (3)</title>");
echo(common\uikit_loading_code());
?>
<link rel="stylesheet" type="text/css" href="common.css">
<link rel="stylesheet" type="text/css" href="exp_common.css">
<link rel="stylesheet" type="text/css" href="exp_page3.css">
</head>
<body >
<h1 class="exp_title_header">視覚障害者を対象とした、モダンなウェブ技術の<br>学習フレームワークの開発と評価</h1>

<h2 class="exp_page_nav">ページ3: 商品の詳細</h2>
<p>選んだ商品の詳しい情報を表示しています。情報を読んだら、「カートに入れる」ボタンを押して、次に進みましょう。</p>
<?php
echo ("<h2>" . $target[0] . " の詳細</h2>\r\n");
$tax = $target[3] == "1" ? "税抜き" : "税込み";
$postage = $target[4] == "1" ? "送料別" : "送料込み";
echo ("価格: " . $target[1] . "円(" . $tax . "、" . $postage . ")</p>\r\n");
echo ("<p>" . $target[2] . "</p>\r\n");
echo ("<p><button type=\"button\" onclick=\"location.href='exp_page4.php?second=" . common\get_second_param() . "&name=" . $target[0] . "&price=" . $target[1] . "&tax=" . $target[3] . "&postage=" . $target[4] . "'\">カートに入れる</button></p>");
?>
<p><a href="#" onclick="history.back(); return false;">検索結果一覧に戻る</a></p>
<?php
echo ("<p><a href=\"exp_page1.php?second=" . common\get_second_param() . "\">別のキーワードで検索</a></p>");
common\print_hooter();
?>
</body>
</html>
