<?php
session_start();
$err_msg = '';
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    try {
        $db = new PDO('mysql:host=localhost;dbname=sample', 'keito', 'shitara@1324');
        $sql = 'select * from users where email=:email;';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if (password_verify($password, $user['password'])) {
            // DBのユーザ情報をセッションに保存
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header('Location: http://localhost:8080/memos/memo.php');
        } else {
            $err_msg = "メールアドレスまたはパスワードが誤りです。";
        }

        $stmt = null;
        $db = null;
        exit;
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>memo app | ログイン画面</title>
    </head>
    <body>
        <h1>ログイン画面</h1>
        <form action="index.php" method="POST">
            <?php if ($err_msg !== null && $err_msg !== '') { echo $err_msg . "<br />"; } ?>
            メールアドレス<input type="email" name="email" value="" /><br />
            パスワード<input type="password" name="password" value="" /><br />
            <input type="submit" name="login" value="ログイン">
        </form>
        <a href="signin.php">新規登録</a>
    </body>
</html>