<?php 

session_start();

require "model.php";

session_unset();
session_destroy();
exit;


?>