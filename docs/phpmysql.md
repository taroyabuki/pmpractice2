# PHPとMySQL

PHPからMySQLを操作する方法を説明します．
概要は次のとおりです．

1. 接続：PHPからMySQLに接続する．
1. 問合せ

## 1. 接続

話を簡単にするために，PHPからMySQLに接続するための作業を[`db.php`](/db.php)にまとめておきます．（[データベースの操作](sql.md)で作業したように，データベース`mydb`に，ユーザ名`testuser`，パスワード`pass`でアクセスできるようになっていることが前提です．）

**[`db.php`](/db.php)をドキュメントルートにおいて，http://localhost/db.php にアクセスし，「Can't connect to the database: 」と表示されないことを確かめてください．（うまく行った場合は，何も表示されません．）**

```
mydbを作っていない場合のエラー：
Can't connect to the database: SQLSTATE[HY000] [1049] Unknown database 'mydb'

権限を設定していない場合のエラー：
Can't connect to the database: SQLSTATE[HY000] [1045] Access denied for user 'testuser'@'localhost' (using password: YES)
```

データベースを使いたいときは，`db.php`を読み込みます．

**次のようなコードを含む[`hello-db.php`](hello-db.php)を作り，http://localhost/hello-db.php にアクセスして，エラーが表示されないことを確かめてください．**

```html
<?php require 'db.php'; ?>
```

## 2. 問合せ

[全データ表示（実装）](/patterns/show-all/)で解説します．
