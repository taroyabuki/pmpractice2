<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <link rel='stylesheet' href='style.css' />
    <title>全データ表示（チェックボックス）</title>
  </head>
  <body>

<form action="checked.php" method="post">
<table>
  <caption>全データ</caption>
  <tr>
    <th>ID</th>
    <th>商品名</th>
    <th>価格</th>
    <th>在庫</th>
    <th>チェック</th>
  </tr>
<?php
require 'db.php';                               # 接続
$sql = 'SELECT * FROM table1';                  # SQL文
$prepare = $db->prepare($sql);                  # 準備
$prepare->execute();                            # 実行
$result = $prepare->fetchAll(PDO::FETCH_ASSOC); # 結果の取得

foreach ($result as $row) {
  $id       = h($row['id']);
  $varcharA = h($row['varcharA']);
  $intA     = h($row['intA']);
  $intB     = h($row['intB']);
  echo '<tr>' .
    "<td>{$id}</td>".
    "<td>{$varcharA}</td>".
    "<td>{$intA}</td>".
    "<td>{$intB}</td>".
    "<td><input type='checkbox' name='id[]' value='$id'</td>".
    '</tr>';
}
?>
</table>
<input type="submit" value="送信" />
</form>

  </body>
</html>
