```puml
@startuml
!include https://raw.githubusercontent.com/bschwarz/puml-themes/master/themes/cerulean-outline/puml-theme-cerulean-outline.puml

actor 開発者
actor 利用者

(コーディング)
(バージョン管理)
(データ管理)
(利用)

node 開発用PC {
rectangle XAMPP {
rectangle ウェブサーバ
database データベース
rectangle phpMyAdmin
}
rectangle VSCode
rectangle Git
folder htdocs {
file php
file html
file css
file jpeg
}
}

cloud GitHub

node 本番用サーバ {
rectangle ウェブサーバ2 as "ウェブサーバ"
database データベース2 as "データベース"
}

開発者 --> コーディング
コーディング --> VSCode
開発者 --> バージョン管理
バージョン管理 --> VSCode
開発者 --> データ管理
データ管理 --> phpMyAdmin
データ管理 --> データベース
VSCode --> htdocs
VSCode --> Git
htdocs -> ウェブサーバ
htdocs <--> Git
phpMyAdmin --> データベース
phpMyAdmin -- ウェブサーバ
ウェブサーバ <-> データベース
Git <--> GitHub
GitHub --> 本番用サーバ
利用者 --> 利用
利用 --> ウェブサーバ2
ウェブサーバ2 <-> データベース2

@enduml
```