<?php
session_start(); // セッションを開始する．
if (!isset($_SESSION['username'])) { // ログインしていないなら，
  header('Location: login.php');     // ログインページへ転送する．
}
if (!isset($_SESSION['admin'])) {  // 管理者でないなら，
  header('Location: member.php');  // メンバページへ転送する．
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset='utf-8' />
  <link rel='stylesheet' href='style.css' />
  <title>管理者専用ページ</title>
</head>
<body>
  <p>管理者専用ページ</p>
  <p><a href="logout.php">ログアウト</a></p>
</body>
</html>