<?php
// gestion_varietes_handler.php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['ajouter_variete'])){
        $nom_variete = $_POST['nom_variete'];
        $occupation_m2 = $_POST['occupation_m2'];
        $rendement_kg_mois = $_POST['rendement_kg_mois'];

        // Utilisez des requêtes SQL sécurisées pour ajouter la variété dans la base de données
        $sql = "INSERT INTO varietes_the (Nom_variete, occupation_Pied, Rendement_Pied_mois) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdd", $nom_variete, $occupation_m2, $rendement_kg_mois);
        $stmt->execute();

        // Redirigez après l'ajout
        header("Location: gestion_varietes.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['action'])) {
            $id_variete = $_POST['id_variete'];
    
            switch ($_POST['action']) {    
                case 'modifier_variete':
                    $nom_variete = $_POST['nom_variete_modifie'];
                    $occupation_m2 = $_POST['occupation_m2_modifie'];
                    $rendement_kg_mois = $_POST['rendement_kg_mois_modifie'];
    
                    // Utilisez des requêtes SQL sécurisées pour modifier la variété dans la base de données
                    $sql = "UPDATE Varietes_The SET Nom_Variete=?, Occupation_Pied=?, Rendement_Pied_Mois=? WHERE ID_Variete=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sddi", $nom_variete, $occupation_m2, $rendement_kg_mois, $id_variete);
                    $stmt->execute();
    
                    // Redirigez après la modification
                    header("Location: gestion_varietes.php");
                    exit();
                    break;
                }
        }
    }
    //gestion de la suppression
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['action'])) {
            $id_variete = $_POST['id_variete'];
    
            switch ($_POST['action']) {
                case 'supprimer_variete':
                    // Utilisez des requêtes SQL sécurisées pour supprimer la variété de la base de données
                    $sql = "DELETE FROM Varietes_The WHERE ID_Variete = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id_variete);
                    $stmt->execute();
    
                    // Redirigez après la suppression
                    header("Location: gestion_varietes.php");
                    exit();
                    break;
                }
        }
    }
}
?>
