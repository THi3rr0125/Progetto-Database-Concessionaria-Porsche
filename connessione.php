<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "concessionario_porsche"; // correggi nome db

$conn = new pdo($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>
