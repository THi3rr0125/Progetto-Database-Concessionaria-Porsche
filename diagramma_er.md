---
config:
  layout: elk
---
erDiagram
MODELLO_PORSCHE ||--o{ VEICOLO_PORSCHE : comprende
CLIENTE ||--o{ PREVENTIVO : richiede
VEICOLO_PORSCHE ||--o{ PREVENTIVO : riguarda
CLIENTE ||--o{ CONTRATTO : firma
VEICOLO_PORSCHE ||--|| CONTRATTO : venduto
VENDITORE ||--o{ CONTRATTO : gestisce
CLIENTE ||--o{ TEST_DRIVE : prenota
VEICOLO_PORSCHE ||--o{ TEST_DRIVE : usato
VEICOLO_PORSCHE ||--o{ APPUNTAMENTO_OFFICINA : ha
VEICOLO_PORSCHE ||--o{ MAGAZZINO_RICAMBI : richiede
APPUNTAMENTO_OFFICINA ||--o{ MAGAZZINO_RICAMBI : utilizza

Spiegazione: Il diagramma ER mostra tutte le entità principali della concessionaria Porsche e le loro relazioni. Non è stata creata una tabella MARCA separata perché tutti i veicoli sono Porsche.

    Aggiunta spiegazione diagramma

    
