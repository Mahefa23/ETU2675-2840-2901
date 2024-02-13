
<?php
function traiterFormulaireCueillette($dateCueillette, $cueilleur, $parcelle, $poidsCueilli) {
    include '../config.php'; 

    $sql = "SELECT Poids_Restant FROM Parcelles WHERE ID_Parcelle = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $parcelle);
    $stmt->execute();
    $stmt->bind_result($poidsRestant);
    $stmt->fetch();
    $stmt->close();

    if ($poidsCueilli > $poidsRestant) {
        echo "Erreur : Le poids cueilli est supérieur au poids restant sur la parcelle.";
        return;
    }

    // Insérer les données dans la table Cueillettes
    $sqlInsert = "INSERT INTO Cueillettes (Date_Cueillette, Poids_Cueilli, ID_Cueilleur, ID_Parcelle) VALUES (?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("sddi", $dateCueillette, $poidsCueilli, $cueilleur, $parcelle);
    $stmtInsert->execute();
    $stmtInsert->close();

    // Mettre à jour le poids restant sur la parcelle
    $nouveauPoidsRestant = $poidsRestant - $poidsCueilli;
    $sqlUpdate = "UPDATE Parcelles SET Poids_Restant = ? WHERE ID_Parcelle = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("di", $nouveauPoidsRestant, $parcelle);
    $stmtUpdate->execute();
    $stmtUpdate->close();

    // Rediriger après le traitement
    header("Location: accueil_utilisateur.php");
    exit();
}

?>
