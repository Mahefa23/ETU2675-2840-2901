<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../config.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajouter_parcelle'])) {
            // Récupérer les données du formulaire
            $numero_parcelle = $_POST['numero_parcelle'];
            $surface_hectare = $_POST['surface_hectare'];
            $id_variete = $_POST['id_variete'];

            // Utiliser des requêtes SQL sécurisées pour ajouter la parcelle dans la base de données
            $sql = "INSERT INTO Parcelles (Numero_Parcelle, Surface_Hectare, ID_Variete) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdi", $numero_parcelle, $surface_hectare, $id_variete);
            $stmt->execute();

            // Rediriger après l'ajout
            header("Location: gestion_parcelles.php");
            exit();
        }

            break;
                case 'modifier_parcelle':
                    // Récupérez les données du formulaire
                    // Récupérez les données du formulaire
                $numero_parcelle = $_POST['numero_parcelle_modifie'];
                $surface_hectare = $_POST['surface_hectare_modifie'];
                $id_variete = $_POST['id_variete_modifie'];

                // modifier la parcelle dans la base de données
                $sql = "UPDATE Parcelles SET Numero_Parcelle=?, Surface_Hectare=?, ID_Variete=? WHERE ID_Parcelle=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sddi", $numero_parcelle, $surface_hectare, $id_variete, $id_parcelle);
                $stmt->execute();
    
                    // Redirigez après la modification
                    header("Location: gestion_parcelles.php");
                    exit();
                    break;

                    case 'supprimer_parcelle':
                        // Utilisez des requêtes SQL sécurisées pour supprimer la parcelle de la base de données
                        $sql = "DELETE FROM Parcelles WHERE ID_Parcelle=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $id_parcelle);
                        $stmt->execute();
        
                        // Redirigez après la suppression
                        header("Location: gestion_parcelles.php");
                        exit();
                        break;
        }
    }
?>
