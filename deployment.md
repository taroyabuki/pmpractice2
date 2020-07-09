# 本番サーバへのデプロイ

本番サーバの変更は，GitHubを介して行います．
本番サーバのファイルを直接編集したり，データベースを操作したりすることはできません．

手順を簡単に説明すると次のとおりです．

1. （1回だけ）GitHubのリポジトリを自分のPCにコピーする．これを**クローン**といいます．
1. クローンしたリポジトリに，データベースの内容を記録したmydb.sqlを置きます．
1. クローンしたリポジトリのフォルダhtdocsに，サーバで配信するファイルを置きます．
1. コミット！
1. プッシュ！

動画を参照→

## 詳しい手順

VS Codeで実行する手順を説明します．（GitHub Desktopとか，別のものを使ってもかまいません．）

### 初めての場合

1. https://git-scm.com からGitをダウンロードしてインストールします．
1. VS Codeを起動し，ソース管理アイコンをクリックする．
1. リポジトリをクローン
1. リポジトリのURLを入力する．例：`https://github.com/yabukilab/yabuki-x.git`（場所はデスクトップなど，どこでもいい．）
1. 「開く」
1. ターミナル→新しいターミナル（またはCtrl+Shift+@）
1. （1回だけ）`git config --global user.name "自分の名前"`
1. （1回だけ）`git config --global user.email "自分のメアド"`
1. （データベースを更新したい場合）`c:/xampp/mysql/bin/mysqldump.exe -uroot --result-file=mydb.sql mydb`
1. フォルダhtdocsに，必要なファイルを置く．
1. ソース管理アイコンをクリックする．
1. サーバで更新するファイルの「+」をクリックする．（これを**ステージング**という．）
1. ✔をクリックして，何かメッセージを入力して**コミット**する．
1. 「･･･」→プッシュ
1. 少し待ってから，サイトにアクセスする．

### 2回目以降

1. 次からは，クローンしたフォルダをVS Codeで開く．
1. ターミナル→新しいターミナル（またはCtrl+Shift+@）
1. （データベースを更新したい場合）`c:/xampp/mysql/bin/mysqldump.exe -uroot --result-file=mydb.sql mydb`
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
- https://github.com/yabukilab/ogasawara-a
- https://github.com/yabukilab/ogasawara-b
- https://github.com/yabukilab/ogasawara-c
- https://github.com/yabukilab/yabuki-a
- https://github.com/yabukilab/yabuki-b
- https://github.com/yabukilab/yabuki-c
- https://github.com/yabukilab/yabuki-x
- https://github.com/yabukilab/takuma-a
- https://github.com/yabukilab/takuma-b
- https://github.com/yabukilab/takuma-c

補足：最後に`.git`を付けたURLでクローンします．

## 各チームのサイト

https://shimoda-a.pm-chiba.tech
https://shimoda-b.pm-chiba.tech
https://shimoda-c.pm-chiba.tech
https://ogasawara-a.pm-chiba.tech
https://ogasawara-b.pm-chiba.tech
https://ogasawara-c.pm-chiba.tech
https://yabuki-a.pm-chiba.tech
https://yabuki-b.pm-chiba.tech
https://yabuki-c.pm-chiba.tech
https://yabuki-x.pm-chiba.tech
https://takuma-a.pm-chiba.tech
https://takuma-b.pm-chiba.tech
https://takuma-c.pm-chiba.tech

## うまく行かない場合

[ログ](https://admin.pm-chiba.tech/log/)を確認する．（本当は，外から見える場所にログを置いてはいけない．）