<?php
//main connection file for both admin & front end
session_start();
$servername = "localhost"; //server
$server_user = "root"; //username
$server_pass = ""; //password
$dbname = "food"; //database name
$name = $_SESSION["name"]; // name of the user
$role = $_SESSION["role"]; // role of the user

//create new connection
$db = new mysqli($servername, $server_user, $server_pass, $dbname);
// Check connection
if (!$db) {       //checking connection to DB	
    die("Connection failed: " . mysqli_connect_error());
}
?>