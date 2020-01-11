<?php
if (!isset($_REQUEST["keyword"]) || !isset($_REQUEST["genre"])) {
    die("このページを直接開くことはできません。");
}
require_once "common.php";
require_once "lib/rakuten/autoload.php";
require_once "token.php";

$client = new RakutenRws_Client();
$client->setApplicationId($RAKUTEN_APPLICATION_ID);
$response = $client->execute('IchibaItemSearch', array('keyword' => $_REQUEST["keyword"], 'genreId' => $_REQUEST["genre"]));
if (!$response->isOk()) {
    die("API error: " . $response->getMessage());
}
$found_count = $response['count'];
$items_table = array();
foreach ($response as $item) {
    $a = array($item['itemName'], $item['itemCode'], $item['itemPrice']);
    array_push($items_table, $a);
}
common\run_timekeeper_command("report-elapsed");
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<?php
echo ("<title> " . common\get_nTry() . "回目 - 実験ページ (2)</title>");
echo(common\uikit_loading_code());
?>
<link rel="stylesheet" type="text/css" href="common.css">
<link rel="stylesheet" type="text/css" href="exp_common.css">
<link rel="stylesheet" type="text/css" href="exp_page2.css">
</head>
<body >
<h1 class="uk-text-center">視覚障害者を対象とした、モダンなウェブ技術の<br>学習フレームワークの開発と評価</h1>

<h2>ページ2: 検索結果一覧</h2>
<div class="uk-section uk-section-xsmall">
<p>検索でヒットした商品を表示しています。気になる商品のリンクをクリックして、詳細ページに移動しましょう。</p>
</div>

<div class="uk-section uk-section-large">
<?php
echo ("<h2 class=\"uk-text-center\">検索結果 " . $found_count . "件のうち、最初の何件かを表示しています。</h2>\r\n");
$i=0;
foreach ($items_table as $elem) {
    echo ("<h3><a href=\"exp_page3.php?second=" . common\get_second_param() . "&code=" . $elem[1] . "\">" . $elem[0] . "</a></h3>\r\n");
    echo ("<p>価格: " . $elem[2] . "円</p>\r\n");
    echo("<hr class=\"uk-divider-small\">\r\n");
    if($i==3) break;//スクショしたいから、あんまり下に伸びても困る
}
?>
</div>
<a href="exp_page2.php">検索画面に戻る</a>
<?php
common\print_hooter();
?>
</body>
</html>
