# 全データ表示（実装）

テーブル`table1`の全データを取り出して，表示させます．

![](pattern-show-all.png)

手順は次のとおりです．

1. SQLの実行
1. 結果の処理

## 1 SQLの実行

テーブル`table1`の全データを取り出すSQLは「`select * from table1`」です（[データベースの操作](/docs/sql.md)のC2）．

このSQL文をPHPで作り，実行します．
2行目以降は今は謎のままでかまいません．
（処理が別れている理由はだんだんわかっていくはずです．）

```php
require 'db.php';                               # 接続
$sql = 'SELECT * FROM table1';                  # SQL文
$prepare = $db->prepare($sql);                  # 準備
$prepare->execute();                            # 実行
$result = $prepare->fetchAll(PDO::FETCH_ASSOC); # 結果の取得
```

## 2 結果の処理

[データベースの操作](/docs/sql.md)のとおり作業していると，データベースの中身は次のようになっています．

id|varcharA|intA|intB
-:|--|-:|-:
2|B|2980|0
3|D|200|121

これがまとめて`$result`に入っているので，1行ずつ`$row$`という名前で取り出して，セルごとに表示させます．（`foreach ...`というのは，同じものについてくり返すときの決まり文句です．）

```php
foreach ($result as $row) {
  $id       = h($row['id']);
  $varcharA = h($row['varcharA']);
  $intA     = h($row['intA']);
  $intB     = h($row['intB']);
  echo "{$id}, {$varcharA}, {$intA}, {$intB}<br/>";
}
```

ちょっと面倒なのですが，データベースから取り出したデータを表示するときは，関数`h`を使うようにしします（クライアントから送信されたデータも）．そうしないと，「`x < 3`」のような文字列の`<`がタグの一部と見なされてしまいます．`h`は，このような特別な文字を変換する関数です（例：`<`→`&lt;`）．（[db.php](/db.php)で定義しています．）

**以上のコードを含む[`show-all1.php`](show-all1.php)を作り，http://localhost/show-all1.php でデータが表示されることを確かめてください．**

ちょっと味気ないので，結果を表にします．
HTMLのtable要素を使います．
最初にできあがりのHTMLを書いておくと，こんな感じです．

```html
<table>
  <tr>
    <th>ID</th>
    <th>商品名</th>
    <th>価格</th>
    <th>在庫</th>
  </tr>
  <tr>
    <td>2</td>
    <td>B</td>
    <td>2980</td>
    <td>0</td>
  </tr>
  <tr>
    <td>3</td>
    <td>D</td>
    <td>200</td>
    <td>121</td>
  </tr>
</table>
```

上のようなHTMLをPHPで作ります．

```html
<table>
  <tr>
    <th>ID</th>
    <th>商品名</th>
    <th>価格</th>
    <th>在庫</th>
  </tr>
<?php
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
```

**以上のコードを含む[`show-all2.php`](show-all2.php)を作り，http://localhost/show-all2.php でデータが表示されることを確かめてください．**

## 応用

別のパターン（[特定のデータの表示（実装）](../id/)）を実装すると，結果をリンクにできます．

[`show-all3.php`](show-all3.php)

show-all2.phpからの変更点は2箇所です．