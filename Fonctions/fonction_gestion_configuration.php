<?php
include '../config.php';

function getMontantSalaire($conn) {
    $result = $conn->query("SELECT Montant_Salaire FROM ConfigurationSalaire ORDER BY ID_Configuration DESC LIMIT 1");

    if ($result === false) {
        die("Erreur lors de la récupération du montant du salaire : " . $conn->error);
    }

    $row = $result->fetch_assoc();

    return $row['Montant_Salaire'];
}

function updateMontantSalaire($conn, $nouveauMontant) {
    $sql = "INSERT INTO ConfigurationSalaire (Montant_Salaire) VALUES (?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    $stmt->bind_param("d", $nouveauMontant);
    $result = $stmt->execute();

    if ($result === false) {
        die("Erreur lors de l'exécution de la requête : " . $stmt->error);
    }

    return true;
}
?>