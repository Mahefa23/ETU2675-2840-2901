<?php
function ajouterVariete($conn, $nom_variete, $occupation_m2, $rendement_kg_mois) {
    $sql = "INSERT INTO Varietes_The (Nom_Variete, Occupation_Pied, Rendement_Pied_Mois) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdd", $nom_variete, $occupation_m2, $rendement_kg_mois);
    $stmt->execute();

    header("Location: gestion_varietes.php");
    exit();
}

function modifierVariete($conn, $id_variete, $nom_variete, $occupation_m2, $rendement_kg_mois) {
    $sql = "UPDATE Varietes_The SET Nom_Variete=?, Occupation_Pied=?, Rendement_Pied_Mois=? WHERE ID_Variete=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sddi", $nom_variete, $occupation_m2, $rendement_kg_mois, $id_variete);
    $stmt->execute();

    header("Location: gestion_varietes.php");
    exit();
}

function supprimerVariete($conn, $id_variete) {
    $sql = "DELETE FROM Varietes_The WHERE ID_Variete=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_variete);
    $stmt->execute();

    header("Location: gestion_varietes.php");
    exit();
}
?>