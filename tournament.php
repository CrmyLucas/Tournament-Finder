<?php
// requete SELECT 
try {
    //rajouter where apres user pour chercher l'id d'un user en particulier (userId = 1)
    $sql = "SELECT * FROM tournament ;";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
} catch (Exception $e) {
    print "Erreur ! " . $e->getMessage() . "<br/>";
}
$tournamentDetails = $stmt->fetchAll(PDO::FETCH_ASSOC)
?>

<h1>Tournament List</h1>




<form class="adduser" method="POST">
    <input type="text" name="Name" placeholder="Tournament Name">
    <input type="text" name="Password" placeholder="Id Game">
    <input type="date" name="date">
    <input type="submit" name="addUser">
</form>


<!-- Boucle les resultats en style carte -->

<div class="container">
    <?php
    foreach ($tournamentDetails as $tournamentDetail) { ?>

        <div class="carte">
            <div class="carte-title">
                <?= $tournamentDetail['NameTournament'] ?>
            </div>
            <div>
                <?php 
                    //img test existe 
                    // print_r(getimagesize($folder . $result['PictureUser']));
                    // le Arobase sert a enlever l'erreur quand il n'y a pas de fichier
                    if (@is_array( getimagesize($tournamentDetail['TournamentPicture']))){
                        echo '<img width="124" src="' . $tournamentDetail['TournamentPicture'] . '" alt="">';
                        // echo 'img ok';
                    }
                    else{
                        echo '<img width="124" src="uploads/mc.jpg" alt="">';
                        // echo 'img not ok';
                    }
                ?>
            </div>
            <div class="carte-text">
            </div>
            <?php var_dump($tournamentDetail['IdTournament']) ?>
            <a class="botn botn-yellow" href="INDEX.php?p=profiletournament.php&IdTournament=<?php echo $tournamentDetail['IdTournament']; ?>">See More</a>
        </div>

    <?php } ?>
</div>

<!-- Fin des cartes -->