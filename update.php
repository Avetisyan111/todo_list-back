<?php 

session_start();

require "model.php";

if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['description']) && isset($_SESSION['user_id'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $userId = $_SESSION['user_id'];

    $model = new Model();

    if ($model->updateTask($id, $title, $description, $userId)) {
        $data = ['result' => 'success'];
    } else {
        $data = ['result' => 'error'];
    }

    echo json_encode($data);
}

?>

