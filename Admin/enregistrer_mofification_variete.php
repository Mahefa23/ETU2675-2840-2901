<!-- enregistrer_modification_variete.php -->
<?php
include 'config.php';

//Connection de l'admin
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_variete = $_POST['id_variete'];
    $nom_variete = $_POST['nom_variete'];
    $occupation_pied = $_POST['occupation_pied'];
    $rendement_mois = $_POST['rendement_mois'];

    // Mettre à jour les informations de la variété dans la base de données
    $query = "UPDATE Varietes_The 
              SET Nom_Variete = '$nom_variete', Occupation_Pied = '$occupation_pied', Rendement_Pied_Mois = '$rendement_mois'
              WHERE ID_Variete = '$id_variete'";
    
    if ($conn->query($query) === TRUE) {
        header("Location: gestion_varietes.php");
        exit();
    } else {
        echo "Erreur lors de l'enregistrement des modifications: " . $conn->error;
    }
}
?>
