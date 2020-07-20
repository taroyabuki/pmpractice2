<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <link rel='stylesheet' href='style.css' />
    <title>詳細検索</title>
  </head>
  <body>

<?php
$varcharA = $_GET['varcharA'];
$price = $_GET['price'];
$instock = isset($_GET['instock']) ? 0 : -1;

echo '送信されたデータ：<table>' .
     "<tr><th>varcharA</th><td>{$varcharA}</td></tr>" .
     "<tr><th>price</th><td>{$price}</td></tr>" .
     "<tr><th>instock</th><td>{$instock}</td></tr>" .
     '</table>';
?>

<table>
<caption>検索結果</caption>
  <tr>
    <th>ID</th>
    <th>商品名</th>
    <th>価格</th>
    <th>在庫</th>
  </tr>
<?php
require 'db.php';                               # 接続
# SQLが長いので，ヒアドキュメントという記法で書く（EOMからEOMまでが文字列）
$sql = <<< EOM
select * from table1
  where varcharA like :varcharA
    and intA <= :price
    and intB > :instock
EOM;
$prepare = $db->prepare($sql);                  # 準備
$prepare->bindValue(':varcharA', "%{$varcharA}%", PDO::PARAM_STR);
$prepare->bindValue(':price', $price, PDO::PARAM_STR);
$prepare->bindValue(':instock', $instock, PDO::PARAM_STR);
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
    '</tr>';
}
?>
</table>
  </body>
</html>