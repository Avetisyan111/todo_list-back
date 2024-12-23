<?php 

session_start();

require "model.php";

$model = new Model();

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $rows = $model->getTasks($userId);
    $data = ['rows' => $rows];
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'The user not loged in']);
}
?>
