<?php
require_once "common.php";
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<?php
echo ("<title> " . common\get_nTry() . "回目 - 実験ページ (1)</title>");
?>
<link rel="stylesheet" type="text/css" href="common.css">
</head>
<body >
<h1 class="exp_title_header">視覚障害者を対象とした、モダンなウェブ技術の学習フレームワークの開発と評価</h1>

<h2 class="exp_page_nav">ページ1: 商品検索</h2>
<p>ギブアップしてよろしいですか?</p>

<p><a href="index.php?giveup">はい、ギブアップする</a></p>
<a href="#" onclick="history.back(); return false;">いいえ、前のページに戻る</a></p>
</body>
</html>
