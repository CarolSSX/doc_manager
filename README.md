# Document Manager - File Upload and Digital Signature

## Descrizione

Questa applicazione permette di caricare file in un server e firmarli digitalmente per garantire la loro integrità e autenticità. L'applicazione utilizza tecniche di crittografia, come SHA-256 per il calcolo dell'hash e la firma digitale con una chiave privata.

## Funzionalità

1. **Caricamento dei file**: Gli utenti possono caricare file tramite un modulo HTML.
2. **Calcolo dell'hash del file**: L'applicazione calcola un hash (SHA-256) del file per garantire che non venga modificato durante il caricamento.
3. **Firma digitale del file**: L'applicazione firma digitalmente l'hash del file utilizzando una chiave privata.
4. **Salvataggio della firma**: La firma digitale del file viene salvata in un file separato con estensione `.sig`.

## Tecnologie utilizzate

- PHP
- OpenSSL (per la firma digitale)
- HTML e CSS per il frontend
- Apache (o altro web server)

## Come funziona

1. **Caricamento del file**:
   - L'utente seleziona un file e lo carica tramite un modulo HTML.
   - Il file viene salvato nella cartella `documents/uploads/`.

2. **Calcolo dell'hash**:
   - Dopo che il file è stato caricato, viene calcolato l'hash SHA-256 del file.
   
3. **Firma digitale**:
   - L'applicazione firma l'hash del file con una chiave privata RSA.
   - La firma viene salvata in un file `.sig` nella cartella `documents/signatures/`.

## Requisiti

1. Un server PHP con OpenSSL abilitato.
2. Creare e configurare una chiave privata (`private.pem`) e una chiave pubblica (`public.pem`).

## Come avviare il progetto

1. **Installa il server web** (ad esempio XAMPP o LAMP) e assicurati che PHP e OpenSSL siano configurati correttamente.
2. **Crea la cartella `documents/uploads/`** per i file caricati.
3. **Crea la cartella `documents/signatures/`** per salvare le firme digitali.
4. **Crea la chiave privata** (`private.pem`) e la chiave pubblica (`public.pem`) utilizzando OpenSSL.
5. **Modifica i permessi delle cartelle** per garantire che siano scrivibili dal server web.
6. **Carica il progetto nel tuo server web** e avvia l'applicazione accedendo tramite un browser.

## Importanza della Firma Digitale

La firma digitale è un meccanismo di sicurezza fondamentale per garantire l'integrità e l'autenticità di un file. Essa:
- **Garantisce l'integrità**: Verifica che il file non sia stato modificato dopo la sua firma.
- **Autenticazione**: Permette di verificare l'identità di chi ha firmato il file.
- **Conformità legale**: In alcuni contesti, la firma digitale ha valore legale ed è utilizzata per validare contratti e documenti ufficiali.

## Sicurezza e Protezione delle Chiavi

Le chiavi private devono essere protette per garantire che solo l'autore del file possa firmare i documenti. È fondamentale mantenere la chiave privata **segreta** e proteggerla con adeguate misure di sicurezza.

---

