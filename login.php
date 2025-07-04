<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

$cf = $_POST['codiceFiscale'] ?? '';
$pwd = $_POST['password'] ?? '';

if ($cf && $pwd) {
    $conn = new mysqli("localhost", "root", "", "scuolaguida");

    if ($conn->connect_error) {
        echo json_encode(["status" => "errore_connessione"]);
        exit;
    }

    // Verifica come insegnante
    $stmt = $conn->prepare("SELECT password FROM insegnante WHERE codiceFiscale = ?");
    $stmt->bind_param("s", $cf);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hash);
        $stmt->fetch();
        if (password_verify($pwd, $hash)) {
            $_SESSION['codiceFiscale'] = $cf;
            $_SESSION['ruolo'] = "insegnante";
            echo json_encode(["status" => "insegnante"]);
            exit;
        }
    }
    $stmt->close();

    echo json_encode(["status" => "errore"]);
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "dati_mancanti"]);
}
?>