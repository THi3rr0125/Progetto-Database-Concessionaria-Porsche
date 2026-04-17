<?php
// dettaglio.php
require 'config.php';

if (!isset($_GET['targa'])) { die("Nessuna targa."); }
$targa = $_GET['targa'];

$sql = "SELECT * FROM veicolo_porsche v 
        JOIN modello_porsche m ON v.id_modello = m.id_modello 
        WHERE v.targa = '$targa'";
$result = $conn->query($sql);

if ($result->num_rows == 0) { die("Veicolo non trovato."); }
$auto = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dettaglio <?php echo $auto['nome']; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Open Sans', sans-serif; background: #121212; color: #fff; margin: 0; }
        h1, h2 { font-family: 'Oswald', sans-serif; text-transform: uppercase; }
        .navbar { background: #0a0a0a; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #cc0000; }
        .nav-links a, .btn-back { color: #fff; text-decoration: none; padding: 8px 15px; margin-left: 10px; background: #222; border-radius: 4px; transition: 0.3s; cursor: pointer; border: none; font-size: 1rem; }
        .nav-links a:hover, .btn-back:hover { background: #cc0000; }
        
        .container { max-width: 900px; margin: 40px auto; background: #1e1e1e; border-radius: 10px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.5); border-top: 5px solid #cc0000;}
        .img-header { width: 100%; height: 400px; object-fit: cover; }
        .content { padding: 40px; }
        .titolo { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #333; padding-bottom: 20px; margin-bottom: 30px;}
        .titolo h1 { margin: 0; font-size: 3rem; color: #fff; }
        .titolo h2 { margin: 0; color: #cc0000; font-size: 2rem;}
        
        .grid-specifiche { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .spec { background: #2a2a2a; padding: 15px; border-radius: 5px; border-left: 4px solid #cc0000; }
        .spec span { display: block; font-size: 0.8rem; color: #888; text-transform: uppercase; margin-bottom: 5px;}
        .spec strong { font-size: 1.2rem; }
    </style>
</head>
<body>

<div class="navbar">
    <button onclick="history.back()" class="btn-back"> Indietro</button>
    <div class="nav-links">
        <a href="index.php"> Home</a>
    </div>
</div>

<div class="container">
    <img src="img/<?php echo $auto['targa']; ?>.jpg" class="img-header" alt="Porsche <?php echo $auto['nome']; ?>" onerror="this.src='https://via.placeholder.com/900x400/1e1e1e/cc0000?text=FOTO+NON+DISPONIBILE'">
    
    <div class="content">
        <div class="titolo">
            <h1><?php echo $auto['nome']; ?></h1>
            <h2>€ <?php echo number_format($auto['prezzo'], 2, ',', '.'); ?></h2>
        </div>
        
        <div class="grid-specifiche">
            <div class="spec"><span>Targa</span> <strong><?php echo $auto['targa']; ?></strong></div>
            <div class="spec"><span>Motore</span> <strong><?php echo $auto['alimentazione']; ?></strong></div>
            <div class="spec"><span>Potenza</span> <strong><?php echo $auto['kW']; ?> kW (<?php echo $auto['cavalli']; ?> CV)</strong></div>
            <div class="spec"><span>0-100 km/h</span> <strong><?php echo $auto['accellerazione']; ?> sec</strong></div>
            <div class="spec"><span>Velocità Massima</span> <strong><?php echo $auto['velocita_massima']; ?> km/h</strong></div>
            <div class="spec"><span>Colore</span> <strong><?php echo $auto['colore']; ?></strong></div>
            <div class="spec"><span>Stato</span> <strong><?php echo $auto['usato'] ? 'Usato' : 'Nuovo'; ?></strong></div>
            <div class="spec"><span>Telaio</span> <strong><?php echo $auto['telaio']; ?></strong></div>
        </div>
    </div>
</div>

</body>
</html>