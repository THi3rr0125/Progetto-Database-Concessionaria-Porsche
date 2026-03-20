<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login / Registrazione</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Benvenuto in Eccessolandia</h2>

        <?php
        // Se nell'URL c'è la variabile "errore" (es. index.php?errore=1), mostra il messaggio rosso
            // Questo è per gli errori di login
            if (isset($_GET['errore'])) {
                switch($_GET['errore']) {
                    case '1':
                        echo "<div class='alert alert-danger'>Attenzione: Utente non trovato. Riprova!</div>";
                        break;
                    case '2':
                        echo "<div class='alert alert-warning'>Attenzione: Password errata. Riprova!</div>";
                        break;
                    case '3':
                        echo "<div class='alert alert-warning'>Attenzione: Email o password mancanti. Riprova!</div>";
                        break;
                    default:
                        echo "<div class='alert alert-danger'>Attenzione: Email o password errati. Riprova!</div>";
            }
        }
        ?>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card p-4 shadow-sm">
                    <h3>Accedi</h3>
                    <form id="formAccedi" action="auth.php" method="POST"> 
                        Email: <input type="email" name="email" class="form-control mb-2" required>
                        Password: <input id="pwdAccedi" type="password" name="pwd" class="form-control mb-3" required>
                        <button type="submit" class="btn btn-primary w-100">Entra</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <h3>Registrati</h3>
                    <form id="formRegistrati" action="registra.php" method="POST">
                        Nome: <input type="text" name="nome" class="form-control mb-2" required>
                        Cognome: <input type="text" name="cognome" class="form-control mb-2" required>
                        Email: <input type="email" name="email" class="form-control mb-2" required>
                        Password: <input id="pwdRegistrati" type="password" name="pwd" class="form-control mb-2" required>
                        Telefono: <input type="text" name="telefono" class="form-control mb-2" required>
                        Indirizzo: <input type="text" name="indirizzo" class="form-control mb-3" required>
                        <button type="submit" class="btn btn-success w-100">Registrati</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>// Funzione che prende una stringa di testo e restituisce il suo hash in SHA-256 (64 caratteri)
        async function sha256(message) {
            const msgBuffer = new TextEncoder().encode(message); 
            const hashBuffer = await crypto.subtle.digest('SHA-256', msgBuffer); 
            const hashArray = Array.from(new Uint8Array(hashBuffer)); 
            const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join(''); 
            return hashHex;
        }
// Funzione che gestisce cosa succede quando premi "Entra" o "Registrati"
        async function gestisciSubmit(e, idPasswordInput) {
            e.preventDefault(); 
            const passwordInput = document.getElementById(idPasswordInput);// Sostituisce la password in chiaro digitata dall'utente con il suo hash SHA-256
            passwordInput.value = await sha256(passwordInput.value);
            e.target.submit();
        }
// Ascolta il click sui pulsanti submit dei due form e fa partire la conversione della password
        document.getElementById('formAccedi').addEventListener('submit', e => gestisciSubmit(e, 'pwdAccedi'));
        document.getElementById('formRegistrati').addEventListener('submit', e => gestisciSubmit(e, 'pwdRegistrati'));
    </script>
</body>
</html>