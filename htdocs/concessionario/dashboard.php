<?php
// dashboard.php
session_start();
require 'config.php';

// Ho eliminato il blocco che obbligava al login! Ora tutti possono entrare.
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard Auto</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Open Sans', sans-serif; background: #121212; color: #fff; margin: 0; padding-bottom: 50px; }
        h1, h2 { font-family: 'Oswald', sans-serif; text-transform: uppercase; }
        .navbar { background: #0a0a0a; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #cc0000; }
        .nav-links a, .btn-back { color: #fff; text-decoration: none; padding: 8px 15px; margin-left: 10px; background: #222; border-radius: 4px; transition: 0.3s; cursor: pointer; border: none; font-size: 1rem; }
        .nav-links a:hover, .btn-back:hover { background: #cc0000; }
        
        .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }
        .header-dash { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid #333; padding-bottom: 15px;}
        .header-dash h1 { font-size: 2.5rem; color: #fff; }
        .btn-aggiungi { background: #cc0000; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold; font-family: 'Oswald', sans-serif; letter-spacing: 1px;}
        .btn-aggiungi:hover { background: #ff1a1a; }
        
        .grid-auto { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        .card { background: #1e1e1e; border-radius: 8px; overflow: hidden; transition: 0.3s; border: 1px solid #2a2a2a; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.5); border-color: #cc0000; }
        .card img { width: 100%; height: 200px; object-fit: cover; }
        .card-info { padding: 20px; }
        .card-info h2 { color: #cc0000; margin-bottom: 5px; }
        .prezzo { font-size: 1.2rem; font-weight: bold; color: #ddd; margin-bottom: 15px; }
        .btn-dettaglio { display: block; text-align: center; background: #333; color: white; padding: 10px; text-decoration: none; border-radius: 4px; font-weight: bold; }
        .btn-dettaglio:hover { background: #555; }
    </style>
</head>
<body>

<div class="navbar">
    <div style="font-family: 'Oswald'; font-size: 1.5rem;">
        <?php 
        // Se è loggato mostra il nome, altrimenti "Ospite"
        if(isset($_SESSION['nome_utente'])) {
            echo "Ciao, " . $_SESSION['nome_utente'];
        } else {
            echo "Benvenuto, Ospite";
        }
        ?>
    </div>
    <div class="nav-links">
        <a href="index.php"> Home</a>
        <?php if(isset($_SESSION['utente_loggato'])): ?>
            <a href="logout.php"> Logout</a>
        <?php else: ?>
            <a href="login.php"> Area Dipendenti</a>
        <?php endif; ?>
    </div>
</div>

<div class="container">
    <div class="header-dash">
        <h1>Garage Vetture</h1>
        <?php 
        // Mostra il tasto Aggiungi SOLO se sei loggato come dipendente
        if(isset($_SESSION['utente_loggato'])): 
        ?>
            <a href="aggiungi.php" class="btn-aggiungi">+ INSERISCI AUTO</a>
        <?php endif; ?>
    </div>

    <div class="grid-auto">
        <?php
        $sql = "SELECT v.targa, v.prezzo, m.nome 
                FROM veicolo_porsche v 
                JOIN modello_porsche m ON v.id_modello = m.id_modello";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $targa = $row['targa'];
                $nome = $row['nome'];
                $prezzo = number_format($row['prezzo'], 2, ',', '.');
                
                echo "<div class='card'>
                        <img src='img/{$targa}1.jpg' alt='Foto {$nome}' onerror=\"this.src='https://via.placeholder.com/300x200/1e1e1e/cc0000?text=PORSCHE'\">
                        <div class='card-info'>
                            <h2>{$nome}</h2>
                            <div class='prezzo'>€ {$prezzo}</div>
                            <div style='color:#888; font-size:0.9rem; margin-bottom:15px;'>Targa: {$targa}</div>
                            <a href='dettaglio.php?targa={$targa}' class='btn-dettaglio'>SCHEDA TECNICA</a>
                        </div>
                      </div>";
            }
        } else {
            echo "<p>Nessun veicolo presente.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>