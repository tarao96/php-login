<?php 

require('db.php');

$memo_id = $_POST['memo_id'];
$title = $_POST['title'];
$body = $_POST['body'];
$update_sql = 'update memos set title = ?, body = ?, updated_at = current_timestamp where id = ' . $memo_id;

try {
    $stmt = $db->prepare($update_sql);
    $result = $stmt->execute(array($title, $body));

    if ($result) {
        header('Location: http://localhost:8080/memo.php');
        exit;
    } else {
        header('Location: http://localhost:8080/edit.php');
        exit;
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>