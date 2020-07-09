<?php
session_start(); // セッションを開始する．
if (!isset($_SESSION['username'])) { // ログインしていないなら，
  header('Location: login.php');     // ログインページへ転送する．
}
$username = $_SESSION['username']; // ユーザ名を思い出す．
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset='utf-8' />
  <link rel='stylesheet' href='style.css' />
  <title>メンバページ</title>
</head>
<body>
  <p><?php echo $username;?>のためのメンバページ</p>
  <p><a href="logout.php">ログアウト</a></p>
</body>
</html>