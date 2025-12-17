# Progetto-Database-Concessionaria-Porsche
Sistema di Gestione Concessionaria Porsche
Studente: Thierry Grange
Classe: 5ª – Istituto Tecnico Manzetti
Data: 17/12/2025

*Indice

  Introduzione
  
  Analisi dei requisiti
  
  Diagramma Entità-Relazione (ER)
  
  Schema Logico Relazionale
  
  Dizionario dei Dati
  
  Script SQL
  
  Conclusioni


*Introduzione

  Il progetto riguarda la progettazione del database di una concessionaria Porsche, specializzata nella vendita di veicoli sportivi nuovi e usati. Il           database ha lo scopo di gestire in modo ordinato veicoli, clienti, venditori e le principali attività commerciali della concessionaria.

*Analisi dei requisiti
  
  Il sistema deve permettere di:
  
  Gestire veicoli Porsche nuovi e usati con caratteristiche tecniche
  
  Gestire modelli Porsche
  
  Registrare clienti e storico acquisti
  
  Gestire venditori e provvigioni
  
  Creare preventivi e trattative
  
  Registrare contratti di vendita e finanziamenti
  
  Gestire servizio post-vendita e appuntamenti officina
  
  Gestire magazzino ricambi

*Vincoli richiesti:

  Un veicolo può avere più preventivi
  
  Un veicolo può essere venduto una sola volta
  
  Ogni veicolo ha uno stato: disponibile, riservato, venduto
  
  Prenotare test drive

  DIAGRAMMA ER AGGIUNTO NEL FILE "diagramma_er.md".

  *Schema Logico Relazionale

  MODELLO_PORSCHE(id_modello PK, nome, motorizzazione)
  
  VEICOLO_PORSCHE(id_veicolo PK, telaio, anno, prezzo, stato, id_modello FK)
  
  CLIENTE(id_cliente PK, nome, cognome, telefono, email)
  
  VENDITORE(id_venditore PK, nome, cognome, provvigione)
  
  PREVENTIVO(id_preventivo PK, data, prezzo_proposto, id_cliente FK, id_veicolo FK)
  
  CONTRATTO(id_contratto PK, data_vendita, prezzo_finale, id_cliente FK, id_veicolo FK UNIQUE, id_venditore FK)
  
  TEST_DRIVE(id_test_drive PK, data, id_cliente FK, id_veicolo FK)
  
  APPUNTAMENTO_OFFICINA(id_appuntamento PK, data, id_veicolo FK, note)
  
  MAGAZZINO_RICAMBI(id_ricambio PK, nome, quantita, id_veicolo FK)

    
    aggiunto Schema Logico Relazionale
