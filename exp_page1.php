<?php
require_once "common.php";
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<?php
echo("<title> ".common\get_nTry()."回目 - 実験ページ (1)</title>");
?>
<link rel="stylesheet" type="text/css" href="common.css">
<link rel="stylesheet" type="text/css" href="exp_common.css">
<link rel="stylesheet" type="text/css" href="exp_page1.css">
<script src="exp_page1.js">
</head>
<body >
<h1 class="exp_title_header">視覚障害者を対象とした、モダンなウェブ技術の学習フレームワークの開発と評価</h1>

<h2 class="exp_page_nav">ページ1: 商品検索</h2>
<p>以下の検索フォームから、ほしい商品を探してください。探すものはなんでもかまいません。思いつかない場合は、適当に「お菓子」でいきましょう。</p>

<h2>商品を探す</h2>
<form action="exp_page2.php">
<label>キーワード: <input type="text" id="search_keyword_input"></label>
<input type="submit" value="検索開始" onclick="return validateInput();">
</form>
<?php
common\print_hooter();
?>
</body>
</html>
