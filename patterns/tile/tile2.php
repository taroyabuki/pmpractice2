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
      <th>Mon</th>
      <th>Tue</th>
      <th>Wed</th>
      <th>Thu</th>
      <th>Fri</th>
      <th>Sat</th>
    </tr>
    <tr>
      <th>9</th>
      <?php createTd('9', 'Mon'); ?>
      <?php createTd('9', 'Tue'); ?>
      <?php createTd('9', 'Wed'); ?>
      <?php createTd('9', 'Thu'); ?>
      <?php createTd('9', 'Fri'); ?>
      <?php createTd('9', 'Sat'); ?>
    </tr>
    <tr>
      <th>10</th>
      <?php
      # 面倒だからループにした．
      foreach($days as $col) {
        createTd(10, $col);
      }
      ?>
    </tr>
    <tr>
      <th>11</th>
      <?php
      # 面倒だからループにした．
      foreach($days as $col) {
        createTd(11, $col);
      }
      ?>
    </tr>
  </table>
</body>

</html>