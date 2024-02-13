<?php
session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: login_admin.php");
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
    <h1>Backoffice</h1>
    <a href="gestion_varietes.php">Gestion Variétés</a><br>
    <a href="gestion_parcelles.php">Gestion Parcelles</a>
</body>
</html>
