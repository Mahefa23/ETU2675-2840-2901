<?php
// Inclure le fichier de configuration de la base de données
include '../config.php';

// Vérifier la méthode de la requête
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $dateCueillette = $_POST['dateCueillette'];
    $cueilleur = $_POST['cueilleur'];
    $parcelle = $_POST['parcelle'];
    $poidsCueilli = $_POST['poidsCueilli'];

    // Validation AJAX pour le poids cueilli
    $queryPoidsRestant = "SELECT PoidsRestant FROM Parcelles WHERE ID_Parcelle = '$parcelle'";
    $resultPoidsRestant = $conn->query($queryPoidsRestant);

    if ($resultPoidsRestant->num_rows > 0) {
        $rowPoidsRestant = $resultPoidsRestant->fetch_assoc();
        $poidsRestant = $rowPoidsRestant['PoidsRestant'];

        if ($poidsCueilli > $poidsRestant) {
            echo "Le poids cueilli est supérieur au poids restant sur la parcelle.";
            exit();
        }
    }
    $queryInsertCueillette = "INSERT INTO Cueillettes (Date_Cueillette, ID_Cueilleur, ID_Parcelle, Poids_Cueilli)
                              VALUES ('$dateCueillette', '$cueilleur', '$parcelle', '$poidsCueilli')";

    if ($conn->query($queryInsertCueillette) === TRUE) {
        echo "Cueillette enregistrée avec succès!";
    } else {
        echo "Erreur lors de l'enregistrement de la cueillette: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisie des Cueillettes</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Saisie des Cueillettes</h1>

    <form id="saisieCueilletteForm" action="saisie_cueillette.php" method="post">
        <label for="dateCueillette">Date :</label>
        <input type="date" id="dateCueillette" name="dateCueillette" required>

        <label for="cueilleur">Cueilleur :</label>
        <select id="cueilleur" name="cueilleur" required>
            <?php
            // Récupérer les cueilleurs depuis la base de données
            $sqlCueilleurs = "SELECT ID_Cueilleur, Nom_Cueilleur FROM Cueilleurs";
            $resultCueilleurs = $conn->query($sqlCueilleurs);

            // Remplir les options de la liste déroulante "Cueilleur"
            while ($rowCueilleur = $resultCueilleurs->fetch_assoc()) {
                echo "<option value='{$rowCueilleur['ID_Cueilleur']}'>{$rowCueilleur['Nom_Cueilleur']}</option>";
            }
            ?>
        </select>

        <label for="parcelle">Parcelle :</label>
        <select id="parcelle" name="parcelle" required>
            <?php
            // Récupérer les parcelles depuis la base de données
            $sqlParcelles = "SELECT ID_Parcelle, Numero_Parcelle FROM Parcelles";
            $resultParcelles = $conn->query($sqlParcelles);

            // Remplir les options de la liste déroulante "Parcelle"
            while ($rowParcelle = $resultParcelles->fetch_assoc()) {
                echo "<option value='{$rowParcelle['ID_Parcelle']}'>{$rowParcelle['Numero_Parcelle']}</option>";
            }
            ?>
        </select>

        <label for="poidsCueilli">Poids cueilli (kg) :</label>
        <input type="number" id="poidsCueilli" name="poidsCueilli" step="0.01" required>
        <span id="messageErreur"></span>

        <!-- AJAX pour la validation du poids cueilli -->
        <script>
            $(document).ready(function () {
                $('#poidsCueilli').on('input', function () {
                    var poidsCueilli = parseFloat($(this).val());
                    var parcelle = $('#parcelle').val();

                    // Simulation d'une requête AJAX pour obtenir le poids restant sur la parcelle
                    $.ajax({
                        url: 'obtenir_poids_restant.php', // Remplacez ceci par le vrai chemin
                        type: 'POST',
                        data: { parcelle: parcelle },
                        success: function (response) {
                            var poidsRestant = parseFloat(response);

                            if (poidsCueilli > poidsRestant) {
                                $('#messageErreur').text('Le poids cueilli est supérieur au poids restant sur la parcelle.');
                                $('#saisieCueilletteForm button[type="submit"]').prop('disabled', true);
                            } else {
                                $('#messageErreur').text('');
                                $('#saisieCueilletteForm button[type="submit"]').prop('disabled', false);
                            }
                        },
                        error: function () {
                            console.log('Erreur lors de la récupération du poids restant sur la parcelle.');
                        }
                    });
                });
            });
        </script>

        <button type="submit">Valider Cueillette</button>
    </form>
</body>
</html>
