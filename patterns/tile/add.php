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
$row = $_GET['row'];
$col = $_GET['col'];

require 'db.php'; # 接続
$sql = 'insert into table3 (row, col) values (:row, :col)';
$prepare = $db->prepare($sql); # 準備

$prepare->bindValue(':row', $row, PDO::PARAM_STR); # 埋め込み1
$prepare->bindValue(':col', $col, PDO::PARAM_STR); # 埋め込み2

$prepare->execute(); # 実行
?>
    <p><?php echo "追加：{$row}, {$col}";?></p>
    <p><a href="table2.php">確認</a></p>
  </body>
</html>