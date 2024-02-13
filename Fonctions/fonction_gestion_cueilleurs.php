<?php
function ajouterCueilleur($conn, $nom, $genre, $date_naissance) {
    $sql = "INSERT INTO Cueilleurs (Nom_Cueilleur, Genre, Date_Naissance) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nom, $genre, $date_naissance);
    $stmt->execute();

    header("Location: gestion_cueilleur.php");
    exit();
}

function modifierCueilleur($conn, $id_cueilleur, $nom, $genre, $date_naissance) {
    $sql = "UPDATE Cueilleurs SET Nom_Cueilleur=?, Genre=?, Date_Naissance=? WHERE ID_Cueilleur=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nom, $genre, $date_naissance, $id_cueilleur);
    $stmt->execute();

    header("Location: gestion_cueilleur.php");
    exit();
}

function supprimerCueilleur($conn, $id_cueilleur) {
    $sql = "DELETE FROM Cueilleurs WHERE ID_Cueilleur=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_cueilleur);
    $stmt->execute();

    header("Location: gestion_cueilleur.php");
    exit();
}
?>