<?php 
session_start();
$db = new PDO('mysql:host=localhost;dbname=sample', 'keito', 'shitara@1324');

if (isset($_SESSION['id'])) {
    try {
        if (isset($_POST['create'])) {
            $title = $_POST['title'];
            $body = $_POST['body'];
            $sql = "insert into memos (title,body,created_at,updated_at) values (:title,:body,current_timestamp,current_timestamp)";
        
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':body',$body);
            $result = $stmt->execute();
        
            $db = null;
            $stmt = null;
        
            if ($result) {
                header('Location: http://localhost:8080/memos/memo.php');
                exit;
            } else {
                echo "メモの新規作成に失敗しました！";
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
} else {
    echo "ログインしていません<br />";
    echo '<a href="../index.php">ログイン画面へ</a>';
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/create.css">
    <title>memo app | 新規作成画面</title>
</head>
<body>
    <?php if (isset($_SESSION['id'])) : ?>
    <div class="container">
        <div class="card">
            <form action="create.php" method="POST">
                <div class="card-title">
                    <label for="title">タイトル</label>
                    <input type="text" name="title" value="" />
                </div>
                <div class="card-body">
                    <label for="body">本文</label>
                    <textarea name="body" id="body" cols="30" rows="10"></textarea>
                </div>
                <input type="submit" name="create" value="作成" />
            </form>
        </div>
        <div class="link-group">
            <a href="memo.php">戻る</a>
        </div>
    </div>
    <?php endif ?>
</body>
</html>