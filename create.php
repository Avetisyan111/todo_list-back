<?php 

session_start();

require "model.php";

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $description = isset($_POST['description']) ? trim($_POST['description']) : '';

        $model = new Model();

        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            if ($model->createTask($userId, $title, $description)) {
                $data = ['result' => 'success'];
                echo json_encode($data);
            }   
            else { 
                $data = ['error' => 'Can\'t acces to this page'];
                echo  json_encode($data);
            }    
        }
    } else {
        echo json_encode(['error' => 'Wrong request method']);
    }

?>