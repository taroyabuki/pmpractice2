<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <link rel='stylesheet' href='style.css' />
    <title>チェックボックスの処理</title>
  </head>
  <body>
送信されたデータ
<pre>
<?php var_dump($_POST); ?>
</pre>

<?php
require 'db.php';
$sql = "update table1 set varcharA = concat(varcharA, '*') where id=:id";

foreach ($_POST['id'] as $id) {
    echo '<p>id = ' . h($id) . 'のvarcharAに「*」を追記します．</p>';

    $prepare = $db->prepare($sql);
    $prepare->bindValue(':id', $id, PDO::PARAM_STR);
    $prepare->execute();
}
?>

<p><a href="check-items.php">確認</a>
  </body>
</html>
