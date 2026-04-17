<?php 
// index.php
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home - Concessionario Porsche</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Open Sans', sans-serif; background: #121212; color: #fff; margin: 0; }
        h1, h2, h3 { font-family: 'Oswald', sans-serif; text-transform: uppercase; margin: 0; }
        
        .navbar { background: #0a0a0a; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #cc0000; }
        .logo { font-family: 'Oswald', sans-serif; font-size: 1.8rem; color: #cc0000; letter-spacing: 2px; }
        .nav-links a { color: #fff; text-decoration: none; padding: 8px 15px; margin-left: 10px; background: #222; border-radius: 4px; transition: 0.3s; font-weight: 600;}
        .nav-links a:hover { background: #cc0000; }

        .hero { height: calc(100vh - 70px); display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.8)), url('img/sfondo.jpg') center/cover; }
        .hero h1 { font-size: 5rem; color: #fff; letter-spacing: 4px; text-shadow: 2px 2px 10px #000; }
        .hero span { color: #cc0000; }
        .hero p { font-size: 1.2rem; color: #aaa; max-width: 600px; margin: 20px 0 40px 0; }
        
        .btn-main { background: #cc0000; color: #fff; padding: 15px 40px; text-decoration: none; font-size: 1.3rem; font-family: 'Oswald', sans-serif; border-radius: 3px; letter-spacing: 1px; transition: 0.3s;}
        .btn-main:hover { background: #ff1a1a; box-shadow: 0 0 15px rgba(204,0,0,0.6); }
    </style>
</head>
<body>

<div class="navbar">
    <div class="logo">PORSCHE</div>

    <div class="nav-links">
        <a href="dashboard.php"> Garage</a>
        <?php if(isset($_SESSION['utente_loggato'])): ?>
            <a href="logout.php"> Logout</a>
        <?php else: ?>
            <a href="login.php"> Area Dipendenti</a>
        <?php endif; ?>
    </div>
</div>

<div class="hero">
    <h1>Exclusive <span>Motors</span></h1>
    <p>Esplora l'eccellenza del nostro parco auto. Trova la Porsche dei tuoi sogni.</p>
    <a href="dashboard.php" class="btn-main">ENTRA NEL GARAGE DI GRANGE</a>
</div>

</body>
</html>