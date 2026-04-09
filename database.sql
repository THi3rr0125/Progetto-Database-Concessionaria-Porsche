/* Grange Thierry Classe 5C IT */

/* Grange Thierry Classe 5C IT */

DROP DATABASE IF EXISTS concessionario_porsche;
CREATE DATABASE concessionario_porsche;
USE concessionario_porsche;


/* =========================
   MODELLO_PORSCHE
   ========================= */
CREATE TABLE modello_porsche (
  id_modello INT(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  nome VARCHAR(50) NOT NULL,
  anno_produzione YEAR NOT NULL,
  alimentazione ENUM('Diesel','Benzina','Hybrid','Elettrica') NOT NULL,
  kW FLOAT(5,1) UNSIGNED NOT NULL,
  accellerazione FLOAT(2,1) UNSIGNED NOT NULL,
  velocita_massima INT(3) UNSIGNED NOT NULL,
  cilindrata INT(4) UNSIGNED NOT NULL,
  coppia FLOAT(4,1) UNSIGNED NOT NULL,
  peso INT(4) UNSIGNED NOT NULL,
  motorizzazione VARCHAR(10) NOT NULL,
  numero_posti INT(1) UNSIGNED NOT NULL,
  numero_porte INT(1) UNSIGNED NOT NULL,
  numero_cilindri INT(2) UNSIGNED NOT NULL,
  PRIMARY KEY (id_modello)
);


/* =========================
   VEICOLO_PORSCHE
   ========================= */
CREATE TABLE veicolo_porsche (
  targa VARCHAR(10) NOT NULL,
  telaio VARCHAR(32) NOT NULL UNIQUE,
  prezzo FLOAT(8,2) NOT NULL,
  usato BOOLEAN NOT NULL DEFAULT FALSE,
  colore ENUM('Nero','Bianco','Rosso','Blu','Grigio') NOT NULL,
  id_modello INT(2) UNSIGNED ZEROFILL NOT NULL,
  PRIMARY KEY (targa),
  CONSTRAINT fk_veicolo_modello
    FOREIGN KEY (id_modello)
    REFERENCES modello_porsche(id_modello)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
);


/* =========================
   UTENTE
   ========================= */
CREATE TABLE utente (
   id_utente INT(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
   nome VARCHAR(30) NOT NULL,
   cognome VARCHAR(30) NOT NULL,
   telefono VARCHAR(20) UNIQUE NOT NULL,
   email VARCHAR(50) UNIQUE NOT NULL,
   password VARCHAR(64) NOT NULL,             
   salt VARCHAR(64) NOT NULL
);


/* =========================
   CLIENTE
   ========================= */
CREATE TABLE cliente (
  id_cliente INT(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
  CONSTRAINT fk_cliente_utente
    FOREIGN KEY (id_cliente) REFERENCES utente(id_utente)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);


/* =========================
   VENDITORE
   ========================= */
CREATE TABLE venditore (
  id_venditore INT(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
  percentuale_provvigione FLOAT(3,1) NOT NULL,
  CONSTRAINT fk_venditore_utente
    FOREIGN KEY (id_venditore) REFERENCES utente(id_utente)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);


/* =========================
   PREVENTIVO
   ========================= */
CREATE TABLE preventivo (
  id_preventivo INT(6) NOT NULL,
  data DATE NOT NULL,
  prezzo_proposto FLOAT(8,2) NOT NULL,
  stato VARCHAR(20),
  id_cliente INT(6) UNSIGNED ZEROFILL NOT NULL,
  targa VARCHAR(10) NOT NULL,
  PRIMARY KEY (id_preventivo),
  CONSTRAINT fk_preventivo_cliente
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT fk_preventivo_veicolo
    FOREIGN KEY (targa) REFERENCES veicolo_porsche(targa)
    ON DELETE RESTRICT ON UPDATE CASCADE
);


/* =========================
   CONTRATTO
   ========================= */
CREATE TABLE contratto (
  id_contratto INT NOT NULL,
  data_vendita DATE NOT NULL,
  importo_finale FLOAT NOT NULL,
  finanziamento BOOLEAN NOT NULL DEFAULT FALSE,
  id_cliente INT(6) UNSIGNED ZEROFILL NOT NULL,
  targa VARCHAR(10) NOT NULL UNIQUE,
  id_venditore INT NOT NULL,
  PRIMARY KEY (id_contratto),
  CONSTRAINT fk_contratto_cliente
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_contratto_veicolo
    FOREIGN KEY (targa) REFERENCES veicolo_porsche(targa)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_contratto_venditore
    FOREIGN KEY (id_venditore) REFERENCES venditore(id_venditore)
    ON DELETE RESTRICT ON UPDATE CASCADE
);


/* =========================
   TEST_DRIVE
   ========================= */
CREATE TABLE test_drive (
  id_test_drive INT NOT NULL,
  data DATE NOT NULL,
  esito VARCHAR(20),
  id_cliente INT(6) UNSIGNED ZEROFILL NOT NULL,
  targa VARCHAR(10) NOT NULL,
  PRIMARY KEY (id_test_drive),
  CONSTRAINT fk_testdrive_cliente
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_testdrive_veicolo
    FOREIGN KEY (targa) REFERENCES veicolo_porsche(targa)
    ON DELETE RESTRICT ON UPDATE CASCADE
);


/* =========================
   APPUNTAMENTO_OFFICINA
   ========================= */
CREATE TABLE appuntamento_officina (
  id_appuntamento INT NOT NULL,
  data DATE NOT NULL,
  tipo_intervento VARCHAR(50) NOT NULL,
  targa VARCHAR(10) NOT NULL,
  PRIMARY KEY (id_appuntamento),
  CONSTRAINT fk_appuntamento_veicolo
    FOREIGN KEY (targa) REFERENCES veicolo_porsche(targa)
    ON DELETE RESTRICT ON UPDATE CASCADE
);


/* =========================
   MAGAZZINO_RICAMBI
   ========================= */
CREATE TABLE magazzino_ricambi (
  id_ricambio INT NOT NULL,
  nome VARCHAR(50) NOT NULL,
  quantita INT NOT NULL,
  costo FLOAT NOT NULL,
  PRIMARY KEY (id_ricambio)
);


/* =========================
   UTILIZZO_RICAMBI
   ========================= */
CREATE TABLE utilizzo_ricambi (
  id_appuntamento INT NOT NULL,
  id_ricambio INT NOT NULL,
  quantita_usata INT NOT NULL,
  PRIMARY KEY (id_appuntamento, id_ricambio),
  CONSTRAINT fk_utilizzo_appuntamento
    FOREIGN KEY (id_appuntamento) REFERENCES appuntamento_officina(id_appuntamento)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_utilizzo_ricambio
    FOREIGN KEY (id_ricambio) REFERENCES magazzino_ricambi(id_ricambio)
    ON DELETE RESTRICT ON UPDATE CASCADE
);


/* =========================
   IMMAGINI
   ========================= */
CREATE TABLE immagini (
  cod_foto INT(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  targa VARCHAR(10) NOT NULL,
  numero_foto INT(2) UNSIGNED NOT NULL,
  estensione VARCHAR(5) NOT NULL,
  PRIMARY KEY (cod_foto),
  CONSTRAINT fk_immagini_veicolo
    FOREIGN KEY (targa) REFERENCES veicolo_porsche(targa)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
);


/*test*/

/* MODELLO_PORSCHE */
INSERT INTO modello_porsche VALUES
(1, '911 Carrera', 2023, 'Benzina'),
(2, 'Cayenne', 2022, 'Diesel'),
(3, 'Panamera', 2023, 'Ibrida'),
(4, '918 Spyder', 2013, 'Benzina'),
(5, 'Taycan', 2023, 'Elettrica');

/* VEICOLO_PORSCHE */
INSERT INTO veicolo_porsche VALUES
(1, 'TLA91112345', 'Disponibile', 120000, FALSE, 1),
(2, 'TLCAY22222', 'Disponibile', 95000, TRUE, 2),
(3, 'TLPAN33333', 'In vendita', 110000, FALSE, 3),
(4, 'TL91844444', 'Venduto', 1500000, TRUE, 4),
(5, 'TLTAY55555', 'Disponibile', 150000, FALSE, 5);

/* CLIENTE */
INSERT INTO cliente VALUES
(1, 'Thierry', 'Grange', '3331234567', 'thierry.Grange@email.com'),
(2, 'Julien', 'Lucianaz', '3347654321', 'julien.lucianaz@email.com'),
(3, 'ALessio', 'Tuscano', '3359876543', 'alessio.tuscano@email.com'),
(4, 'Silvie', 'Rial', '3361122334', 'silvie.Rial@email.com'),
(5, 'Riccardo', 'Bertelli', '3375566778', 'Riccardo.Bertelli@email.com');


/* VENDITORE */
INSERT INTO venditore VALUES
(1, 'Matthias', 'Negri', 5),
(2, 'Nicolò', 'Balini', 4),
(3, 'Carl', 'Benz', 6),
(4, 'Mattia', 'Bosco', 3.5),
(5, 'Lewis', 'Hamilton', 5.5);

/* PREVENTIVO */
INSERT INTO preventivo VALUES
(1, '2025-01-10', 118000, 'In attesa', 1, 1),
(2, '2025-01-15', 94000, 'Accettato', 2, 2),
(3, '2025-01-18', 108000, 'Rifiutato', 3, 3),
(4, '2025-01-20', 1500000, 'In attesa', 4, 4),
(5, '2025-01-22', 148000, 'Accettato', 5, 5);

/* CONTRATTO */
INSERT INTO contratto VALUES
(1, '2025-01-12', 119000, TRUE, 1, 1, 1),
(2, '2025-01-16', 95000, FALSE, 2, 2, 2),
(3, '2025-01-19', 109000, TRUE, 3, 3, 3),
(4, '2025-01-21', 1200000, FALSE, 4, 4, 4),
(5, '2025-01-23', 149000, TRUE, 5, 5, 5);

/* TEST_DRIVE */
INSERT INTO test_drive VALUES
(1, '2025-01-05', 'Positivo', 1, 1),
(2, '2025-01-06', 'Negativo', 2, 2),
(3, '2025-01-07', 'Positivo', 3, 3),
(4, '2025-01-08', 'Positivo', 4, 4),
(5, '2025-01-09', 'Negativo', 5, 5);

/* APPUNTAMENTO_OFFICINA */
INSERT INTO appuntamento_officina VALUES
(1, '2025-02-01', 'Tagliando', 1),
(2, '2025-02-02', 'Riparazione freni', 2),
(3, '2025-02-03', 'Cambio gomme', 3),
(4, '2025-02-04', 'Manutenzione generale', 4),
(5, '2025-02-05', 'Elettronica', 5);

/* MAGAZZINO_RICAMBI */
INSERT INTO magazzino_ricambi VALUES
(1, 'Filtro olio', 50, 25),
(2, 'Pastiglie freni', 30, 80),
(3, 'Candele', 100, 15),
(4, 'Olio motore', 200, 10),
(5, 'Batteria', 20, 120);

COMMIT;

 corretto errore nei dati test
