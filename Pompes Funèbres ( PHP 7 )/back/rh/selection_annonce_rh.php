<?php

session_start();

// On vérifie que la personne est bien loguée, que son statut correspond bien à RH et que son compte est actif
// Si une des trois conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****' || $_SESSION['statut'] === 0) {
    header('location:../../connexion.php');
}

require_once 'bdd.php';
require_once 'header_rh.php';

$affichage = $_COOKIE['affichage'];
$noResult = $_COOKIE['noResult'];
?>
<!--------------------------------------------------------->
<!-- Selection du site pour lequel afficher les annonces -->
<!--------------------------------------------------------->
<div class="col-md-5 mx-auto pt-5 mt-5" style="width: fit-content;">
    <div class="row">
        <span class="col-md-5" style="width: fit-content;">Veuillez choisir le nom du site :</span>
        <form class="col" action="action.php" method="POST">
            <!-- Menu déroulant propsant les différents sites -->
            <select name="choixSite">
                <?php

                $sql = $bdd->query("SELECT societe_id, nom, ville FROM societe_pf ORDER BY nom ");
                $sql->execute(array());
                $result = $sql->fetchAll();

                foreach ($result as $site) :
                ?>
                    <option value="<?php echo ($site['societe_id']) ?>"><?php echo ($site['nom'] . ' - ' . $site['ville']) ?></option>
                <?php endforeach; ?>
            </select>
            &emsp;<button type="submit" name="selectionSite" class="btn btn-primary btn-sm">Valider</button>
        </form>
    </div>
</div>

<!------------------------------------------------------------------>
<!-- Message si il n'y a aucune annnonce pour le site selectionné -->
<!------------------------------------------------------------------>
<div class="row">
    <div class="alert alert-danger col-md-4 mx-auto mt-5 text-center" role="alert" style="display: <?php echo ($noResult) ?>;">Il n'y a aucune annonce correspondant à votre selection</div>
</div>

<!----------------------------------------------------------->
<!-- Affichage et tri des annonces après selection du site -->
<!----------------------------------------------------------->
<div id="affichageAnnonces" style="display: <?php echo ($affichage) ?>;">
    <!-- Tri des annonces -->
    <div class="col-md-4 mx-auto mt-2" style="width: fit-content;">
        <br>
        <div class="row">
            <form action="" method="POST">
                <input type="hidden" name="choixSite" value="<?php echo ($_COOKIE['choix']) ?>">
                <span class="col-md-5">Vous souhaitez voir les annonces :</span>&emsp;
                <input type="radio" name="choixStatut" value="1">
                <label for="">Actives</label>&emsp;
                <input type="radio" name="choixStatut" value="0">
                <label for="">Inactives</label>&emsp;
                <input type="radio" name="choixStatut" value="2" checked>
                <label for="">Les deux</label>&emsp;
                <button type="submit" name="triAnnonces" class="btn btn-secondary btn-sm">Valider</button>
            </form>
        </div>
    </div>
    <br>
    <br>

    <!-- Affichage annonces -->
    <h4 class="col-md-6 mx-auto pb-2 border-bottom border-primary" style="width: fit-content;">Annonce(s) parue(s) pour le site de <?php echo ($_COOKIE['nomSite'] . ' à ' . $_COOKIE['nomVille']) ?> </h4>
    <br>
    <br>
    <div>
        <?php
        // Si action sur le boutton triAnnonces
        if (isset($_POST['triAnnonces'])) {
            $statut = $_POST['choixStatut'];
            $choix = $_POST['choixSite'];

            if ($_POST['choixStatut'] == 0 || $_POST['choixStatut'] == 1) {
                // On récupères les annonces en fonction du statut selectionné
                $sql = $bdd->prepare("SELECT * FROM site_emplois WHERE fk_societe = ? AND statut = $statut");
                $sql->execute(array($choix));
                $data = $sql->fetchAll();
            // Sinon on récupères toutes les annonces
            } else {
                $sql = $bdd->prepare("SELECT * FROM site_emplois WHERE fk_societe = ? AND statut IS NOT NULL");
                $sql->execute(array($_COOKIE['siteChoix']));
                $data = $sql->fetchAll();
            }
        // si pas d'action sur le bouton triAnnonces
        } else {
            $sql = $bdd->prepare("SELECT * FROM site_emplois WHERE fk_societe = ? AND statut IS NOT NULL");
            $sql->execute(array($_COOKIE['siteChoix']));
            $data = $sql->fetchAll();

        }

        // Flag affiché pour les annonces inactives
        $flag = '&emsp;&emsp;<span class="btn-warning btn-sm" >Inactive</span>';

        // Affichage des annonces sous forme de card
        foreach ($data as $job) : ?>
            <div class="card col-md-10 mx-auto">
                <h4 class="card-header header-bg-primary"><?php echo (utf8_encode($job['nom_emploi']));
                                                            if ($job['statut'] === '0') {
                                                                echo ($flag);
                                                            } ?></h4>
                <div class="card-body">
                    <h5 class="card-title">Description</h5>
                    <p class="card-text" style="white-space: pre-wrap"><?php echo (utf8_encode($job['description_emploi'])) ?></p><br>
                    <h5 class="card-title" style="white-space: pre-wrap">Informations complémentaires</h5>
                    <p class="card-text">Type de contrat : <?php echo ($job['contrat']) ?>.</p>
                    <p class="card-text">Durée de travail hebdomadaire : <?php echo ($job['temps']) ?></p>
                    <p class="card-text">Salaire : <?php echo ($job['salaire_heure']) ?></p>
                    <p class="card-text">Obligations : <?php echo (utf8_encode($job['obligation_emploi'])) ?></p>
                    <p class="card-text"></p>
                    <form action="action.php" method="post">
                        <input type="hidden" name="id_emploi" value="<?php echo ($job['id_emploi']) ?>">
                        <input type="submit" value="Modifier" name="modifier" class="btn btn-primary">
                        <input type="submit" value="Dupliquer" name="dupliquer" class="btn btn-secondary">
                    </form>
                </div>
            </div>
            <br>
        <?php endforeach; ?>
    </div>
</div>
