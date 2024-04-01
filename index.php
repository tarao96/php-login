<?php

$err_msg = '';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    try {
        $db = new PDO('mysql:host=localhost;dbname=sample', 'keito', 'shitara@1324');
        $sql = 'select * from users where username=? and password=?';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($username, $password));
        $result = $stmt->fetch();
        $stmt = null;
        $db = null;

        if ($result) {
            header('Location: http://localhost:8080/home.php');
            exit;
        } else {
            $err_msg = "ユーザ名またはパスワードが誤りです。";
        }
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
        <title>ログイン画面</title>
    </head>
    <body>
        <h1>ログイン画面</h1>
        <form action="index.php" method="POST">
            <?php if ($err_msg !== null && $err_msg !== '') { echo $err_msg . "<br />"; } ?>
            ユーザ名<input type="text" name="username" value="" /><br />
            パスワード<input type="password" name="password" value="" /><br />
            <input type="submit" name="login" value="ログイン">
        </form>
        <a href="signin.php">新規登録</a>
    </body>
</html>