<?php 

require "model.php";

if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['login']) && isset($_POST['pass']))  {
    $name = trim($_POST['name']);
    $lastname = trim($_POST['lastname']);
    $login = trim($_POST['login']);
    $pass = trim($_POST['pass']);
    
    $model = new Model();

    if (!$model->create_user($name, $lastname, $login, $pass)) $data = ['result' => 'error'];

    $data = ['result' => 'success'];

    echo json_encode($data);

}


?>