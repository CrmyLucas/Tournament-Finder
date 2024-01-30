<h1>test</h1>

<?php
// Vérifiez si l'ID a été passé dans l'URL
if (isset($_GET['UserId'])) {
    $playerId = $_GET['UserId'];

    if (isset($_POST['update'])) {
        print_r($_POST);
        try {
            //! doit etre dans le meme ordre que le '->execute' sinon ca inverse
            $sql = "UPDATE user SET Name = ?, PictureUser = ?, Color = ? WHERE UserId = ?;";
            $stmt = $bdd->prepare($sql);
            // On recupere le UserId pour changer le nom avec POST <!> NOM DES COLONNES <!>
            $stmt->execute(array(strip_tags($_POST['Name']), strip_tags($_POST['PictureUser']), strip_tags($_POST['Color']), strip_tags($_GET['UserId'])));
        } catch (Exception $e) {
            print "Erreur ! " . $e->getMessage() . "<br/>";
        }
    }
    // Effectuez une requête SQL pour obtenir les informations du joueur en fonction de l'ID
    try {
        $sql = "SELECT * FROM user WHERE UserId = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $playerId, PDO::PARAM_INT);
        $stmt->execute();
        $playerDetails = $stmt->fetch(PDO::FETCH_ASSOC);



        // Vérifiez si des résultats ont été trouvés
        if ($playerDetails) {
            // Affichez les détails du joueur
            // var_dump($playerDetails);
?>
            <h2 style="box-shadow: 10px 10px 15px <?= $playerDetails['Color'] ?>;"><?= $playerDetails['Name'] ?></h2>
            <p><?= $playerDetails['Mail'] ?></p>
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


<form method="POST">
    <input type="text" value="<?= $playerDetails['Name'] ?>" name="Name" placeholder="Name">
    <input type="file" name="PictureUser">
    <input type="color" name="Color">
    <input type="submit" name="update">
</form>