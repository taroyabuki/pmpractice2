# PHPとMySQL

PHPからMySQLを操作する方法を説明します．
概要は次のとおりです．

1. 接続：PHPからMySQLに接続する．
1. 問合せ

## 1. 接続

話を簡単にするために，PHPからMySQLに接続するための作業を[`db.php`](db.php)にまとめておきます．（[データベースの操作](sql.md)で作業したように，データベース`mydb`に，ユーザ名`testuser`，パスワード`pass`でアクセスできるようになっていることが前提です．）

**[`db.php`](db.php)をドキュメントルートにおいて，http://localhost/db.php にアクセスし，「Can't connect to the database: 」と表示されないことを確かめてください．（うまく行った場合は，何も表示されません．）**

```
mydbを作っていない場合のエラー：
Can't connect to the database: SQLSTATE[HY000] [1049] Unknown database 'mydb'

権限を設定していない場合のエラー：
```Can't connect to the database: SQLSTATE[HY000] [1045] Access denied for user 'testuser'@'localhost' (using password: YES)
```

データベースを使いたいときは，`db.php`を読み込みます．

**次のようなコードを含む[`hello-db1.php`](hello-db1.php)を作り，http://localhost/hello-db1.php にアクセスして，エラーが表示されないことを確かめてください．**

```html
<?php require 'db.php'; ?>
```

## 2. 問合せ

データベースを使う例として，テーブル`tableA`の全データを取り出して，表示させます．
手順は次のとおりです．

1. SQL実行
1. 結果の処理

### 2.1 SQL実行

テーブル`tableA`の全データを取り出すSQLは「`select * from tableA;`」です．（[データベースの操作](sql.md)のC2）

このSQL文をPHPで作り，実行します．
2行目以降は今は謎のままでかまいません．
（処理が別れている理由はだんだんわかっていくはずです．）

```php
$sql = 'SELECT * FROM tableA';                  # SQL文
$prepare = $db->prepare($sql);                  # 準備
$prepare->execute();                            # 実行
$result = $prepare->fetchAll(PDO::FETCH_ASSOC); # 結果の取得
```

### 2.2 結果の処理

[データベースの操作](sql.md)のとおり作業していると，データベースの中身は次のようになっています．

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

ちょっと面倒なのですが，データベースから取り出したデータを表示するときは，関数`h`を使うようにしします（クライアントから送信されたデータも）．そうしないと，「`x < 3`」のような文字列の`<`がタグの一部と見なされてしまいます．`h`は，このような特別な文字を変換する関数です（例：`<`→`&lt;`）．（`db.php`で定義しています．）

**以上のコードを含む[`hello-db2.php`](hello-db2.php)を作り，http://localhost/hello-db2.php でデータが表示されることを確かめてください．**

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

**以上のコードを含む[`hello-db3.php`](hello-db3.php)を作り，http://localhost/hello-db3.php でデータが表示されることを確かめてください．**