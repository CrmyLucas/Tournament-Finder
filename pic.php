<?php


    //se connecter a la base de données
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=testsite", "root", "");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die($erreur_sql = 'Erreur connect bd: ' . $e->getMessage());
    }
    if (isset($_ErreurSql)) {
        echo $Erreur_sql;
    }
    //fin connection a la base de données

        
        //If pour le update
        if (isset($_POST['update'])&& $_FILES['avatar']['error'] == 0) {
                //Image test
        $uploadImgok = 1;
        if ($_FILES['avatar']['size'] <= 1000000) {
        $fileInfo = pathinfo($_FILES['avatar']['name']);
        $extension = $fileInfo['extension'];
        $extensionAllowed = ['jpg', 'jpeg', 'gif', 'png'];
        $uploadImgok = 0;
        
        if (in_array($extension, $extensionAllowed)) {
            move_uploaded_file(str_replace(" ", "-", $_FILES['avatar']['tmp_name']), 'uploads/' . str_replace(" ", "-", $_FILES['avatar']['name']));
            $uploadImgok = 0;

            try {
                //! doit etre dans le meme ordre que le '->execute' sinon ca inverse
                $sql = "UPDATE user SET PictureUser = ? WHERE UserId = 13;";
                $stmt = $bdd->prepare($sql);
                // On recupere le UserId pour changer le nom avec POST <!> NOM DES COLONNES <!>
                $stmt->execute(array(strip_tags( $_FILES['PictureUser']),strip_tags($_GET['UserId'])));
            } catch (Exception $e) {
                print "Erreur ! " . $e->getMessage() . "<br/>";
            }
        }

        }
    }
    if ($uploadImgok) {
        echo "L'image à pas être envoyer";
    } else {
        var_dump($_POST);
        echo "L'image n'a pas pu être envoyer";
    }


//requete Select
try {
    //rajouter where apres user pour chercher l'id d'un user en particulier (userId = 1)
    $sql = "SELECT * FROM user ";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
} catch (Exception $e) {
    print "Erreur ! " . $e->getMessage() . "<br/>";
}
$results = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="PictureUser">
        <input type="submit" value="Envoyer" name="update">
    </form>
    