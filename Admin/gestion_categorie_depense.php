<?php
include '../config.php';
include '../Fonctions/fonction_gestion_categorie.php';

$result = $conn->query("SELECT * FROM Categories_Depenses");

// Vérifiez si la requête a réussi
if ($result === false) {
    die("Erreur lors de la récupération des catégories : " . $conn->error);
}
// Récupérez les catégories sous forme de tableau associatif
$categories = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Catégories</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Gestion Catégories</h1>

    <!-- Formulaire pour ajouter une catégorie -->
    <form action="traitement_gestion_categorie.php" method="post">
        <label for="nom_categorie">Nom Catégorie:</label>
        <input type="text" id="nom_categorie" name="nom_categorie" required>
        <button type="submit" name="ajouter_categorie">Ajouter Catégorie</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Nom Catégorie</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $categorie): ?>
                <tr>
                    <td><?= $categorie['Nom_Categorie'] ?? '' ?></td>
                    <td>
                    <form action="traitement_gestion_categorie.php" method="post" style="display: inline;">
                        <input type="hidden" name="id_categorie" value="<?= $categorie['ID_Categorie'] ?>">
                        <input type="text" name="nom_categorie_modifie" placeholder="Nouveau nom">
                        <button type="submit" name="action" value="modifier_categorie">Modifier</button>
                    </form>
                    <form action="traitement_gestion_categorie.php" method="post" style="display: inline;">
                        <input type="hidden" name="id_categorie" value="<?= $categorie['ID_Categorie'] ?>">
                        <button type="submit" name="action" value="supprimer_categorie">Supprimer</button>
                    </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>