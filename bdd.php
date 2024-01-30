<!-- se connecter a la base de données -->
<?php
try {
    $bdd = new PDO("mysql:host=localhost;dbname=testsite", "root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die($erreur_sql = 'Erreur connect bd: ' . $e->getMessage());
}
if (isset($_ErreurSql)) {
    echo $Erreur_sql;
}
?>
<!-- fin connection base de donnee -->