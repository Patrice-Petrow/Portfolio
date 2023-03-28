<?php

session_start();

require_once 'bdd.php';

// On vérifie que la personne est bien loguée, que son statut correspond bien à RH et que son compte est actif
// Si une des trois conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****' || $_SESSION['statut'] === 0) {
    header('location:../../connexion.php');
}

require_once 'header_rh.php';
?>

<h4 class="col-md-6 mx-auto pb-2 border-bottom border-primary  pt-5 mt-5" style="width: fit-content;">Liste des candidatures reçues</h4>

<!------------------------------------------------------>
<!-- Traitement des boutons de filtrage des annonces -->
<!------------------------------------------------------>
<?php
// Traitement bouton : aucun filtrage
if (isset($_POST['filtrageAucun'])) {
    $sql = $bdd->prepare("SELECT nom, ville, nom_emploi, id_emploi, nom_postulant, prenom_postulant, id_postulant, lettre_motivation, cv FROM societe_pf 
        INNER JOIN site_postulant ON site_postulant.fk_societe=societe_pf.societe_id INNER JOIN site_emplois ON fk_emploi=id_emploi ");
    $sql->execute();
    $data = $sql->fetchAll();
// Traitement bouton : candidatures spontanées
} else if (isset($_POST['filtrageSpontanee'])) {
    $sql = $bdd->prepare("SELECT nom, ville, nom_postulant, prenom_postulant, id_postulant, nom_emploi, id_emploi, fk_emploi, lettre_motivation, cv from societe_pf inner join 
    site_postulant ON site_postulant.fk_societe=societe_pf.societe_id inner join site_emplois on site_postulant.fk_emploi=site_emplois.id_emploi and site_postulant.fk_emploi=1");
    $sql->execute();
    $data = $sql->fetchAll();
// Traitement bouton : selection par sites
} else if (isset($_POST['filtrageSite'])) {
    $sql = $bdd->prepare("SELECT nom, ville, nom_emploi, fk_emploi, nom_postulant, prenom_postulant, id_postulant, societe_id, lettre_motivation, cv from site_postulant 
        inner join societe_pf ON site_postulant.fk_societe = societe_pf.societe_id inner join site_emplois on site_emplois.id_emploi = site_postulant.fk_emploi and
        societe_id = ? ");
    $sql->execute(array($_POST['choixSite']));
    $data = $sql->fetchAll();
// Pas de bouton
} else {
    $sql = $bdd->prepare("SELECT nom, ville, nom_emploi, id_emploi, nom_postulant, prenom_postulant, id_postulant, lettre_motivation, cv FROM societe_pf 
        INNER JOIN site_postulant ON site_postulant.fk_societe=societe_pf.societe_id INNER JOIN site_emplois ON fk_emploi=id_emploi ");
    $sql->execute();
    $data = $sql->fetchAll();
}
?>

<!------------------------------------------>
<!-- Navbar pour le filtrage des annonces -->
<!------------------------------------------>
<div class="col-md-8 mx-auto pt-5 mt-5">
    <div class="row align-items-center justify-content-center">
        <span class="col-md-1" style="width: fit-content;">Filtrage des candidatures :</span>
        <!-- Bouton : aucun filtrage -->
        <form action="" method="post" class="col-md-1">
            <input type="submit" value="Aucun" name="filtrageAucun" class="btn btn-secondary btn-sm">
        </form>
        <!-- Bouton : candidatures spontanées -->
        <form action="" method="post" class="col-md-2">
            <input type="submit" value="Candidatures spontanées" name="filtrageSpontanee" class="btn btn-secondary btn-sm">
        </form>&emsp;
        <!-- Bouton : selection de site -->
        <form class="col-md-5" action="" method="POST">
            <select name="choixSite" class="btn btn-secondary btn-sm">
                <option value="">Par site</option>
                <?php
                $sql = $bdd->prepare("SELECT societe_id, nom, ville FROM societe_pf ORDER BY nom ");
                $sql->execute(array());
                $result = $sql->fetchAll();

                foreach ($result as $site) :
                ?>
                    <option value="<?php echo ($site['societe_id']) ?>"><?php echo ($site['nom'] . ' - ' . $site['ville']) ?></option>
                <?php endforeach; ?>
            </select>
            &emsp;<button type="submit" name="filtrageSite" class="btn btn-primary btn-sm">Valider</button>
        </form>
    </div>
</div>

<!---------------------------------------->
<!-- Définition des titres des colonnes -->
<!---------------------------------------->
<div class="container col-md-10 mt-5">
    <div class="row align-items-center border-bottom border-dark">
        <div class="col-md-2"><strong>Annonce</strong></div>
        <div class="col-md-3"><strong>Site</strong></div>
        <div class="col"><strong>Nom</strong></div>
        <div class="col"><strong>Prénom</strong></div>
        <div class="col"><strong>CV</strong></div>
        <div class="col"><strong>Lettre de motivation</strong></div>
        <div class="col"></div>
    </div>
</div>

<!--------------------------->
<!-- Peuplement du tableau -->
<!--------------------------->
<?php foreach ($data as $postulant) : ?>
    <div class="container col-md-10">
        <div class="row align-items-center my-3">
            <div class="col-md-2">
                <?php echo ($postulant['nom_emploi']) ?>
            </div>
            <div class="col-md-3">
                <?php echo ($postulant['nom'] . ' - ' . $postulant['ville']) ?>
            </div>
            <div class="col">
                <?php echo ($postulant['nom_postulant']) ?>
            </div>
            <div class="col">
                <?php echo ($postulant['prenom_postulant']) ?>
            </div>
            <div class="col">
                <a class="btn btn-primary btn-sm" href="/<?php echo ($postulant['cv']) ?>" target="_blank">Imprimer</a>
            </div>
            <div class="col">
                <a class="btn btn-primary btn-sm" href="/<?php echo ($postulant['lettre_motivation']) ?>" <?php if ($postulant['lettre_motivation'] == '') {
                                                                                                                echo ("style=\"display: none;\"");
                                                                                                            } ?> target="_blank">Imprimer</a>
            </div>
            <form action="action.php" method="post" class="col">
                <div class="col">
                    <input type="hidden" name="id_postulant" value="<?php echo ($postulant['id_postulant']) ?>">
                    <input type="hidden" name="cv_postulant" value="<?php echo ($postulant['cv']) ?>">
                    <input type="hidden" name="lm_postulant" value="<?php echo ($postulant['lettre_motivation']) ?>">
                    <button type="submit" class="btn btn-danger btn-sm" name="supCandidature">Supprimer</button>
                </div>
            </form>
        </div>
    </div>

<?php
endforeach;
?>