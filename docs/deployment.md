# 本番サーバへのデプロイ

本番サーバの変更は，GitHubを介して行います．
本番サーバのファイルを直接編集したり，データベースを操作したりすることはできません．

本番サーバで用意する環境には，開発環境（XAMPP）とは違うところがあります．
開発環境でちゃんと動くのに本番環境ではうまく動かないという場合は，あまり悩まずに矢吹に相談してください．

## 準備

チームのリポジトリへの書き込み権限が必要です．書き込めない人は，矢吹に問い合わせてください．

## 概要

手順を簡単に説明すると次のとおりです．

1. （1回だけ）GitHubのリポジトリを自分のPCにコピーする．これを**クローン**といいます．
1. クローンしたリポジトリに，データベースの内容を記録したmydb.sqlを置きます．
1. クローンしたリポジトリのフォルダhtdocsに，サーバで配信するファイルを置きます．
1. コミット！
1. プッシュ！

動画を参照→https://youtu.be/nrp384CppLA （プッシュの時にGitHubのユーザ名とパスワードを入力する作業があります．1回やればいいことなので，動画に入れ忘れました．）

## 詳しい手順

VS Codeで実行する手順を説明します．（GitHub Desktopとか，別のものを使ってもかまいません．）

### 初めての場合

注意：これはバージョン管理システムなので，複数の人が同時にファイルを操作しようとするとエラーになります．エラーになるのは面倒だと思うかもしれませんが，エラーにならずに上書きしてしまう方が問題です．
共有フォルダでの作業では，この問題をうまく解決できません．
とはいえ，初めて使うときにエラーが発生しても困るでしょうから，チームで試すときは，一人が以下のすべてのステップを終えてから，次の人が始めるようにするといいでしょう．

1. https://git-scm.com からGitをダウンロードしてインストールします．
1. VS Codeを起動し，ソース管理アイコンをクリックする．
1. リポジトリをクローン
1. リポジトリのURLを入力する．例：`https://github.com/yabukilab/yabuki-x.git`（場所はデスクトップなど，どこでもいい．）
1. 「開く」
1. ターミナル→新しいターミナル（またはCtrl+Shift+@）
1. （1回だけ）`git config --global user.name "自分の名前"`
1. （1回だけ）`git config --global user.email "自分のメアド"`（GitHubの[メアドの設定](https://github.com/settings/emails)によっては，後でプッシュに失敗するらしい（再現できていない）．簡単な解決策は，ここでダミーのメアドを使うこと？）
1. `c:/xampp/mysql/bin/mysqldump.exe -uroot --result-file=mydb.sql mydb`
1. フォルダhtdocsに，必要なファイルを置く．
1. ソース管理アイコンをクリックする．
1. サーバで更新するファイルの「+」をクリックする．（これを**ステージング**という．）
1. ✔をクリックして，何かメッセージを入力して**コミット**する．
1. 「･･･」→プッシュ
1. 少し待ってから，サイトにアクセスする．

ファイル配置はhttps://github.com/yabukilab/yabuki-x を参考にしてください．

### 2回目以降

1. 次からは，クローンしたフォルダをVS Codeで開く．
1. ターミナル→新しいターミナル（またはCtrl+Shift+@）
1. （データベースを更新したい場合）`c:/xampp/mysql/bin/mysqldump.exe -uroot --add-drop-table --result-file=mydb.sql mydb`
1. フォルダhtdocsに，必要なファイルを置く．
1. ソース管理アイコンをクリックする．
1. サーバで更新するファイルの「+」をクリックする．（これを**ステージング**という．）
1. ✔をクリックして，何かメッセージを入力して**コミット**する．
1. 「･･･」→プッシュ
1. 少し待ってから，サイトにアクセスする．

## 各チームのリポジトリ

- https://github.com/yabukilab/shimoda-a
- https://github.com/yabukilab/shimoda-b
- https://github.com/yabukilab/shimoda-c
- https://github.com/yabukilab/shimoda-d
- https://github.com/yabukilab/ogasawara-a
- https://github.com/yabukilab/ogasawara-b
- https://github.com/yabukilab/ogasawara-c
- https://github.com/yabukilab/ogasawara-d
- https://github.com/yabukilab/yabuki-a
- https://github.com/yabukilab/yabuki-b
- https://github.com/yabukilab/yabuki-c
- https://github.com/yabukilab/yabuki-d
- https://github.com/yabukilab/yabuki-x

補足：最後に`.git`を付けたURLでクローンします．

## 各チームのサイト

- https://shimoda-a.pm-chiba.tech
- https://shimoda-b.pm-chiba.tech
- https://shimoda-c.pm-chiba.tech
- https://shimoda-d.pm-chiba.tech
- https://ogasawara-a.pm-chiba.tech
- https://ogasawara-b.pm-chiba.tech
- https://ogasawara-c.pm-chiba.tech
- https://ogasawara-d.pm-chiba.tech
- https://yabuki-a.pm-chiba.tech
- https://yabuki-b.pm-chiba.tech
- https://yabuki-c.pm-chiba.tech
- https://yabuki-d.pm-chiba.tech
- https://yabuki-x.pm-chiba.tech

## うまく行かない場合

[ログ](https://admin.pm-chiba.tech/log/)を確認する．（本当は，外から見える場所にログを置いてはいけない．）
