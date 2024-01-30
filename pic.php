<?php


//se connecter a la base de données
try {
    $bdd = new PDO("mysql:host=localhost;dbname=testsite", "root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die($erreur_sql = 'Erreur connect bd: ' . $e->getMessage());
}
//fin connection a la base de données

if (isset($_ErreurSql)) {
    echo $Erreur_sql;
}


//If pour le update
if (isset($_POST['update'])) {
    var_dump($_POST['update']);
    //Image test
    if (isset($_FILES['PictureUser']) && $_FILES['PictureUser']['error'] == 0) {
        $uploadImgok = 0;
        if ($_FILES['PictureUser']['size'] <= 1000000) {

            $fileInfo = pathinfo($_FILES['PictureUser']['name']);
            $extension = $fileInfo['extension'];
            $extensionAllowed = ['jpg', 'jpeg', 'JPG', 'gif', 'png', 'PNG'];
            $uploadImgok = 1;

            if (in_array($extension, $extensionAllowed)) {
                move_uploaded_file(str_replace(" ", "-", $_FILES['PictureUser']['tmp_name']), 'uploads/' . str_replace(" ", "-", $_FILES['PictureUser']['name']));
                $uploadImgok = 1;

                try {
                    //! doit etre dans le meme ordre que le '->execute'
                    $sql = "UPDATE user SET Name = ?, PictureUser = ? WHERE UserId = 10 ;";
                    $stmt = $bdd->prepare($sql);
                    // On recupere le UserId pour changer le nom avec POST <!> NOM DES COLONNES <!>
                    $stmt->execute(array($_FILES['PictureUser']['name']));
                } catch (Exception $e) {
                    print "Erreur ! " . $e->getMessage() . "<br/>";
                }
            }
        }
        if ($uploadImgok) {
            echo "L'image à ete envoyer";
        } else {
            var_dump($_POST);
            echo "L'image n'a pas pu être envoyer";
        }
    }
}


//requete Select
try {
    //rajouter where apres user pour chercher l'id d'un user en particulier (userId = 1)
    $sql = "SELECT * FROM user WHERE UserId = 10 ;";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
} catch (Exception $e) {
    print "Erreur ! " . $e->getMessage() . "<br/>";
}
$results = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!-- fIN requete select -->

<form method="post" enctype="multipart/form-data">
    <input type="file" name="PictureUser">
    <input type="submit" value="Envoyer" name="update">
</form>