<?php
    if(session_status() != PHP_SESSION_ACTIVE))
        session_start();

    include("inc/datiConnessione.php");
    try {
        include("inc/connettiDB.php");
        // Flag per sapere se l'utente è loggato o no (utile per mostrare o nascondere certi elementi nelle pagine)
        // inizialmente è false, se il controllo va a buon fine lo diventa
        $logged = false;

        // Controlla se in sessione sono già presenti mail e password (quindi l'utente è già loggato)
        if(isset($_SESSION['mail']) && !empty($_SESSION['mail']) && isset($_SESSION['pwd']) && !empty($_SESSION['pwd'])) {
            // Se sono presenti, li salva in variabili locali
            $mail = $_SESSION['mail'];
            $pwd = $_SESSION['pwd'];

            // Cerca nel DB un utente che abbia la mail inserita nel form recuperando anche password e salt
            $query = "SELECT ID_Utente, pwd, salt FROM UTENTE WHERE email = '$mail'";
            $risultato = $$conn->query($query);

            // Se trova almeno una riga (quindi la mail esiste nel DB)
            if($risultato->num_rows != 1){
                // Se non trova nessuna riga o ne trova più di una, c'è un problema. Lo rimanda alla pagina di login
                session_unset(); // Pulisce tutte le variabili di sessione
                header("Location: login.php?errore=1");
            }
            // Se trova esattamente una riga, continua con il controllo della password
            $row = $risultato->fetch_assoc();
            // Divide a metà la stringa del 'salt' (la parola casuale usata per sporcare l'hash)
            $salt_div = str_split($row["salt"], strlen($row["salt"])/2);
            // Ricrea l'hash di controllo assemblando: prima metà del salt + password del JS + seconda metà del salt
            $pass_salt = hash('sha256', $salt_div[0] . $pwd . $salt_div[1]);
            // Controlla se l'hash appena calcolato è identico a quello salvato nel database
            if($pass_salt === $row["pwd"]) {
                 // Se coincidono, la password è giusta!
                // Salvo un flag per sapere se è loggato o no (utile per mostrare o nascondere certi elementi nelle pagine)
                $logged = true;
                // controllo se trovo una corrispondenza dell'utente nella tabella venditore (per capire se è un cliente o un venditore)
                $query = "SELECT * FROM UTENTE INNER JOIN VENDITORE ON UTENTE.ID_Utente = VENDITORE.ID_Venditore WHERE ID_Utente = " . $row['ID_Utente'];
                $risultato = $conn->query($query);
                
                if($risultato->num_rows == 1)
                    // Se trova una riga, è un venditore
                    $datiVenditore = $risultato->fetch_assoc();
                else 
                    // Altrimenti è un cliente
                    $datiCliente = $row; // I dati del cliente sono già in $row, non serve fare un'altra query
                
                // Lo reindirizza alla sua area personale
                header("Location: dashboard.php");
            } else {
                // Se l'hash non coincide, la password è errata. Lo rimanda alla pagina di login
                session_unset(); // Pulisce tutte le variabili di sessione
                header("Location: login.php?errore=2");
            }
        }
    } catch (PDOException $e) {
        die("<h2 style='color: red;'>Errore di connessione: " . $e->getMessage() . "</h2>");
    }
?>