<?php
require_once 'db.php';

if (isset($_GET['file'])) {
    $fileName = $_GET['file'];
    $filePath = "../documents/uploads/{$fileName}";
    $signaturePath = "../documents/signatures/{$fileName}.sig";

    // Verifica se il file e la firma esistono
    if (file_exists($filePath) && file_exists($signaturePath)) {
        $fileHash = hash_file('sha256', $filePath);
        $signature = file_get_contents($signaturePath);

        $publicKey = file_get_contents('../public.pem');
        if ($publicKey === false) {
            die("Errore nel caricare la chiave pubblica.");
        }

        if (openssl_pkey_get_public($publicKey)) {
            $isValid = openssl_verify($fileHash, base64_decode($signature), $publicKey, OPENSSL_ALGO_SHA256);
            if ($isValid == 1) {
                echo "La firma è valida!";
            } elseif ($isValid == 0) {
                echo "La firma non è valida!";
            } else {
                echo "Errore nella verifica della firma.";
            }
        } else {
            echo "Errore nella lettura della chiave pubblica.";
        }
    } else {
        echo "File o firma non trovati.";
    }
} else {
    echo "Nessun file specificato.";
}
?>
