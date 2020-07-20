# 画像の管理（実装）

データベースのアイテムに画像を対応させます．

![](pattern-images.png)

画像自体をデータベースで管理するのが正攻法ですが，ここでは話を簡単にするために，画像はデータベースではなくフォルダ`img`の中に入れ，データベースではファイル名だけを管理することにします．

## 画像の準備

ドキュメントルートのフォルダ`img`（なければ作る）に，次の二つの画像をそのフォルダに保存します．

![product6.png](product6.png)
![product7.png](product7.png)

## テーブルの準備

テーブル`table1`を修正して使うべきですが，話を簡単にするために，新しく`table2`を作ります．
次のSQLを実行してください．

```sql
use mydb;

drop table if exists table2;

create table table2 (
  id int primary key auto_increment, # ここはいつも同じ
  varcharA varchar(40) not null,
  intA int not null,
  intB int not null,
  varcharB varchar(40) default '' not null # ファイル名（デフォルトは空文字列）
);

insert into table2 (id, varcharA, intA, intB, varcharB) values
(1, 'A', 1280, 1, 'product7.png'),
(2, 'B', 2980, 0, 'product6.png'),
(3, 'C', 198, 121, '');
```

## 画像の表示

[特定のデータの表示（実装）](../show-all/)をまねて，http://localhost/table2.php?id=2 にアクセスしたときに，画像があれば表示されるようにします．

変わるのは，SQL文中のテーブル名と結果の処理方法です．

```php
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
```

**[../show-all/table1.php](../show-all/table1.php)と上のコードをもとに[table2.php](table2.php)を作り，http://localhost/table2.php?id=1 とhttp://localhost/table2.php?id=2 では画像が表示され，http://localhost/table2.php?id=3 では画像が表示されないことを確かめてください．（SQL文中のテーブル名を変えるのを忘れないように．）**