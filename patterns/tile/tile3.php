<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset='utf-8' />
  <link rel='stylesheet' href='style.css' />
  <title>予定表</title>
</head>
<?php 
require 'db.php'; # 接続

$days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

function createTd($row, $col) {
  global $db;
  $sql = "select * from table3 where row=$row and col='$col'";
  $prepare = $db->prepare($sql);
  $prepare->execute();
  $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
  if ($result) echo '<td class="r">あり</td>';
  else echo "<td><a href='add.php?row=$row&col=$col'>追加</a></td>";
}
?>
<body>
  <table>
    <tr>
      <th></th>
      <?php
      foreach($days as $col) {
        echo "<th>${col}</th>";
      }
      ?>
    </tr>
    <?php
    # 面倒だから二重ループにした．
    foreach(['9', '10', '11'] as $row) {
      echo '<tr>';
      echo "<th>${row}</th>";
      foreach($days as $col) {
        createTd($row, $col);
      }
      echo '</tr>';
    }
    ?>
  </table>
</body>

</html>