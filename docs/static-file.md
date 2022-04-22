# HTMLファイル

HTMLファイルを作って，ブラウザで開いてみましょう．
これはPM実験の復習です．

テキストエディタで，次のようなHTMLファイルを作ります．
ファイル名は`hello.html`にしましょう．
HTMLファイルの拡張子は`.html`にするのが一般的です．
（保存するときの文字コードはUTF-8です．VSCodeならデフォルトでそうなるはず．この演習で使う文字コードはUTF-8だけです．VSCodeでファイルを開いたときに，UTF-8でなく，Windows 1252になってしまうことがあるようです．その場合は，画面右下のWindows 1252をクリックして，「エンコード付きで再度開く」→UTF-8としてください．）

```html
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <title>タイトル</title>
  </head>
  <body>
    <p>I love <a href="https://ja.wikipedia.org">Wikipedia</a>!</p>
  </body>
</html>
```

このファイルをダブルクリックしてブラウザで開くと，ウィキペディアへのリンクが表示されます．

**このページの作業はこれで終了です．**

`<a href="foo">bar</a>`というのはリンクのためのHTML要素で，barというテキストがfooへのリンクになります．
ウェブができるのはリンクのおかげなので，このa要素がHTMLの最も重要な要素と言えます．
とはいえ，HTML要素はとてもたくさんあるので，次のような資料を活用しましょう．

- [とほほのWWW入門](http://www.tohoho-web.com/www.htm)
- https://developer.mozilla.org/ja/docs/Web/HTML
- エビスコム『HTML5＆CSS3デザイン 現場の新標準ガイド』（マイナビ出版, 第2版, 2020）

（予告）HTMLファイルをダブルクリックでブラウザで開くと，ブラウザのアドレス欄には，`file:///C:/Users/yabuki/Desktop/hello.html`のような文字列が表示されます．
この文字列の先頭が`file://`であることが重要で（あとは状況次第），ウェブサーバを使うようになると，この部分が`http://`や`https://`に変わります．
