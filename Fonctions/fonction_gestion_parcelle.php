<?php

function ajouterParcelle($conn, $numero_parcelle, $surface_hectare, $id_variete) {
    $sql = "INSERT INTO Parcelles (Numero_Parcelle, Surface_Hectare, ID_Variete) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdi", $numero_parcelle, $surface_hectare, $id_variete);
    $stmt->execute();
    
    header("Location: gestion_parcelles.php");
    exit();
}

function modifierParcelle($conn, $id_parcelle, $numero_parcelle, $surface_hectare, $id_variete) {
    $sql = "UPDATE Parcelles SET Numero_Parcelle=?, Surface_Hectare=?, ID_Variete=? WHERE ID_Parcelle=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdi", $numero_parcelle, $surface_hectare, $id_variete, $id_parcelle);
    $stmt->execute();
    
    header("Location: gestion_parcelles.php");
    exit();
}

function supprimerParcelle($conn, $id_parcelle) {
    $sql = "DELETE FROM Parcelles WHERE ID_Parcelle=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_parcelle);
    $stmt->execute();
    
    header("Location: gestion_parcelles.php");
    exit();
}
?>