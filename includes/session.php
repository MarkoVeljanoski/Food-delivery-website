<?php
//main connection file for both admin & front end
session_start();

$name = $_SESSION["name"]; // name of the user
$role = $_SESSION["role"]; // role of the user
?>