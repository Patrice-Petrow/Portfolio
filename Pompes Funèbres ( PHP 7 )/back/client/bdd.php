<?php


try {
    //Connexion à la BDD
    $bdd = new PDO("mysql:host=*****;dbname=*****", '*****', '*****');
} catch (Exception $e) {
    die('Erreur' . $e->getMessage());
}

$dossier = basename(__DIR__);

//Meta données
$connDonneesSociete = $bdd->prepare("SELECT * FROM societe_pf WHERE dossier='$dossier'");
$connDonneesSociete->execute(array($dossier));
$donneesSociete = $connDonneesSociete->fetch();

?>
