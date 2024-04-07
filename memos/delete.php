<?php

$db = new PDO('mysql:host=localhost;dbname=sample', 'keito', 'shitara@1324');

try {
    $memo_id = $_GET['id'];
    $sql = 'delete from memos where id = :memo_id';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':memo_id', $memo_id);
    $result = $stmt->execute();

    $db = null;
    $stmt = null;
    if ($result) {
        header('Location: http://localhost:8080/memos/memo.php');
        exit;
    } else {
        echo "メモの削除に失敗しました！";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>