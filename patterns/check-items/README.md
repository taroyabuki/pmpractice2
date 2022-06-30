# チェックボックスによるアイテムの選択

テーブル`table1`の全データを取り出して，表示させます．
そこにチェックボックスを付けておいて，アイテムを選択できるようにします．
選択されたアイテムに対する処理の例として，varcharAに「*」を追記します．

<table>
  <caption>全データ</caption>
  <tr>
    <th>ID</th>
    <th>商品名</th>
    <th>価格</th>
    <th>在庫</th>
    <th>チェック</th>
  </tr>
<tr><td>1</td><td>A</td><td>1280</td><td>1</td><td>☑</td></tr><tr><td>2</td><td>B</td><td>2980</td><td>0</td><td>□</td></tr><tr><td>3</td><td>C</td><td>198</td><td>121</td><td>☑</td></tr></table>

まず，[全データ表示（実装）](show-all/)のhttp://localhost/show-all2.php が動くようにしてください．
これを改造します．

## 1 チェックボックスの追加

表（table要素）をform要素の中に入れ，チェックボックスと送信ボタンを追加します．
できあがりは，[check-items.php](check-items.php)で確認してください．
チェックボックスのvaluse属性に，アイテムのIDを入れておくのがポイントです．

```
<form action="checked.php" method="post">
<table>
（省略）
    "<td><input type='checkbox' name='id[]' value='$id'</td>".
    '</tr>';
}
?>
</table>
<input type="submit" value="送信" />
</form>
```

動作確認：http://localhost/check-items.php でチェックボックスが表示されることを確認してから先に進んでください．

## 2 送信されたデータの確認

フォームから送信されたアイテムをchecked.phpで受け取ります．
できあがりは，[checked.php](checked.php)で確認してください．

まずは，送信されたデータをそのまま表示してみましょう．
次のようなファイルchecked.phpを作ります．

```
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <link rel='stylesheet' href='style.css' />
    <title>チェックボックスの処理</title>
  </head>
  <body>
送信されたデータ
<pre>
<?php var_dump($_POST); ?>
</pre>
  </body>
</html>
```

動作確認：http://localhost/check-items.php でアイテムを選択して送信ボタンを押すと，checked.phpが開き，選択したアイテムのIDが表示されることを確認してから先に進んでください．

## 3 チェックされたアイテムに対する処理

チェックされたアイテムに対する処理の例として，データベースのvarcharAに「*」を追加します．
SQL文のテンプレートは次のとおりです．

```sql
update table1 set varcharA = concat(varcharA, '*') where id=:id
```

この「`:id`」の部分にアイテムのIDを埋め込めば，SQL文が完成します．

チェックされたアイテムのIDは$_POST["id"]に入っているので，それに対するループで実行します．

```php
foreach ($_POST['id'] as $id) {
    echo '<p>id = ' . h($id) . 'のvarcharAに「*」を追記します．</p>';

    $prepare = $db->prepare($sql);
    $prepare->bindValue(':id', $id, PDO::PARAM_STR);
    $prepare->execute();
}
```

動作確認：http://localhost/check-items.php でアイテムを選択して送信ボタンを押すと，checked.phpが開き，選択したアイテムに対する処理が行われます．varcharAに「*」が追記されたことを，http://localhost/check-items.php に戻って確認します．
