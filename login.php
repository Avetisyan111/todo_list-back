<?php 

require "model.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $login = isset($_POST['login']) ? trim($_POST['login']) : '';
    $pass = isset($_POST['pass']) ? trim($_POST['pass']) : '';

    $model = new Model();

    if ($model->userLogin($login, $pass)) 
        $data = ['result' => 'success', 'user_id' => $_SESSION['user_id']];
    else 
        $data = ['result' => 'error'];
    
    echo json_encode($data);
}

?>