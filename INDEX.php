<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tournament Finder</title>

</head>
<body>
    <?php include('bdd.php');
    
      // requete SELECT 
      try {
        //rajouter where apres user pour chercher l'id d'un user en particulier (userId = 1)
        $sql = "SELECT UserId FROM user ;";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
    } catch (Exception $e) {
        print "Erreur ! " . $e->getMessage() . "<br/>";
    }

    $usersNb = $stmt->rowCount();
    echo 'il y a: ' . $usersNb . ' utilisateurs';

    echo'<br>';

    try {
        //rajouter where apres user pour chercher l'id d'un user en particulier (userId = 1)
        $sql = "SELECT IdPost FROM post ;";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
    } catch (Exception $e) {
        print "Erreur ! " . $e->getMessage() . "<br/>";
    }

    $postNb = $stmt->rowCount();
    echo 'il y a: ' . $postNb . ' Posts';

  
    ?>



    <h1> Tournament Finder </h1>

    <nav>
        <ul>
            <li><a href="INDEX.php">Home</a></li>
            <li><a href="INDEX.php?p=user.php">User</a></li>
            <li><a href="INDEX.php?p=tournament.php">Tournament</a></li>
        </ul>
    </nav>

</body>
</html>