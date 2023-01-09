<?php

session_start();

// On vérifie que la personne est bien loguée, que son statut correspond bien à RH et que son compte est actif
// Si une des trois conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****' || $_SESSION['statut'] === 0) {
    header('location:../../connexion.php');
}

require 'header_rh.php';

?>


<h2>Annonce(s) parue(s) pour le site de <?php echo ($_COOKIE['nomSite'] . ' à ' . $_COOKIE['nomVille']) ?> </h2>
<br>
<div id="annonces">
    <?php

    $statut = $_COOKIE['statut'];
    $choix = $_COOKIE['choix'];

    require_once 'bdd.php';
    if($statut != 'null') {
    // On récupères les annonces en fonction du statut selectionné
            $sql = $bdd->query("SELECT * FROM emplois WHERE fk_societe = $choix AND statut = $statut");
            $sql->execute();
            $data = $sql->fetchAll();
    } else {
            // On récupères les annonces en fonction du statut selectionné
            $sql = $bdd->query("SELECT * FROM emplois WHERE fk_societe = $choix AND statut IS NOT NULL");
            $sql->execute();
            $data = $sql->fetchAll();
    }

    $flag = '&emsp;&emsp;<span class="btn-warning btn-sm" >Inactive</span>';

    // Affichage des annonces sous forme de card
    foreach ($data as $job) : ?>
        <div class="card col-md-10 border-primary mx-auto">
            <h4 class="card-header header-bg-primary"><?php echo (utf8_encode($job['nom_emploi'])); if($job['statut'] === '0') {echo($flag);} ?></h4>
            <div class="card-body">
                <h5 class="card-title">Description</h5>
                <p class="card-text"><?php echo (utf8_encode($job['description_emploi'])) ?></p><br>
                <h5 class="card-title">Informations complémentaires</h5>
                <p class="card-text">Type de contrat : <?php echo ($job['contrat']) ?>.</p>
                <p class="card-text">Durée de travail hebdomadaire : <?php echo ($job['temps']) ?></p>
                <p class="card-text">Salaire : <?php echo ($job['salaire_heure']) ?></p>
                <p class="card-text">Obligations : <?php echo (utf8_encode($job['obligation_emploi'])) ?>.</p>
                <p class="card-text"></p>
                <form action="action.php" method="post">
                    <input type="hidden" name="id_emploi" value="<?php echo ($job['id_emploi']) ?>">
                    <input type="submit" value="Modifier" name="modifier" class="btn btn-primary">
                </form>
            </div>
        </div>
        <br>
    <?php endforeach; ?>
</div>