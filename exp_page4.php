<?php
if (!isset($_REQUEST["name"]) || !isset($_REQUEST["price"]) || !isset($_REQUEST["tax"]) || !isset($_REQUEST["postage"])) {
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
echo ("<title> " . common\get_nTry() . "回目 - 実験ページ (4)</title>");
echo(common\uikit_loading_code());
?>
<link rel="stylesheet" type="text/css" href="common.css">
<link rel="stylesheet" type="text/css" href="exp_common.css">
<link rel="stylesheet" type="text/css" href="exp_page4.css">
</head>
<body >
<h1 class="uk-text-center">視覚障害者を対象とした、モダンなウェブ技術の<br>学習フレームワークの開発と評価</h1>

<h2>ページ4: 注文確認画面</h2>
<p class="uk-section uk-section-xsmall">商品の価格や消費税、送料、割引などを確認できます。情報を確認したら、「購入する」ボタンを押して、次に進んでください。</p>
<div class="uk-section uk-section-large">
<h2 class="uk-text-center">商品情報</h2>
<?php
echo ("<p>" . $_REQUEST["name"] . "</p>\r\n");
$tax = $_REQUEST["tax"] == "1" ? "税抜き" : "税込み";
$postage = $_REQUEST["postage"] == "1" ? "送料別" : "送料込み";
echo ("価格: " . $_REQUEST["price"] . "円(" . $tax . "、" . $postage . ")</p>\r\n");
?>
</div>
<div class="uk-section uk-section-large">
<h2 class="uk-text-center">お支払い情報</h2>
<div class="uk-section uk-section-small">
<table class="uk-table" caption="お支払い情報">
<thead> <tr> <th>項目</th> <th>金額</th> </tr> </thead>
<tbody>
<?php
$price = (int) $_REQUEST["price"];
$tax_amount = 0;
$postage_amount = 0;
$discount_amount = ceil($price * 0.35);
if ($_REQUEST["tax"] == "1") {
    $tax_amount = $price * 0.1;
}

if ($_REQUEST["postage"] == "1") {
    $postage_amount = 500;
}

$subtotal = $price + $tax_amount + $postage_amount - $discount_amount;
echo ("<tr> <td>商品代金</td> <td>\\" . $price . "</td> </tr>\r\n");
echo ("<tr> <td>消費税</td> <td>\\" . $tax_amount . "</td> </tr>\r\n");
echo ("<tr> <td>送料</td> <td>\\" . $postage_amount . "</td> </tr>\r\n");
echo ("<tr> <td>特別割引</td> <td>-\\" . $discount_amount . "</td> </tr>\r\n");
echo ("<tr> <td>合計</td> <td>\\" . $subtotal . "</td> </tr>\r\n");
?>
</tbody>
</table>
</div>
<p class="uk-section uk-section-xsmall">以上のご注文でよろしければ、「注文する」ボタンを押してください。</p>
<?php
echo ("<button type=\"button\" class=\"uk-button uk-button-primary\" onclick=\"location.href='exp_page5.php?second=" . common\get_second_param() . "&name=" . $_REQUEST["name"] . "&subtotal=" . $subtotal . "&price=" . $_REQUEST["price"] . "&tax=" . $_REQUEST["tax"] . "&postage=" . $_REQUEST["postage"] . "'\">注文する</button>");
common\print_hooter();
?>
</body>
</html>
