<?php
include '../config.php';
include '../Fonctions/fonction_gestion_configuration.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration Salaire</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Configuration Salaire</h1>

    <?php
    $montantSalaire = getMontantSalaire($conn);
    $nouveauMontant = 10.00; // mettez à jour avec la valeur souhaitée
    updateMontantSalaire($conn, $nouveauMontant);

    echo "Le montant du salaire a été mis à jour avec succès.";
    ?>
    <p>Le montant actuel du salaire par kilogramme est : <?= $montantSalaire ?></p>
    
</body>
</html>