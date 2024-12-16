<?php 

include "model.php";

if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['description'])) {
   
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $model = new Model();

    if ($model->updateTask($id, $title, $description))
        $data = array('result' => 'success');
    //else 
      //  $data = array('result' => 'Error!');

    echo json_encode($data);
}

?>