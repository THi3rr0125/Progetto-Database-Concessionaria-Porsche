<?php
// config.php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "concessionario_porsche";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita. Errore: " . $conn->connect_error);
}
?>