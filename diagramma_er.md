erDiagram
    MODELLO ||--o{ VEICOLO : comprende
    CLIENTE ||--o{ PREVENTIVO : richiede
    VEICOLO ||--o{ PREVENTIVO : riguarda
    CLIENTE ||--o{ CONTRATTO : firma
    VEICOLO ||--|| CONTRATTO : venduto
    VENDITORE ||--o{ CONTRATTO : gestisce
    CLIENTE ||--o{ TEST_DRIVE : prenota
    VEICOLO ||--o{ TEST_DRIVE : usato
    VEICOLO ||--o{ APPUNTAMENTO_OFFICINA : ha
    VEICOLO ||--o{ MAGAZZINO_RICAMBI : richiede
    APPUNTAMENTO_OFFICINA ||--o{ MAGAZZINO_RICAMBI : utilizza

    Aggiunto codice diagramma ER

    
