# PHP

PHPは，サーバ側（ウェブアプリケーションサーバ上）で動く言語です（ウェブアプリケーションサーバについては[ウェブアプリとは何か](introduction.md)を参照）．
サーバ側で動く言語は何でもいいのですが，この演習ではPHPを使います．

ウェブアプリで使う言語には，クライアント側（ブラウザ上）で動くものもあります．
クライアント側で動く言語の選択肢は限られていて，今のところはJavaScriptだけだと考えてかまいません．
この演習では，クライアント側の言語は使わなくていいです．（使ってもかまいません．）

## 例1

次のようなファイル`hello1.php`を作り，ドキュメントルートに置きます（ドキュメントルートについては[ウェブサーバ](apache.md)を参照）．

```php
<?php echo 1 + 1;
```

**http://localhost/hello1.php にアクセスして，計算結果が表示されることを確かめます．**

「計算結果」が出てくるということは，プログラムが実行されたということです．`echo`は結果を出力するための手続きです（`print`も可）．単に`<?php 1 + 1;`だと何も表示されません．

拡張子が`php`のファイルの`<?php`以降がPHPのプログラムです．

## 例2

ページの内容をすべてPHPで作るのではなく，大部分をHTMLで書いて，プログラムが必要なところだけ，PHPで作ります．

次のようなファイル`hello2.php`を作ります．

```html
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <link rel='stylesheet' href='style.css' />
    <title>タイトル</title>
  </head>
  <body>
    <p>計算結果は<?php echo 1 + 1; ?>です．</p>
  </body>
</html>
```

**http://localhost/hello2.php にアクセスして，ページが表示されることを確かめます．**

`<?php`と`?>`の間にPHPのプログラムを書きます．（例1では`?>`はありませんでした．細かいことですが，ファイルの最後が`?>`なら，書かなくていいです．）

`hello2.php`の一部を，次のように書いても同じ結果になります．
（HTMLのタグをPHPで出力してもいいということです．「`.`」は文字列の連結です．）

```html
  <body>
    <?php echo '<p>計算結果は'. (1 + 1) . 'です．</p>';?>
  </body>
```

ちょっと細かいテクニックですが，`""`の中で`{$変数名}`と書くと，その部分が変数の値で置き換えられます．

```php
$foo = 'world';
echo "<p>hello, {$foo}</p>";
```

上のコードの結果は「hello, world」です．**`hello2.php`にコードを追加して試してください．**