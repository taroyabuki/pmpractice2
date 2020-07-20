<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <link rel='stylesheet' href='style.css' />
    <title>データの追加完了</title>
  </head>
  <body>

<?php
# 送信されたデータの取得
$varcharA = $_POST['varcharA']; # 商品名
$intA = $_POST['intA'];         # 価格
$intB = $_POST['intB'];         # 在庫

require 'db.php'; # 接続
$sql = 'insert into table1 (varcharA, intA, intB) values (:varcharA, :intA, :intB)';
$prepare = $db->prepare($sql); # 準備

$prepare->bindValue(':varcharA', $varcharA, PDO::PARAM_STR); # 埋め込み1
$prepare->bindValue(':intA', $intA, PDO::PARAM_STR);         # 埋め込み2
$prepare->bindValue(':intB', $intB, PDO::PARAM_STR);         # 埋め込み3

$prepare->execute(); # 実行
?>

    <p><a href="pattern-table2.php">確認</a></p>
  </body>
</html>