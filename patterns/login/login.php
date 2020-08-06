<?php
session_start(); // セッションを開始する．
$message = 'ログインしてください．'; // デフォルトメッセージ

if (isset($_POST['username'], $_POST['password'])) {
  $username = $_POST['username']; // フォームから送信されたユーザ名
  $password = $_POST['password']; // フォームから送信されたパスワード

  //データベースに問い合わせるのが正統だが，
  //ここでは簡単のために，次の3人だけにする．
  //一般ユーザ1（user1, pass1）
  //一般ユーザ2（user2, pass2）
  //管理者(admin,pass3）
  if (($username == 'user1' && $password == 'pass1') ||
      ($username == 'user2' && $password == 'pass2') ||
      ($username == 'admin' && $password == 'pass3')) {
    session_regenerate_id();//セッションを作り直す．
    $_SESSION['username'] = $username; // ユーザ名を記憶する．

    if ($username == 'admin') {       // 管理者なら，
      $_SESSION['admin'] = true;      // 管理者フラグを立て，
      header('Location: admin.php');  // 管理者ページへ転送する．
    } else {                          // 管理者でないなら，
      header('Location: member.php'); // メンバページへ転送する．
    }
  }
  $message = 'ユーザ名またはパスワードが違います．';
} // ユーザ名とパスワードが送信されていないなら以下のフォームを表示する．
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset='utf-8' />
  <link rel='stylesheet' href='style.css' />
  <title>ログイン</title>
</head>
<body>
  <?php echo $message;?>
  <form action="login.php" method="post">
    <ul style="list-style-type: none;">
      <li><input type="text" name="username" placeholder="ユーザ名" /></li>
      <li><input type="password" name="password" placeholder="パスワード" /></li>
      <li><input type="submit" value="ログイン" /></li>
    </ul>
  </form>
</body>
</html>