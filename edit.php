<?php 

require('db.php');

try {
    $memo_id = isset($_GET['id']) ? $_GET['id'] : null;
    $fetch_sql = 'select id,title,body from memos where id = ' . $memo_id;
    $update_sql = 'update memos set title = ?, body = ?, update = current_stamp where id = ' . $memo_id;

    $stmt = $db->prepare($fetch_sql);
    $stmt->execute();
    $memo = $stmt->fetch();

    $db = null;
    $stmt = null;
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
    <link rel="stylesheet" href="css/edit.css">
    <title>memo app | 編集画面</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <form action="update.php" method="POST">
                <input type="hidden" name="memo_id" value="<?php echo $memo['id']; ?>">
                <div class="card-title">
                    <label for="title">タイトル</label>
                    <input type="text" name="title" value="<?php echo $memo['title']; ?>" />
                </div>
                <div class="card-body">
                    <label for="body">本文</label>
                    <textarea name="body" id="body" cols="30" rows="10"><?php echo $memo['body']; ?></textarea>
                </div>
                <input type="submit" value="更新" />
            </form>
        </div>
        <div class="link-group">
            <a href="memo.php">戻る</a>
        </div>
    </div>
</body>
</html>