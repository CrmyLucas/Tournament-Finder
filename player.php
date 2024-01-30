<h1>Player list</h1>


<form class="adduser" method="POST">
    <input type="text" name="Name" placeholder="Name">
    <input type="text" name="Password" placeholder="Password">
    <input type="Mail" name="Mail" placeholder="Mail">
    <input type="submit" name="addUser">
</form>


<!-- Boucle les resultats en style carte -->

<div class="container">
    <?php
    foreach ($results as $result) { ?>

        <div class="carte">
            <div class="carte-title">
                <?php echo $result['Name'] ?>
            </div>
            <div class="carte-text">
                <?php echo $result['Mail'] ?>
            </div>
            <a class="botn botn-yellow" href="INDEX.php?p=profilePlayer.php&UserId=<?php echo $result['UserId']; ?>">See More</a>
        </div>

    <?php } ?>
</div>

<!-- Fin des cartes -->