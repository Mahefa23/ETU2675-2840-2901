<?php
session_start();

if (!isset($_SESSION['users']) || !$_SESSION['users']) {
    header("Location: login_users.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backoffice</title>
</head>
<body>
    <h1>Frontoffice</h1>
    <a href="saisie_cueillette.php">Saisie des cueillettes</a><br>
    <a href="saisie_depense.php">Saisie des dépenses</a><br>
    <a href="resultat.php">Résultat</a><br>

</body>
</html>
