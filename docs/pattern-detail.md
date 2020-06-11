# 詳細検索（実装）

文字列，ラジオボタン，チェックボックスを組み合わせた検索フォームを作ります．

![](images/pattern5.png)

## フォームの作成

[データの追加（実装）](pattern-post.md)をまねて，詳細検索のためのフォームを作ります．

```html
<form action="pattern-detail.php" method="get">
  <table>
    <tr>
      <th>商品名に含む</th>
      <td><input name="varcharA" type="text" value="D"/></td>
    </tr>
    <tr>
      <th>価格</th>
      <td>
        <label><input name="price" type="radio" value="500" checked/>500円まで</label>
        <label><input name="price" type="radio" value="100000000"/>上限なし</label>
      </td>
    </tr>
    <tr>
      <th>在庫</th>
      <td><label><input name="instock" type="checkbox" checked/>ありに限定</label>
      </td>
    </tr>
  </table>
  <input type="submit" value="送信" />
  <input type="reset" value="リセット" />
</form>
```

form要素のmethod属性は`get`です．厳密な区別はないのですが，データを取得するときは`get`，データを追加（更新）するときは`post`です．

補足：あとで楽をするためにちょっと頭を使っていて，価格の「上限なし」を選んだときに，大きい値（1億円）を送るようにしています．
そうしておけば，価格の条件をいつも「`intA <= 送信された値`」と書けるわけです．

**上のフォームを含む[`pattern-detail.html`](pattern-detail.html)を作り，http://localhost/pattern-detail.html で確認しましょう．**

データを入れて，送信ボタンを押してみます．
サーバ側（`pattern-detail.php`）をまだ作っていないのでエラーになりますが，URLの`?`以降がこんな感じになるはずです．

```
?varcharA=D&price=500&instock=on
```

整理します．

キー|値
--|--
varcharA|D
price|500
instock|on

「キー」はinput要素のname属性の値です．
勝手に決めていいのですが，わかりやすいものにしましょう．

「値」はフォームに入力されたデータです．

価格の「上限なし」を選ぶと値が「0」になるようにしています．（ちょっとわかりにくいのですが，コードを単純にするためです．）

**フォームに入力するデータを変えたときの，URLの変化を確かめてください．**

## 送信されたデータの扱い

フォームから送信されたデータ（検索条件）を，サーバ側で受け取ります．

`$_POST[キー]`で値を取り出します．

補足：在庫ありに限定するかどうか（キーはinstock）の扱いだけ他と違っているのは，チェックをしなかった場合には，このキー自体がなくなるからです．
ですから，キーがあるなら0，なければ-1としています．
楽をするためにちょっと頭を使っていて，こういう数値に置き換えておけば，在庫についての条件を，いつも「`intB > 値`」と書けます．在庫ありに限定するなら「`intB > 0`」，限定しないなら「`intB > -1`（常に真）」というわけです．

```php
$varcharA = $_POST['varcharA'];
$price = $_POST['price'];
$instock = isset($_POST['instock']);

echo '送信されたデータ：<table>' .
     "<tr><th>varcharA</th><td>{$varcharA}</td></tr>" .
     "<tr><th>price</th><td>{$price}</td></tr>" .
     "<tr><th>instock</th><td>{$instock}</td></tr>" .
     '</table>';
```

**このようなコードを含む`pattern-detail.php`を作り，http://localhost/pattern-detail.html からデータを送信してみましょう．**（この先も作ってしまっていますが[pattern-detail.php](pattern-detail.php)を使ってもかまいません．）

## 実験用データの作成

冒頭に掲載した絵と同じ状況になるように，次のSQL文を実行します．

```sql
delete from tableA;

insert into tableA (id, varcharA, intA, intB) values
(1, 'A', 1280, 1),
(2, 'B', 2980, 0),
(3, 'CDF', 198, 121);
```

## SQL文の作成

送信された条件で検索するSQL文はこんな感じです．

```sql
select * from tableA
where varcharA like '%D%'
  and intA <= 500
  and intB > 0
```

**このSQLで結果が返ってくることを確かめてください．**

[データベースの操作](sql.md)のC3の応用で，複数の条件を「`and`」でつないでいます．「XがYを含んでいる」というのは「`X like '%Y%'`」と書きます．`%`は「何でもいい」ということです．

このSQL文をPHPのプログラムで作ります．
そのためには，実行時に決まる部分を穴埋めにします．

```sql
select * from tableA
where varcharA like 穴A
  and intA <= 穴B
  and intB > 穴C
```

これではかっこ悪いので，次のようにしましょう．

```sql
select * from tableA
where varcharA like :varcharA
  and intA <= :price
  and intB > :instock
```

あとは，[特定のデータの表示（実装）](pattern-id.md)と同じです．

**このようなコードを組み込んだ[pattern-detail.php](pattern-detail.php)を作り，http://localhost/pattern-detail.html からデータを送信してみましょう．**