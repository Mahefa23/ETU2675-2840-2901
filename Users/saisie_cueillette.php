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

    <form id="saisieCueilletteForm" action="traitement_saisie_cueillette.php" method="post">
        <label for="dateCueillette">Date :</label>
        <input type="date" id="dateCueillette" name="dateCueillette" required>

        <label for="cueilleur">Cueilleur :</label>
        <select id="cueilleur" name="cueilleur" required>
            <?php
                // récupérer les cueilleurs depuis la base de données
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
                // Requête SQL pour récupérer les parcelles depuis la base de données
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
