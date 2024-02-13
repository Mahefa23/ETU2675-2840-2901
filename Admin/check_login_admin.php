<!-- <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

        include '../config.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['Username'];
            $password = $_POST['Password'];

            // Vérifier les informations de connexion dans la base de données
            $query = "SELECT * FROM Admins WHERE Username = '$username' AND MDP = '$password'";
            $result = $conn->query($query);

            if ($result->num_rows == 1) {
                session_start();
                $_SESSION['admin'] = true;
                header("Location: backoffice.php");
                exit();
            } 
        }
?> -->
