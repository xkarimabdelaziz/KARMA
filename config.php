<?php
$host = "localhost";
$user = "u121750128_karma";
$pass = "+p4A29xqx";
$dbname = "u121750128_karma_project";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) { die("الاتصال فشل: " . $conn->connect_error); }
$conn->set_charset("utf8mb4");

session_start();
?>