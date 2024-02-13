<?php
include '../config.php';
include '../Fonctions/fonction_gestion_parcelle.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $id_parcelle = $_POST['id_parcelle'];

    switch ($_POST['action']) {
        case 'ajouter_parcelle':
            ajouterParcelle($conn, $_POST['numero_parcelle'], $_POST['surface_hectare'], $_POST['id_variete']);
            break;

        case 'modifier_parcelle':
            modifierParcelle($conn, $id_parcelle, $_POST['numero_parcelle_modifie'], $_POST['surface_hectare_modifie'], $_POST['id_variete_modifie']);
            break;

        case 'supprimer_parcelle':
            supprimerParcelle($conn, $id_parcelle);
            break;
    }
}
?>