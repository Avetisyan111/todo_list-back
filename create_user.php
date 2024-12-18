<?php 

include "model.php";

    if ($_SERVER['REQUEST_METHOD'] === "POST") {

        $model = new Model();

        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
        $login = isset($_POST['login']) ? trim($_POST['login']) : '';
        $pass = isset($_POST['pass']) ? trim($_POST['pass']) : '';   

        if ($model->create_user($name, $lastname, $login, $pass)) {
            $data = ['result' => 'success'];
        }
        else {
            $data = ['result' => 'error'];
        }
        echo json_encode($data);

}


?>