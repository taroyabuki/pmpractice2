<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset='utf-8' />
  <link rel='stylesheet' href='style.css' />
  <title>予定表</title>
</head>
<?php 
require 'db.php'; # 接続
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
      <?php 
      $sql = "select * from table3 where row='9' and col='Mon'";
      $prepare = $db->prepare($sql);
      $prepare->execute();
      $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
      if ($result) echo '<td class="r">あり</td>';
      else echo '<td><a href="add.php?row=9&col=Mon">追加</a></td>';
      ?>
      <?php 
      $sql = "select * from table3 where row='9' and col='Tue'";
      $prepare = $db->prepare($sql);
      $prepare->execute();
      $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
      if ($result) echo '<td class="r">あり</td>';
      else echo '<td><a href="add.php?row=9&col=Tue">追加</a></td>';
      ?>
      <td><a href='add.php?row=9&col=Wed'>追加</a></td>
      <td><a href='add.php?row=9&col=Thu'>追加</a></td>
      <td><a href='add.php?row=9&col=Fri'>追加</a></td>
      <td><a href='add.php?row=9&col=Sat'>追加</a></td>
    </tr>
    <tr>
      <th>10</th>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td class="r">あり</td>
      <td></td>
    </tr>
    <tr>
      <th>11</th>
      <td></td>
      <td></td>
      <td></td>
      <td class="r">あり</td>
      <td></td>
      <td></td>
    </tr>
  </table>
</body>

</html>