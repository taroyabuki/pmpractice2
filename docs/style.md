# スタイル

先に作った`hello.html`の，文字の色を変えてみましょう．
文字の色のような「見た目」のことは，HTMLではなく，CSSというしくみを使って指定します．

HTMLで文章の構造を指定し，CSSで文章の見た目を指定するのです．
構造と見た目をなるべく分離して考えるのが重要です．

まず，`hello.html`を次のように修正します．（修正点は2箇所）

```html
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <link rel='stylesheet' href='style.css' />
    <title>タイトル</title>
  </head>
  <body>
    <p class="em">I love <a href="https://ja.wikipedia.org">Wikipedia</a>!</p>
  </body>
</html>
```

追加した`<link rel='stylesheet' href='style.css' />`は，「スタイルのことは`style.css`に書いてあるよ」という意味です．

`hello.html`があるのと同じフォルダに`style.css`を作ります．
内容は次のとおり．

```css
.em { color: red; }
```

これは，「class属性値が`em`の要素の色を赤にする」という意味です．
先頭の「`.`」は目立ちませんが，これが「class属性値が」を意味しています．

**ブラウザで`hello.html`をリロードして（Ctrl-r），色が赤に変われば終了．**