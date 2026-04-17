<?php
// aggiungi.php
session_start();
require 'config.php';

// Se l'utente non e loggato, lo rimandiamo al login
if (!isset($_SESSION['utente_loggato'])) {
    header("Location: login.php");
    exit;
}

$messaggio = "";

// Se il modulo e stato inviato
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $targa = $_POST['targa'];
    $id_modello = $_POST['id_modello'];
    $telaio = $_POST['telaio'];
    $alimentazione = $_POST['alimentazione'];
    $kw = $_POST['kw'];
    $cavalli = $_POST['cavalli'];
    $accellerazione = $_POST['accellerazione'];
    $velocita_massima = $_POST['velocita_massima'];
    $colore = $_POST['colore'];
    $usato = $_POST['usato'];
    $prezzo = $_POST['prezzo'];

    // Inseriamo i dati nel database
    $sql = "INSERT INTO veicolo_porsche (targa, id_modello, telaio, alimentazione, kW, cavalli, accellerazione, velocita_massima, colore, usato, prezzo) 
            VALUES ('$targa', '$id_modello', '$telaio', '$alimentazione', '$kw', '$cavalli', '$accellerazione', '$velocita_massima', '$colore', '$usato', '$prezzo')";

    if ($conn->query($sql) === TRUE) {
        $messaggio = "<div class='success'> Veicolo inserito con successo! <a href='dashboard.php'>Torna al garage</a></div>";
    } else {
        $messaggio = "<div class='error'> Errore nell'inserimento: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Aggiungi Veicolo - Porsche</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Open Sans', sans-serif; background: #121212; color: #fff; margin: 0; padding-bottom: 50px;}
        h1, h2 { font-family: 'Oswald', sans-serif; text-transform: uppercase; color: #cc0000;}
        
        .navbar { background: #0a0a0a; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #cc0000; }
        .nav-links a, .btn-back { color: #fff; text-decoration: none; padding: 8px 15px; margin-left: 10px; background: #222; border-radius: 4px; transition: 0.3s; cursor: pointer; border: none; font-size: 1rem; }
        .nav-links a:hover, .btn-back:hover { background: #cc0000; }

        .container { max-width: 800px; margin: 40px auto; background: #1e1e1e; padding: 30px; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); border-top: 5px solid #cc0000;}
        
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-size: 0.9rem; color: #888; margin-bottom: 5px; text-transform: uppercase; font-weight: bold;}
        .form-group input, .form-group select { padding: 12px; border: none; border-radius: 4px; background: #2a2a2a; color: white; outline: none; font-family: 'Open Sans', sans-serif; }
        .form-group input:focus, .form-group select:focus { border-bottom: 2px solid #cc0000; }
        
        /* Fa in modo che la Targa e il Prezzo occupino tutta la larghezza */
        .full-width { grid-column: span 2; }

        .btn-submit { width: 100%; background: #cc0000; color: white; padding: 15px; border: none; border-radius: 4px; cursor: pointer; font-family: 'Oswald', sans-serif; font-size: 1.2rem; margin-top: 20px; letter-spacing: 1px; transition: 0.3s;}
        .btn-submit:hover { background: #ff1a1a; }

        .success { background: #1b5e20; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center; }
        .success a { color: #fff; text-decoration: underline; font-weight: bold;}
        .error { background: #b71c1c; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center; }
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
    <h1>Inserisci Nuova Vettura</h1>
    <p style="color: #aaa; margin-bottom: 30px;">Compila tutti i campi per registrare un nuovo veicolo nel database della concessionaria.</p>

    <?php echo $messaggio; ?>

    <form method="POST" action="">
        <div class="form-grid">
            <div class="form-group full-width">
                <label>Targa</label>
                <input type="text" name="targa" placeholder="Es. AB123CD" required>
            </div>
            
            <div class="form-group">
                <label>ID Modello (1=911, 2=Cayenne, ecc.)</label>
                <input type="number" name="id_modello" required>
            </div>
            
            <div class="form-group">
                <label>Telaio</label>
                <input type="text" name="telaio" required>
            </div>
            
            <div class="form-group">
                <label>Alimentazione</label>
                <select name="alimentazione" required>
                    <option value="Benzina">Benzina</option>
                    <option value="Ibrida">Ibrida</option>
                    <option value="Elettrica">Elettrica</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Colore</label>
                <input type="text" name="colore" required>
            </div>

            <div class="form-group">
                <label>Potenza (kW)</label>
                <input type="number" name="kw" required>
            </div>
            
            <div class="form-group">
                <label>Cavalli (CV)</label>
                <input type="number" name="cavalli" required>
            </div>

            <div class="form-group">
                <label>Accelerazione 0-100 (sec)</label>
                <input type="number" step="0.1" name="accellerazione" required>
            </div>
            
            <div class="form-group">
                <label>Velocita Massima (km/h)</label>
                <input type="number" name="velocita_massima" required>
            </div>

            <div class="form-group">
                <label>Condizione</label>
                <select name="usato" required>
                    <option value="0">Nuovo (0 km)</option>
                    <option value="1">Usato</option>
                </select>
            </div>

            <div class="form-group full-width">
                <label>Prezzo (€)</label>
                <input type="number" step="0.01" name="prezzo" placeholder="Es. 120000" required>
            </div>
        </div>

        <button type="submit" class="btn-submit">REGISTRA VEICOLO NEL GARAGE</button>
    </form>
</div>

</body>
</html>