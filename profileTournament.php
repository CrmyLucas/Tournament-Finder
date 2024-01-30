<!-- Categories -->
<?php
?>
<!-- fin categories -->


<?php
// Vérifiez si l'ID a été passé dans l'URL
if (isset($_GET['IdTournament'])) {
    $tourID = $_GET['IdTournament'];

    // Effectuez une requête SQL pour obtenir les informations en fonction de l'ID
    try {
        $sql = "SELECT * FROM tournament WHERE IdTournament = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $tourID, PDO::PARAM_INT);
        $stmt->execute();
        $TournamentInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        // -----------------
        try {
            $sql = "SELECT * FROM game";
            $stmt = $bdd->prepare($sql);
            $stmt->execute(array());
        } catch (Exception $e) {
            print "Erreur ! " . $e->getMessage() . "<br/>";
        }
        while ($gameResults = $stmt->fetch(PDO::FETCH_ASSOC)) {
            print_r($gameResults);
            $arrayGameResults[$gameResults['IdGame']] = $gameResults['GameName'];
        }

        // ------------------


        // Vérifiez si des résultats ont été trouvés
        if ($TournamentInfo) {
            // Affichez les détails
            // var_dump($TournamentInfo);
?>
            <h2><?= $TournamentInfo['NameTournament'] ?></h2>
            <h3><?= $TournamentInfo['IdGame'] ?></h3>
            <h4><?= $TournamentInfo['IdGame'] == $gameResults['IdGame'] ? 'afficher jeu' : 'rien afficher' ?></h4>

            <p><?= $arrayGameResults[$TournamentInfo['IdGame']] ?></p>
            <p><?= $TournamentInfo['IdGame'] ?></p>
            
            <?php


            if ($TournamentInfo['IdGame'] == $gameResults['IdGame']) {
                echo $gameResults['GameName'];
            } else {
                echo 'rien afficher';
            }
            ?>

<?php


        } else {
            echo "Aucun joueur trouvé avec cet ID.";
        }
    } catch (Exception $e) {
        echo "Erreur ! " . $e->getMessage();
    }
} else {
    echo "Aucun ID de joueur fourni.";
}
?>