<?php
include '../config.php';

function ajouterCategorieDepense($conn, $nomCategorie) {
    $sql = "INSERT INTO Categories_Depenses (Nom_Categorie) VALUES (?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    $stmt->bind_param("s", $nomCategorie);
    $result = $stmt->execute();

    if ($result === false) {
        die("Erreur lors de l'exécution de la requête : " . $stmt->error);
    }

    // Rediriger après l'ajout
    header("Location: gestion_categorie_depense.php");
    exit();
}

function modifierCategorieDepense($conn,$idCategorie, $nouveauNomCategorie)
{
    $sql = "UPDATE Categories_Depenses SET Nom_Categorie=? WHERE ID_Categorie=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nouveauNomCategorie, $idCategorie);
    $stmt->execute();

    // Redirigez après la modification
    header("Location: gestion_categorie_depense.php");
    exit();
}

function supprimerCategorieDepense($conn,$idCategorie)
{
    global $conn;

    $sql = "DELETE FROM Categories_Depenses WHERE ID_Categorie=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idCategorie);
    $stmt->execute();

    // Redirigez après la suppression
    header("Location: gestion_categorie_depense.php");
    exit();
}
?>