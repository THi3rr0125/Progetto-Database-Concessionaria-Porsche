---
config:
  layout: elk
---
erDiagram

  MODELLO_PORSCHE {
      int id_modello PK
      string nome
      int anno_produzione
      string motorizzazione
  }

  VEICOLO_PORSCHE {
      int id_veicolo PK
      string telaio
      string stato
      float prezzo
      boolean usato
      int id_modello FK
  }

  CLIENTE {
      int id_cliente PK
      string nome
      string cognome
      string telefono
      string email
  }

  VENDITORE {
      int id_venditore PK
      string nome
      string cognome
      float percentuale_provvigione
  }

  PREVENTIVO {
      int id_preventivo PK
      date data
      float prezzo_proposto
      string stato
      int id_cliente FK
      int id_veicolo FK
  }

  CONTRATTO {
      int id_contratto PK
      date data_vendita
      float importo_finale
      boolean finanziamento
      int id_cliente FK
      int id_veicolo FK
      int id_venditore FK
  }

  TEST_DRIVE {
      int id_test_drive PK
      date data
      string esito
      int id_cliente FK
      int id_veicolo FK
  }

  APPUNTAMENTO_OFFICINA {
      int id_appuntamento PK
      date data
      string tipo_intervento
      int id_veicolo FK
  }

  MAGAZZINO_RICAMBI {
      int id_ricambio PK
      string nome
      int quantita
      float costo
  }

  MODELLO_PORSCHE ||--o{ VEICOLO_PORSCHE : comprende
  CLIENTE ||--o{ PREVENTIVO : richiede
  VEICOLO_PORSCHE ||--o{ PREVENTIVO : riguarda
  CLIENTE ||--o{ CONTRATTO : firma
  VEICOLO_PORSCHE ||--|| CONTRATTO : venduto
  VENDITORE ||--o{ CONTRATTO : gestisce
  CLIENTE ||--o{ TEST_DRIVE : prenota
  VEICOLO_PORSCHE ||--o{ TEST_DRIVE : usato
  VEICOLO_PORSCHE ||--o{ APPUNTAMENTO_OFFICINA : ha
  APPUNTAMENTO_OFFICINA ||--o{ MAGAZZINO_RICAMBI : utilizza

Spiegazione: Il diagramma ER mostra tutte le entità principali della concessionaria Porsche e le loro relazioni. Non è stata creata una tabella MARCA separata perché tutti i veicoli sono Porsche.

    corretto e arricchito codice con attributi

    
