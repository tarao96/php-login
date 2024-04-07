<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=sample', 'keito', 'shitara@1324');

// 認証確認
if (isset($_SESSION['id'])) {// ログインしているとき
    try {
        $sql = 'select * from memos';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $memos = $stmt->fetchAll();
        $stmt = null;
        $db = null;
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
    <link rel="stylesheet" href="../css/memo.css">
    <title>memo app | ホーム画面</title>
</head>
<body>
    <?php if (isset($_SESSION['id'])) : ?>
    <h2>メモ一覧</h2>
    <a href="create.php">メモ新規作成</a>
    <a href="../logout.php">ログアウト</a>
    <div class="container">
        <?php foreach ($memos as $memo) : ?>
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <p><?php echo $memo['title']; ?></p>
                    </div>
                    <div class="card-body">
                        <p><?php echo $memo['body']; ?></p>
                    </div>
                </div>
                <div class="link-group">
                    <a href="edit.php?id=<?php echo $memo['id']; ?>">編集</a>
                    <a href="delete.php?id=<?php echo $memo['id']; ?>">削除</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <?php endif ?>
</body>
</html>