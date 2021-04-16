```puml
@startuml

actor 利用者
actor 運営者

node クライアント側 {
rectangle ブラウザ as "ウェブブラウザ
Chrome, Edge, Firefox, Safari
..
言語：HTML, CSS, (JavaScript)"
}

node サーバ側 {
rectangle ウェブサーバ as "ウェブサーバ
Apache
..
言語：PHP"

database データベース as "データベース
MySQL
..
言語：SQL"
}

利用者 -> ブラウザ
ブラウザ <- 運営者
運営者 --> ウェブサーバ
運営者 --> データベース
ブラウザ <--> ウェブサーバ : HTTPプロトコル
ウェブサーバ <-> データベース
@enduml
```