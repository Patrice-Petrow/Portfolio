<?php

session_start();

// On vérifie que la personne est bien loguée et que son statut correspond bien à Administrateur
// Si une des deux conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] !== 1 || $_SESSION['profil'] !== '*****') {
    header('location:../' . $_SESSION['site'] . '/connexion.php');
}

require 'header_administrateur.php';

$affichage = $_COOKIE['affichage'];
$noResult = $_COOKIE['noResult'];

?>


<!----------->
<!-- Titre -->
<!----------->
<h4 class="col-md-6 mx-auto pb-2 border-bottom border-primary pt-5 my-5" style="width: fit-content;">Gestion des avis client</h4>

<!----------------------------------------------------->
<!-- Selection du site pour lequel afficher les avis -->
<!----------------------------------------------------->
<div class="col-md-5 mx-auto my-5" style="width: fit-content;">
    <div class="row">
        <span class="col-md-5" style="width: fit-content;">Veuillez choisir un site :</span>
        <form class="col" action="action.php" method="POST">
            <!-- Menu déroulant propsant les différents sites -->
            <select name="choixSiteAvis">
                <?php

                $sql = $bdd->query("SELECT societe_id, nom, ville FROM societe_pf ORDER BY nom ");
                $sql->execute(array());
                $result = $sql->fetchAll();

                foreach ($result as $site) :
                ?>
                    <option value="<?php echo ($site['societe_id']) ?>"><?php echo ($site['nom'] . ' - ' . $site['ville']) ?></option>
                <?php endforeach; ?>
            </select>
            &emsp;<button type="submit" name="siteAvis" class="btn btn-primary btn-sm">Valider</button>
        </form>
    </div>
</div>

<!------------------------------------------------------------->
<!-- Message si il n'y a aucun avis pour le site selectionné -->
<!------------------------------------------------------------->
<div class="row">
    <div class="alert alert-danger col-md-3 mx-auto mt-5 text-center" role="alert" style="display: <?php echo ($noResult) ?>;">Il n'y a aucun avis publié pour ce site</div>
</div>

<!-- Affiche des avis -->
<div class="col-8 mx-auto" style="display: <?php echo ($affichage) ?>;">

    <h4 class="col-md-6 mx-auto pb-2 border-bottom border-primary" style="width: fit-content;">Avis paru(s) pour le site de <?php echo ($_COOKIE['nomSite'] . ' à ' . $_COOKIE['nomVille']) ?> </h4>

    <?php
    $societe = $_COOKIE['idSiteAvis'];
  
    $sql = "SELECT nom, prenom, civilite, descr, id_temoignage FROM site_temoignage JOIN site_user ON site_user.id_user = site_temoignage.fk_userName 
    AND fk_societe = '$societe' ORDER BY id_temoignage DESC";
    $request = $bdd->query($sql);
    $temoignages = $request->fetchAll(); 
    foreach ($temoignages as $temoignage) :
    ?>

        <form action="action.php" method="post" class="row align-items-center justify-content-center">
            <div class="col-8">
                <span><?php if ($temoignage['civilite'] == '0') {
                            echo ('Mme ' . $temoignage['nom'] . ' ' . $temoignage['prenom']);
                        } else {
                            echo ('Mr ' . $temoignage['nom'] . ' ' . $temoignage['prenom']);
                        } ?></span>
                <span class="form-control shadow p-3 mb-5 mt-1 bg-body rounded"><?= $temoignage['descr'] ?></span>
            </div>
            <div style="width: fit-content;">
                <input type="hidden" name="id_temoignage" value="<?= $temoignage['id_temoignage'] ?>">
                <input type="submit" value="Supprimer" class="btn btn-sm btn-danger" name="supprimerAvis">
            </div>
        </form>
<?php endforeach; ?>
</div>



