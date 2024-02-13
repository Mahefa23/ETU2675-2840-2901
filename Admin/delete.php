//gestion de la suppression
<?php
    if(isset($_POST['supprimer_variete'])){
        $id_variete = $_POST['id_variete_supprime'];

        // Utilisez des requêtes SQL sécurisées pour supprimer la variété de la base de données
        $sql = "DELETE FROM varietes_the WHERE id_variete=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_variete);
        $stmt->execute();

        // Redirigez après la suppression
        header("Location: gestion_varietes.php");
        exit();
    }
?>