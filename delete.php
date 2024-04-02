<?php

require('db.php');

$memo_id = $_POST['memo_id'];
$sql = 'delete from memos where id = ?';

try {
    $stmt = $db->prepare($sql);
    $result = $stmt->execute(array($memo_id));
    $db = null;
    $stmt = null;
    if ($result) {
        header('Location: http://localhost:8080/memo.php');
        exit;
    } else {
        echo "メモの削除に失敗しました！";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>