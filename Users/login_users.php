<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

        include '../config.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['Username'];
            $password = $_POST['Password'];
            $password = sha1($password);

            // Vérifier les informations de connexion dans la base de données
            $query = "SELECT * FROM Users WHERE Username = '$username' AND MDP = '$password'";
            $result = $conn->query($query);

            session_start();
    $_SESSION['users'] = true;

    header("Location: frontOffice.php");
    exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Login Admin</h1>
    <form action="login_users.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" autocomplete="off" value="Kami" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
