<?php
include '../config.php';
include '../Fonctions/fonction_gestion_variete.php';
// Récupérez la liste des variétés depuis la base de données
$result = $conn->query("SELECT * FROM Varietes_The");

// Vérifiez si la requête a réussi
if ($result === false) {
    die("Erreur lors de la récupération des variétés : " . $conn->error);
}
// Récupérez les variétés sous forme de tableau associatif
$varietes = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Variétés</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Gestion Variétés</h1>

    <!-- Formulaire pour ajouter une variété -->
    <form action="traitement_gestion_variete.php" method="post">
        <label for="nom_variete">Nom Variété:</label>
        <input type="text" id="nom_variete" name="nom_variete" required>
        <label for="occupation_m2">Occupation (m2):</label>
        <input type="number" id="occupation_m2" name="occupation_m2" step="0.01" required>
        <label for="rendement_kg_mois">Rendement (kg/mois):</label>
        <input type="number" id="rendement_kg_mois" name="rendement_kg_mois" step="0.01" required>
        <button type="submit" name="ajouter_variete">Ajouter Variété</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Nom Variété</th>
                <th>Occupation (m2)</th>
                <th>Rendement (kg/mois)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($varietes as $variete): ?>
                <tr>
                    <td><?= $variete['Nom_Variete'] ?? '' ?></td>
                    <td><?= $variete['Occupation_Pied'] ?? '' ?></td>
                    <td><?= $variete['Rendement_Pied_Mois'] ?? '' ?></td>
                    <td>
                    <form action="traitement_gestion_variete.php" method="post" style="display: inline;">
                        <input type="hidden" name="id_variete" value="<?= $variete['ID_Variete'] ?>">
                        <input type="text" name="nom_variete_modifie" placeholder="Nouveau nom">
                        <input type="number" name="occupation_m2_modifie" step="0.01" placeholder="Nouvelle occupation (m2)">
                        <input type="number" name="rendement_kg_mois_modifie" step="0.01" placeholder="Nouveau rendement (kg/mois)">
                        <button type="submit" name="action" value="modifier_variete">Modifier</button>
                    </form>
                    <form action="traitement_gestion_variete.php" method="post" style="display: inline;">
                        <input type="hidden" name="id_variete" value="<?= $variete['ID_Variete'] ?>">
                        <button type="submit" name="action" value="supprimer_variete">Supprimer</button>
                    </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
