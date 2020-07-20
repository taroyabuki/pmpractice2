<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <link rel='stylesheet' href='style.css' />
    <title>特定のデータの表示</title>
  </head>
  <body>

<?php
$id = $_GET['id']; # URLからIDを取得

require 'db.php';                                # 接続
$sql = 'SELECT * FROM table2 where id=:id';      # SQL文
$prepare = $db->prepare($sql);                   # 準備
$prepare->bindValue(':id', $id, PDO::PARAM_STR); # 番号の埋め込み
$prepare->execute();                             # 実行
$result = $prepare->fetchAll(PDO::FETCH_ASSOC);  # 結果の取得

foreach ($result as $row) {
  $id       = h($row['id']);
  $varcharA = h($row['varcharA']);
  $intA     = h($row['intA']);
  $intB     = h($row['intB']);
  $varcharB = h($row['varcharB']); # 画像ファイル名
  $image = '';           # 画像なしの場合
  if ($varcharB != '') { # 画像ありの場合
    $image = "<img src='img/{$varcharB}' />";
  }
  echo '<table>' .
    "<tr><th>ID</th><td>{$id}</td></tr>".
    "<tr><th>商品名</th><td>{$varcharA}</td></tr>".
    "<tr><th>価格</th><td>{$intA}</td></tr>".
    "<tr><th>在庫</th><td>{$intB}</td></tr>".
    "<tr><th>画像</th><td>{$image}</td></tr>".
    '</table>';
}
?>

  </body>
</html>