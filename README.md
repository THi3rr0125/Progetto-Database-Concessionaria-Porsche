# README.md

## ER Diagram Corrections

1. **CONTRATTO entity**:  
   - Change `int id_preventivo PK FK` to `int id_contratto PK`.  
   - Add foreign keys for `id_cliente`, `id_veicolo`, `id_venditore`.

2. **Rename** `RICAMBI` to `MAGAZZINO_RICAMBI` in ER diagram.

3. **PREVENTIVO**:  
   - Add `id_venditore FK` to ER diagram.

4. **APPUNTAMENTO_OFFICINA**:  
   - Add `id_ricambio FK` to schema logico.

5. **Missing Relationships**:  
   - Add relationships between `PREVENTIVO` to `CONTRATTO` and `VENDITORE` to `PREVENTIVO` in ER diagram.

6. **Orthography Corrections**:  
   - Change `ed e possibile` to `ed è possibile`.  
   - Change `l apposita` to `l'apposita`.

7. **APPUNTAMENTO_OFFICINA entity**:  
   - Add `id_ricambio FK` to ER diagram.