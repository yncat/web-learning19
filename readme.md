## 卒論の実験プログラム

頑張りたい。卒業したい。  

## 起動方法
phpで動くので、先にphpのデバッグ用サーバを立ち上げておく必要があります。このリポジトリにコピーを同梱しています。

php\php -S localhost:3000

あとは、ブラウザで localhost:3000 を叩けばメインページが出るはず。

## 必要なトークンについて

内部で、楽天商品検索のAPIを利用しており、アクセストークンが必要です。中の人が使っているトークンを個人的にもらってくるか、以下の書式で ./token.php に書いてください。

<?php

$RAKUTEN_APPLICATION_ID="払い出したApplication ID";

$RAKUTEN_AFFILIATE_ID="払い出したAffiliate ID";

?>

