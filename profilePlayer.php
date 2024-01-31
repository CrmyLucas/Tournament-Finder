<h1>test</h1>

<?php
// Vérifiez si l'ID a été passé dans l'URL
if (isset($_GET['UserId'])) {
    $playerId = $_GET['UserId'];

    // INSERT NEW MESSAGE
    if (isset($_POST['SendMsg'])) {
        var_dump($_POST);
        try {
            //! doit etre dans le meme ordre que le '->execute' sinon ca inverse
            $sql = "INSERT INTO message SET IdPlayerSend = ?, IdPlayerReceive = ?, Description = ?;";
            $stmt = $bdd->prepare($sql);
            // On recupere le UserId pour changer le nom avec POST <!> NOM DES COLONNES <!>
            $stmt->execute(array(strip_tags($_POST['IdPlayerSend']), strip_tags($_POST['IdPlayerReceive']), strip_tags($_POST['Description'])));
        } catch (Exception $e) {
            print "Erreur ! " . $e->getMessage() . "<br/>";
        }
    }
    // FIN INSERT NEW MESSAGE

    //  UPDATE PLAYER INFO
    if (isset($_POST['update'])) {
        print_r($_POST);
        try {
            //! doit etre dans le meme ordre que le '->execute' sinon ca inverse
            $sql = "UPDATE user SET Name = ?, Color = ? WHERE UserId = ?;";
            $stmt = $bdd->prepare($sql);
            // On recupere le UserId pour changer le nom avec POST <!> NOM DES COLONNES <!>
            $stmt->execute(array(strip_tags($_POST['Name']), strip_tags($_POST['Color']), strip_tags($_GET['UserId'])));
        } catch (Exception $e) {
            print "Erreur ! " . $e->getMessage() . "<br/>";
        }
    }
    // FIN UPDATE PLAYER INFO

    // Select MESSAGE Recu

    try {
        $sql = "SELECT * FROM message WHERE IdPlayerReceive = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $playerId, PDO::PARAM_INT);
        $stmt->execute();
        $MessageReceive = $stmt->fetchAll(PDO::FETCH_ASSOC);



        // Vérifiez si des résultats ont été trouvés
        if ($MessageReceive) {
            // Affichez les détails du joueur
            // var_dump($playerDetails);
?>
            <h4>Message recu</h4>
            <?php
            foreach ($MessageReceive as $MyMessageReceive) {
            ?>
                <div style="background-color: #32928E;">
                    <p><?= $MyMessageReceive['IdPlayerSend'] ?>
                    <p>
                    <p><?= $MyMessageReceive['DateCreate'] ?>
                    <p>
                    <p><?= $MyMessageReceive['Description'] ?></p>

                </div>
            <?php } ?>
        <?php


        } else {
            echo "Aucun message recu.";
        }
    } catch (Exception $e) {
        echo "Erreur ! " . $e->getMessage();
    }


    // Fin Select MESSAGE Recu

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
            <img src=" uploads/<?= $playerDetails['PictureUser'] ?>" alt="">
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


<!-- Modifier profil -->
<h2>Modifier Mon Profil</h2>
<form method="POST">
    <input type="text" value="<?= $playerDetails['Name'] ?>" name="Name" placeholder="Name">
    <input type="color" name="Color">
    <input type="submit" name="update">
</form>
<!-- Fin modifier profil -->

<?= date("d/m/Y H:i:s") ?>

<!-- Envoyer un message -->
<h2>Envoyer un message</h2>
<form method="POST">
    <input type="text" name="IdPlayerReceive" placeholder="a qui">
    <textarea name="Description" placeholder="ton message"></textarea>
    <!-- HIDDEN -->
    <input type="text" name="IdPlayerSend" value="<?= $playerDetails['UserId'] ?>">
    <!-- Fin HIDDEN -->
    <input type="submit" name="SendMsg" value="SendMsg">
</form>
<!-- Fin envoyer un message -->

<?php
// Select MESSAGE Recu

try {
    $sql = "SELECT * FROM message WHERE IdPlayerSend = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $playerId, PDO::PARAM_INT);
    $stmt->execute();
    $MessageSend = $stmt->fetchAll(PDO::FETCH_ASSOC);



    // Vérifiez si des résultats ont été trouvés
    if ($MessageSend) {
        // Affichez les détails du joueur
        // var_dump($playerDetails);
?>
        <h4>Mes Message Envoyee</h4>
        <?php
        foreach ($MessageSend as $MyMessageSend) {
        ?>
            <div style="background-color: #8B7AAE;">
                <p><?= $MyMessageSend['IdPlayerReceive'] ?>
                <p>
                <p><?= $MyMessageSend['DateCreate'] ?>
                <p>
                <p><?= $MyMessageSend['Description'] ?></p>

            </div>
        <?php } ?>
<?php


    } else {
        echo "Aucun message recu.";
    }
} catch (Exception $e) {
    echo "Erreur ! " . $e->getMessage();
}

// Fin Select MESSAGE Recu
?>