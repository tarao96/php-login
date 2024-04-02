<?php

require('db.php');

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

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/memo.css">
    <title>memo app | ホーム画面</title>
</head>
<body>
    <h2>メモ一覧</h2>
    <a href="create.php">メモ新規作成</a>
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
                    <form action="delete.php" method="POST">
                        <input type="hidden" name="memo_id" value="<?php echo $memo['id'] ?>">
                        <input type="submit" value="削除" />
                    </form>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</body>
</html>