<?php 

include "model.php";

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $description = isset($_POST['description']) ? trim($_POST['description']) : '';

        $model = new Model();

        if ($model->createTask($title, $description)) 
            $data = array('result' => 'success');
        else 
            $data = array('result' => 'error');

        echo json_encode($data);

    } else {
        echo json_encode(['error' => 'error with php']);
    }

?>