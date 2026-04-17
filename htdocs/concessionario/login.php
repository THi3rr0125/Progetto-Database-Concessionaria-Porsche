<?php
// login.php
session_start();
require 'config.php';

$errore = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Controllo nel DB
    $sql = "SELECT id_utente, nome FROM utente WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['utente_loggato'] = $row['id_utente'];
        $_SESSION['nome_utente'] = $row['nome'];
        header("Location: dashboard.php");
        exit;
    } else {
        $errore = "Credenziali non valide.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login - Porsche</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Open Sans', sans-serif; background: #121212; color: #fff; margin: 0; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-box { background: #1e1e1e; padding: 40px; border-radius: 8px; width: 350px; border-top: 4px solid #cc0000; box-shadow: 0 10px 30px rgba(0,0,0,0.8); text-align: center; }
        h2 { font-size: 2rem; color: #fff; margin-bottom: 20px;}
        input { width: 90%; padding: 12px; margin: 10px 0; border: none; border-radius: 4px; background: #2a2a2a; color: white; outline: none; }
        input:focus { border-bottom: 2px solid #cc0000; }
        .btn-login { width: 100%; background: #cc0000; color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-family: 'Oswald', sans-serif; font-size: 1.1rem; margin-top: 15px; }
        .btn-login:hover { background: #ff1a1a; }
        .errore { color: #ff4d4d; margin-top: 10px; font-weight: bold; }
        .btn-back { display: block; margin-top: 20px; color: #888; text-decoration: none; }
        .btn-back:hover { color: #fff; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Area Personale</h2>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="La tua Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn-login">ACCEDI</button>
        </form>
        <?php if($errore) echo "<p class='errore'>$errore</p>"; ?>
        <a href="index.php" class="btn-back"><-- Torna alla Home</a>
    </div>
</body>
</html>