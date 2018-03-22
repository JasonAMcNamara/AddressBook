<?php

$username = $_GET["username"];
$password = $_GET["password"];
echo $username . "<br>" . $password;

$config = parse_ini_file("dbinfo.ini");
$servername = $config["servername"];
$username = $config["username"];
$password = "";
$dbName = $config["dbName"];
$tblName = $config["tblNameLogin"];

$conn = mysqli_connect($servername, $username, $password, $dbName) or die;

$sql = "SELECT id, username, password FROM $tblName";

$result = mysqli_query($conn, $sql) or die;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
    }
} else {
    header("Location: /project1/home");
    exit;
}