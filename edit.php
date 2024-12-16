<?php

include "model.php";

if (isset($_POST['id']))
{
    $id = $_POST['id'];

    $model = new Model();

    if ($row = $model->editTask($id))
        $data = array('result' => 'success', 'row' => $row);
    else 
        $data = array('result' => 'error');

    echo json_encode($data);
}

?>