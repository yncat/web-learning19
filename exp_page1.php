<?php
require_once "common.php";
require_once "lib/rakuten/autoload.php";
require_once "token.php";
common\run_timekeeper_command("start");
$client = new RakutenRws_Client();
$client->setApplicationId($RAKUTEN_APPLICATION_ID);
$response = $client->execute('IchibaGenreSearch', array('genreId' => 0));
if (!$response->isOk()) {
    die("API error: " . $response->getMessage());
}
$genre_names = array("全てのジャンル");
$genre_ids = array(0);
foreach ($response['children'] as $childGenre) {
    $genre = $childGenre['child'];
    array_push($genre_names, $genre['genreName']);
    array_push($genre_ids, $genre['genreId']);
}
$genre_names_json = json_encode($genre_names);
$genre_ids_json = json_encode($genre_ids);
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<?php
echo ("<title> " . common\get_nTry() . "回目 - 実験ページ (1)</title>");
echo(common\uikit_loading_code());
?>
<link rel="stylesheet" type="text/css" href="common.css">
<link rel="stylesheet" type="text/css" href="exp_common.css">
<link rel="stylesheet" type="text/css" href="exp_page1.css">
<link rel="stylesheet" type="text/css" href="lib/aria-menubutton/menuButtonAction.css">
</head>
<body >
<script src="lib/aria-menubutton/Menubutton.js"></script>
<script src="lib/aria-menubutton/PopupMenuAction.js"></script>
<script src="lib/aria-menubutton/MenuItemActionActivedescendant.js"></script>
<script src="lib/aria-menubutton/PopupMenuActionActivedescendant.js"></script>
<script src="exp_page1.js"></script>

<script type="text/javascript">
var genre_names=JSON.parse('<?php echo $genre_names_json; ?>');
var genre_ids=JSON.parse('<?php echo $genre_ids_json; ?>');
</script>

<h1 class="uk-text-center">視覚障害者を対象とした、モダンなウェブ技術の<br>学習フレームワークの開発と評価</h1>

<h2>ページ1: 商品検索</h2>
<div class="uk-section uk-section-xsmall">
<p>以下の検索フォームから、ほしい商品を探してください。探すものはなんでもかまいません。思いつかない場合は、適当に「お菓子」でいきましょう。</p>
</div>

<div class="uk-section uk-section-small">
<h2>商品を探す</h2>
<div>
<label>キーワード: <input type="text" id="search_keyword_input"></label>
<p id="current_genre" aria-live="polite">ジャンルを選択してください</p>

<div class="menu_button">
<button id="menubutton1" aria-haspopup="true" aria-controls="menu1">ジャンルを選択</button>
<ul id="menu1" role="menu" aria-labelledby="menubutton1" aria-activedescendant="mi1">
<?php
echo ("<li id=\"mi1\" role=\"menuitem\" onclick=\"updateLastAction(event)\">全てのジャンル</li>\r\n");
$count = 2;
foreach ($response['children'] as $childGenre) {
    $genre = $childGenre['child'];
    echo ("<li id=\"mi" . $count . "\" role=\"menuitem\" onclick=\"updateLastAction(event)\">" . $genre['genreName'] . "</li>\r\n");
    $count += 1;
}
?>
</ul>
</div>
<?php
echo ("<button type=\"button\" class=\"uk-button uk-button-default\" onclick=\"return validateInput('" . common\get_second_param() . "');\">検索開始</button>\r\n");
echo ("</div>\r\n");
common\print_hooter();
?>
</div>
</body>
</html>
