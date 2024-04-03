<?php 

$db = new PDO('mysql:host=localhost;dbname=sample', 'keito', 'shitara@1324');

try {
    $memo_id = $_POST['memo_id'];
    $title = $_POST['title'];
    $body = $_POST['body'];
    $update_sql = 'update memos set title = :title, body = :body, updated_at = current_timestamp where id = :memo_id';

    $stmt = $db->prepare($update_sql);
    $stmt->bindValue(':memo_id', $memo_id);
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':body',$body);
    $result = $stmt->execute();

    $db = null;
    $stmt = null;

    if ($result) {
        header('Location: http://localhost:8080/memos/memo.php');
        exit;
    } else {
        header('Location: http://localhost:8080/memos/edit.php');
        exit;
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>