<?php 
session_start();

require "model.php";

if (isset($_POST['id']) && isset($_SESSION['user_id'])) {
    
    $id = $_POST['id'];
    $userId = $_SESSION['user_id'];
    
    $model = new Model();

    if ($model->deleteTask($id, $userId)) 
        $data = array('result' => 'success');
    else 
        $data = array('result' => 'error');

    echo json_encode($data);
}

?>