<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../config.php';
include '../Fonctions/fonction_gestion_categorie.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ajouter_categorie'])) {
        $nom_categorie = $_POST['nom_categorie'];
        // Appeler la fonction pour ajouter une catégorie de dépenses
        ajouterCategorieDepense($conn, $nom_categorie);
    } elseif (isset($_POST['action'])) {
        $id_categorie = $_POST['id_categorie'];

        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'modifier_categorie':
                    // Récupérer les données du formulaire
                    $nouveau_nom_categorie = $_POST['nom_categorie_modifie'];
                    // Appeler la fonction pour modifier la catégorie de dépenses
                    modifierCategorieDepense($conn, $id_categorie, $nouveau_nom_categorie);
                    break;

                case 'supprimer_categorie':
                    // Appeler la fonction pour supprimer la catégorie de dépenses
                    supprimerCategorieDepense($conn, $id_categorie);
                    break;
            }
        }
    }
}
?>
