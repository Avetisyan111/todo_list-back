<?php 

include "model.php";

if (isset($_POST['id'] )) {
    $id = $_POST['id'];

    $model = new Model();

    if ($model->deleteTask($id)) 
        $data = array('result' => 'success');
    else 
        $data = array('result' => 'error');

    echo json_encode($data);
}

?>