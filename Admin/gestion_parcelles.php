<?php
include '../config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Récupération des données des parcelles
$result = $conn->query("SELECT * FROM Parcelles JOIN Varietes_The ON Parcelles.ID_Variete = Varietes_The.ID_Variete");

if ($result === false) {
    die("Erreur lors de la récupération des parcelles : " . $conn->error);
}

$parcelles = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Parcelles</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Gestion Parcelles</h1>

    <form action="traitement_gestion_parcelle.php" method="post">
        <label for="numero_parcelle">Numéro Parcelle:</label>
        <input type="text" id="numero_parcelle" name="numero_parcelle" required>
        <label for="surface_hectare">Surface (hectares):</label>
        <input type="number" id="surface_hectare" name="surface_hectare" step="0.01" required>
        <label for="id_variete">Variété de Thé:</label>
        <select id="id_variete" name="id_variete" required>
            <?php foreach ($parcelles as $p): ?>
                <option value="<?= $p['ID_Variete'] ?>"><?= $p['Nom_Variete'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="ajouter_parcelle">Ajouter Parcelle</button>
    </form>

    <!-- Affichez la liste des parcelles et les options CRUD -->
    <table>
        <thead>
            <tr>
                <th>Numéro Parcelle</th>
                <th>Surface (hectares)</th>
                <th>Variété de Thé</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($parcelles as $p): ?>
                <tr>
                    <td><?= $p['Numero_Parcelle'] ?? '' ?></td>
                    <td><?= $p['Surface_Hectare'] ?? '' ?></td>
                    <td><?= $p['Nom_Variete'] ?? '' ?></td>
                    <td>
                        <form action="traitement_gestion_parcelle.php" method="post" style="display: inline;">
                            <input type="hidden" name="id_parcelle" value="<?= $p['ID_Parcelle'] ?>">
                            <input type="text" name="numero_parcelle_modifie" placeholder="Nouveau numéro de parcelle">
                            <input type="number" name="surface_hectare_modifie" step="0.01" placeholder="Nouvelle surface (hectares)">
                            <select name="id_variete_modifie" required>
                                <?php foreach ($parcelles as $v): ?>
                                    <option value="<?= $v['ID_Variete'] ?>"><?= $v['Nom_Variete'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" name="action" value="modifier_parcelle">Modifier</button>
                        </form>
                        <form action="traitement_gestion_parcelle.php" method="post" style="display: inline;">
                            <input type="hidden" name="id_parcelle" value="<?= $p['ID_Parcelle'] ?>">
                            <button type="submit" name="action" value="supprimer_parcelle">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>