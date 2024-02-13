<?php
include '../config.php';
include '../Fonctions/fonction_gestion_cueilleurs.php';

$result = $conn->query("SELECT * FROM Cueilleurs");

// Vérifiez si la requête a réussi
if ($result === false) {
    die("Erreur lors de la récupération des variétés : " . $conn->error);
}
// Récupérez les variétés sous forme de tableau associatif
$cueilleurs = $result->fetch_all(MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Cueilleurs</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Gestion Cueilleurs</h1>

    <!-- Formulaire pour ajouter un cueilleur -->
    <form action="traitement_gestion_cueilleur.php" method="post">
        <label for="nom_cueilleur">Nom Cueilleur:</label>
        <input type="text" id="nom_cueilleur" name="nom_cueilleur" required>
        <label for="genre_cueilleur">Genre Cueilleur:</label>
        <select id="genre_cueilleur" name="genre_cueilleur" required>
            <option value="M">Masculin</option>
            <option value="F">Féminin</option>
        </select>
        <label for="date_naissance_cueilleur">Date Naissance Cueilleur:</label>
        <input type="date" id="date_naissance_cueilleur" name="date_naissance_cueilleur" required>
        <button type="submit" name="ajouter_cueilleur">Ajouter Cueilleur</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Nom Cueilleur</th>
                <th>Genre Cueilleur</th>
                <th>Date Naissance Cueilleur</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cueilleurs as $cueilleur): ?>
                <tr>
                    <td><?= $cueilleur['Nom_Cueilleur'] ?? '' ?></td>
                    <td><?= $cueilleur['Genre'] ?? '' ?></td>
                    <td><?= $cueilleur['Date_Naissance'] ?? '' ?></td>
                    <td>
                    <form action="traitement_gestion_cueilleur.php" method="post" style="display: inline;">
                        <input type="hidden" name="id_cueilleur" value="<?= $cueilleur['ID_Cueilleur'] ?>">
                        <input type="text" name="nom_cueilleur_modifie" placeholder="Nouveau nom">
                        <select name="genre_cueilleur_modifie" required>
                            <option value="M">Masculin</option>
                            <option value="F">Féminin</option>
                        </select>
                        <input type="date" name="date_naissance_cueilleur_modifie" placeholder="Nouvelle date de naissance">
                        <button type="submit" name="action" value="modifier_cueilleur">Modifier</button>
                    </form>
                    <form action="traitement_gestion_cueilleur.php" method="post" style="display: inline;">
                        <input type="hidden" name="id_cueilleur" value="<?= $cueilleur['ID_Cueilleur'] ?>">
                        <button type="submit" name="action" value="supprimer_cueilleur">Supprimer</button>
                    </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>