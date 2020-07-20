# タイル表示（実装）

次のようなタイル表示を実現します．
この例は，予定表のようなものを想定していますが，予約状況の表示などに応用することもできるでしょう．

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
    <td></td>
    <td style="background:red;">あり</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <th>10</th>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td style="background:red;">あり</td>
    <td></td>
  </tr>
  <tr>
    <th>11</th>
    <td></td>
    <td></td>
    <td></td>
    <td style="background:red;">あり</td>
    <td></td>
    <td></td>
  </tr>
</table>

ここでは，パターンを提示して終わりではなく，どうやって作っていくかも説明します．

## データベース

予定を管理するテーブルを作り，サンプルデータを入れます．

```sql
use mydb;

drop table if exists table3;

create table table3 (
  id int primary key auto_increment,
  row varchar(40) not null, # 行
  col varchar(40) not null  # 列
);

insert into table3(row, col) values
('9', 'Tue'),
('11', 'Thu'),
('10', 'Fri');
```

## URL

赤でないところをクリックしたときに赤に変わるようにしたいです．
そのために，どこがクリックされたのかわかるように，URLを決めておきます．
予定を追加するという意味で`add.php`，行を表すパラメータを`row`，列を表すパラメータを`col`にしましょう．
たとえば，Satの11がクリックされたときのURLを，`add.php?row=11&col=Sat`とします．

## add.php

[add.php](add.php)を実装します．
これは，[データの追加](../post/)とだいたい同じなのですが，URLからデータを取り出すので，`$_POST`ではなく`$_GET`を使います．
（「予定を追加する」という意味ではPOSTが正しいのですが，この辺は気楽に考えましょう．）

```php
# 送信されたデータの取得
$row = $_GET['row'];
$col = $_GET['col'];

require 'db.php'; # 接続
$sql = 'insert into table3 (row, col) values (:row, :col)';
$prepare = $db->prepare($sql); # 準備

$prepare->bindValue(':row', $row, PDO::PARAM_STR); # 埋め込み1
$prepare->bindValue(':col', $col, PDO::PARAM_STR); # 埋め込み2

$prepare->execute(); # 実行
```

**http://localhost/add.php?row=11&col=Sat にアクセスしてから，データベースで`select * from table3;`の結果を確認してみましょう．**

## HTMLとCSS

表示する部分は，PHPで実装する前に，HTMLとCSSで作ってみましょう．
いきなりプログラムを書ける人はそれでいいのですが，そうでない人は，まず，プログラムがどういうHTMLを生成するのかを具体化しましょう．

できあがりの[tile.html](tile.html)から，table要素だけ抜き出します．

```html
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
    <td><a href='add.php?row=9&col=Mon'>追加</a></td>
    <td class="r">あり</td>
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
```

class属性値`r`のところを赤くしたいので，次のようなCSSを書きます（[style.css](style.css)）．

```css
td.r {
  background: red;
}
```

## PHP

データベースの内容を反映した表を表示する，[tile.php](tile.php)を作ります．

全部作るのは大変なので，Monの9とTueの9だけ作ります．（最低限の動作確認はできます．）

Monの9の中身は，次のように作ります．

1. データベースにrow='9' & col='Mon'のデータを問い合わせる．
1. 結果があるなら「あり」，
1. 結果がないなら「`add.php?row=9&col=Mon`」へのリンクを作る．

```php
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
```

この方法は，各セルごとにデータベースに問い合わせるので，かなり効率が悪いです．
サンプルのテーブルでも，5*3=15回の問合せが必要です．
本当は1回でやってしまうのがいいのですが，ここでは，PHP側のプログラムを単純にするために，このような実装をしています．

http://localhost/tile.php で結果を確認しましょう．

## 実装の工夫1

とはいえ，各セルに同じようなコードを書くのは大変なので，[tile2.php](tile2.php)のように，関数を呼び出すだけでいいようにしましょう．
よくわからなければ，table1.phpのままでいいです．

http://localhost/tile2.php で結果を確認しましょう．

## 実装の工夫2

さらに，[tile3.php](tile3.php)のようにループを使うようにすれば，プログラムはかなり単純になります．
よくわからなければ，table1.phpやtile2.phpのままでいいです．

http://localhost/tile3.php で結果を確認しましょう．
