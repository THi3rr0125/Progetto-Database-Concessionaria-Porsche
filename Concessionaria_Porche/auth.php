<?php
// Questa pagina riceve i dati del form di login, controlla se sono corretti e reindirizza l'utente di conseguenza
if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['pwd']) && !empty($_POST['pwd'])) {
    // Se sono stati inviati email e password, continua con il controllo
    // Inizia la sessione
    session_start();

    $_SESSION['mail'] = $_POST['email']; // Salva la mail in sessione (utile per mantenere l'utente loggato)
    $_SESSION['pwd'] = $_POST['pwd']; // Salva la password in session

    include("inc/checkLogin.php");
} else {
    // Se non sono stati inviati email e password, lo rimanda alla pagina di login 
    header("Location: login.php?errore=3"); 
?>