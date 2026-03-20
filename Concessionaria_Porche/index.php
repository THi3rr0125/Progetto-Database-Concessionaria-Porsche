
<!DOCTYPE html>
<html>

<?php
    include("inc/checkLogin.php");
?>

<head>
    <title>Concessionario Porsche</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; }
        h1 { text-align: center; }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
            background: white;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th { background: #333; color: white; }
    </style>
</head>
<body>

<h1>Lista Veicoli</h1>

<table>
<tr>
    <th>Targa</th>
    <th>Prezzo</th>
    <th>Colore</th>
    <th>Modello</th>
</tr>

<?php
$sql = "SELECT v.targa, v.prezzo, v.colore, m.nome
        FROM veicolo_porsche v
        JOIN modello_porsche m ON v.id_modello = m.id_modello";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['targa']}</td>
            <td>{$row['prezzo']} €</td>
            <td>{$row['colore']}</td>
            <td>{$row['nome']}</td>
          </tr>";
}
?>
</table>

<h1>Clienti</h1>

<table>
<tr>
    <th>Nome</th>
    <th>Cognome</th>
    <th>Email</th>
</tr>

<?php
$sql = "SELECT * FROM cliente";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['nome']}</td>
            <td>{$row['cognome']}</td>
            <td>{$row['email']}</td>
          </tr>";
}
?>
</table>

<?php
    } catch (PDOException $e) {
        die("<h2 style='color: red;'>Errore di connessione: " . $e->getMessage() . "</h2>");
    }
?>

</body>
</html>