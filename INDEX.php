<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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

  

try {
        //rajouter where apres user pour chercher l'id d'un user en particulier (userId = 1)
        $sql = "SELECT * FROM user ;";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
    } catch (Exception $e) {print "Erreur ! " . $e->getMessage() . "<br/>";}
    ($results = $stmt->fetchAll(PDO::FETCH_ASSOC));

    ?>



    <h1> Tournament Finder </h1>

    <nav>
        <ul>
            <li><a href="INDEX.php">Home</a></li>
            <li><a href="INDEX.php?p=player.php">Player</a></li>
            <li><a href="INDEX.php?p=tournament.php">Tournament</a></li>
        </ul>
    </nav>


    <?php print_r($_GET);
    
        if (isset($_GET['p'])) {
            include_once($_GET['p']);
        }
        else {
            include_once('INDEX.php');
        }
        
        // var_dump($results)
        
    ?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>