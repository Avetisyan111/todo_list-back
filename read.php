<?php 

include "model.php";

$model = new Model();

$rows = $model->getTasks();

$data = array('rows' => $rows);

echo json_encode($data);

?>
