<?php
require_once 'db.php';

// Impostiamo la directory di destinazione per i file caricati
$targetDirectory = __DIR__ . "/../documents/uploads/"; // Percorso assoluto

// Verifica che la variabile $_FILES contenga il file
if (isset($_FILES["fileToUpload"])) {

    // Ottieni il nome del file
    $fileName = basename($_FILES["fileToUpload"]["name"]);

    // Crea il percorso completo di destinazione
    $targetFile = $targetDirectory . $fileName;

    // Controlla che il file non esista già (opzionale, puoi rimuovere questa parte se non ti interessa)
    if (file_exists($targetFile)) {
        echo "Il file esiste già.";
        exit;
    }

    // Verifica che non ci siano errori di upload
    if ($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
        // Carica il file nella cartella "uploads"
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "File caricato con successo.";

            // Calcola l'hash del file (SHA-256)
            $fileHash = hash_file('sha256', $targetFile);


            // Firmiamo l'hash del file con la chiave privata
            $privateKey = file_get_contents('../private.pem');
            if (!$privateKey) {
                echo "Errore nel leggere la chiave privata.";
                exit;
            }

            if (openssl_pkey_get_private($privateKey)) {
                openssl_sign($fileHash, $signature, $privateKey, OPENSSL_ALGO_SHA256);
                echo " Firma generata correttamente.";
            } else {
                echo "Errore nella lettura della chiave privata.";
            }

            // Salva la firma (puoi implementarlo o saltare questo passaggio)
            file_put_contents('../documents/signatures/' . $fileName . '.sig', $signature);

        } else {
            echo "Si è verificato un errore durante il caricamento del file.";
        }
    } else {
        echo "Errore durante il caricamento del file. Codice errore: " . $_FILES["fileToUpload"]["error"];
    }
} else {
    echo "Nessun file caricato.";
}
?>
