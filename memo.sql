# (A1)mydbというデータベースが既にあるなら削除する（危険）．
drop database if exists mydb;

# (A2)mydbというデータベースを作る．
create database mydb charset=utf8mb4;

# (A3)ユーザ名testuser，パスワードpassでmydbにアクセスできるようにする．
grant all on mydb.* to testuser@localhost identified by 'pass';

# (A4)mydbを使う．
use mydb;

# (A5)tableAというテーブルが既にあるなら削除する（危険）．
drop table if exists tableA;

create table tableA (
  id int primary key auto_increment, # ここはいつも同じ
  varcharA varchar(40),
  intA int,
  intB int # 最後にはカンマがないことに注意．
);

# (C1)データを作成する．
insert into tableA (id, varcharA, intA, intB) values
(1, 'A', 1280, 1),
(2, 'B', 2980, 0),
(3, 'C', 198, 121);
