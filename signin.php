<?php

if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    try {
        $db = new PDO('mysql:host=localhost;dbname=sample', 'keito', 'shitara@1324');
        $sql = 'insert into users(email, password) values(:email, :password)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        $stmt = null;
        $db = null;
        
        header('Location: http://localhost:8080/index.php');
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
        <title>memo app | 新規登録画面</title>
    </head>
    <body>
        <h1>新規登録画面</h1>
        <form action="signin.php" method="POST">
            メールアドレス<input type="email" name="email" value="" /><br />
            パスワード<input type="password" name="password" value="" /><br />
            <input type="submit" name="signin" value="新規登録">
        </form>
        <a href="index.php">ログイン画面へ</a>
    </body>
</html>