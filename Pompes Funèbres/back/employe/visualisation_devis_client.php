<?php

session_start();

// On vérifie que la personne est bien loguée et que son statut correspond bien à Employé
// Si une des deux conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****' || $_SESSION['statut'] === 0) {
    header('location:../../connexion.php');
}

require 'header_employe.php';

// Récupération des informations devis
$sql = $bdd->prepare("SELECT * FROM site_defunt WHERE fk_user = ? ORDER BY id_defunt DESC");
$sql->execute(array($_COOKIE['id']));
$devis = $sql->fetch();

if ($devis == 'false' || $devis == '') {
    $affDevis = 'none';
    $affNodevis = 'block';
} else {
    $affDevis = 'block';
    $affNodevis = 'none';
}
?>

<!----------->
<!-- Titre -->
<!----------->
<h4 class="col-md-6 mx-auto pb-2 border-bottom border-primary  pt-5 mt-5" style="width: fit-content;">Vous visualisez le devis de&ensp;<?php echo ($_COOKIE['nom_client']) ?> <?php echo ($_COOKIE['prenom_client']) ?></h4>

<!----------------------------------------------------------------->
<!-- Message si il n'y a aucne annnonce pour le site selectionné -->
<!----------------------------------------------------------------->
<div class="row">
    <div class="alert alert-danger col-md-3 mx-auto mt-5 text-center" role="alert" style="display: <?php echo ($affNodevis) ?>;">Ce client n'a aucun devis en cours</div>
</div>

<!------------------------>
<!-- Affichage du devis -->
<!------------------------>
<div class="col-11 col-lg-5  justify-content-center mx-auto" style="display: <?php echo ($affDevis) ?>;">
    <div>
        <div>
            <form action="action.php" method="POST">
                <!-- Formualire concernant le défunt / Masqué pour un devis prévoyance -->
                <?php
                if ($_COOKIE['urgent'] === '3') {
                    $affichage = 'none';
                } else {
                    $affichage = 'inline';
                }
                ?>
                <div id="formulaireDefunt" style="display: <?php echo ($affichage) ?>;">
                    <h5 style="width: fit-content;" class="mx-auto mt-5 mb-3 pb-2 border-bottom border-primary ms-0">Informations sur le défunt</h5>
                    <!-- Civilités -->
                    <div>
                        <?php
                        switch ($devis['civilite']) {
                            case '0':
                                $madameDef = 'checked';
                                $monsieurDef = '';
                                break;
                            case '1':
                                $madameDef = '';
                                $monsieurDef = 'checked';
                        }
                        ?>
                        <span>Civilités :</span>&emsp;
                        <input type="radio" name="civiliteDefunt" id="" value="0" <?php echo ($madameDef) ?> disabled>
                        <label for="">Madame</label>&emsp;
                        <input type="radio" name="civiliteDefunt" id="" value="1" <?php echo ($monsieurDef) ?> disabled>
                        <label for="">Monsieur</label>
                    </div>
                    <br>
                    <!-- Nom -->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="nom" type="text" name="nom" value="<?php echo ($devis['nomDef']) ?>" readonly />
                        <label for="nom">Nom</label>
                    </div>
                    <!-- Prénom -->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="prenom" type="text" name="prenom" value="<?php echo ($devis['prenomDef']) ?>" readonly />
                        <label for="prenom">Prénom</label>
                    </div>
                    <!-- Lieux défunt -->
                    <div class="row">
                        <div class="mb-2">
                            <span class="fontlabel">Où se trouve le défunt ?</span>&emsp;
                        </div>
                        <?php
                        switch ($devis['fk_stockage']) {
                            case '1':
                                $domicile = 'checked';
                                $hopital = '';
                                $saispas1 = '';
                                break;
                            case '2':
                                $domicile = '';
                                $hopital = 'checked';
                                $saispas1 = '';
                                break;
                            case '3':
                                $domicile = '';
                                $hopital = '';
                                $saispas1 = 'checked';
                                break;
                        }
                        ?>
                        <div style="width: fit-content;" class="ms-md-4">
                            <input type="radio" name="lieux" id="" value="1" <?php echo ($domicile) ?> disabled>
                            <label for="">Domicile</label>
                        </div>
                        <div style="width: fit-content;" class="ms-md-4">
                            <input type="radio" name="lieux" id="" value="2" <?php echo ($hopital) ?> disabled>
                            <label for="">Hôpital</label>
                        </div>
                        <div style="width: fit-content;" class="ms-md-4">
                            <input type="radio" name="lieux" id="" value="3" <?php echo ($saispas1) ?> disabled>
                            <label for="">Ne sais pas</label>
                        </div>
                    </div>
                    <br>
                    <!-- Code postal -->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="zip" type="text" name="zip" value="<?php echo (!empty($devis['zipDef']) ? $devis['zipDef'] : '') ?>" readonly />
                        <label for="zip">Code postal</label>
                    </div>
                    <!-- Ville -->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="ville" type="text" name="ville" value="<?php echo (!empty($devis['villeDef']) ? $devis['villeDef'] : '') ?>" readonly />
                        <label for="ville">Ville</label>
                    </div>
                </div>
                <!-- Formulaire Prévoyance -->
                <div>
                    <h5 style="width: fit-content;" class="mx-auto mt-5 mb-3 pb-2 border-bottom border-primary ms-0">Informations sur les obsèques</h5>
                    <!-- Type d'obsèques -->
                    <div>
                        <?php
                        switch ($devis['fk_cremaType']) {
                            case '1':
                                $inhumation = 'checked';
                                $cremation = '';
                                $saispas2 = '';
                                break;
                            case '2':
                                $inhumation = '';
                                $cremation = 'checked';
                                $saispas2 = '';
                                break;
                            case '3':
                                $inhumation = '';
                                $cremation = '';
                                $saispas2 = 'checked';
                                break;
                        }
                        ?>
                        <div class="row">
                            <div class="mb-2">
                                <span class="fontlabel">Type d'obsèques :</span>
                            </div>
                            <div style="width: fit-content;" class="ms-md-4">
                                <input type="radio" name="obseques" id="" value="1" <?php echo ($inhumation) ?> disabled>
                                <label for="">Inhumation</label>
                            </div>
                            <div style="width: fit-content;" class="ms-md-4">
                                <input type="radio" name="obseques" id="" value="2" <?php echo ($cremation) ?> disabled>
                                <label for="">Crémation</label>
                            </div>
                            <div style="width: fit-content;" class="ms-md-4">
                                <input type="radio" name="obseques" id="" value="3" <?php echo ($saispas2) ?> disabled>
                                <label for="">Ne sais pas</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- Cérémonie religieuse -->
                    <div>
                        <?php
                        switch ($devis['fk_religion']) {
                            case '1':
                                $non = 'checked';
                                $oui = '';
                                $saispas3 = '';
                                break;
                            case '2':
                                $non = '';
                                $oui = 'checked';
                                $saispas3 = '';
                                break;
                            case '3':
                                $non = '';
                                $oui = '';
                                $saispas3 = 'checked';
                                break;
                        }
                        ?>
                        <div class="row">
                            <div class="mb-2">
                                <span class="fontlabel">Une cérémonie religieuse aura-t-elle lieux ?</span>
                            </div>
                            <div style="width: fit-content;" class="ms-md-4">
                                <input type="radio" name="ceremonie" id="" value="1" <?php echo ($non) ?> disabled>
                                <label for="">Non</label>
                            </div>
                            <div style="width: fit-content;" class="ms-md-4">
                                <input type="radio" name="ceremonie" id="" value="2" <?php echo ($oui) ?> disabled>
                                <label for="">Oui</label>
                            </div>
                            <div style="width: fit-content;" class="ms-md-4">
                                <input type="radio" name="ceremonie" id="" value="3" <?php echo ($saispas3) ?> disabled>
                                <label for="">Ne sais pas</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <!-- Formulaire contactant -->
                <div>
                    <h5 style="width: fit-content;" class="mx-auto mt-5 mb-3 pb-2 border-bottom border-primary ms-0">Coordonnées client</h5>
                    <!-- Civilités -->
                    <div class="mb-3">
                        <?php
                        switch ($_COOKIE['civilite_client']) {
                            case '0':
                                $madame = 'checked';
                                $monsieur = '';
                                break;
                            case '1':
                                $madame = '';
                                $monsieur = 'checked';
                                break;
                        }
                        ?>
                        <span>Civilités :</span>&emsp;
                        <input type="radio" name="civiliteContactant" value="0" <?php echo ($madame) ?> disabled>
                        <label for="">Madame</label>&emsp;
                        <input type="radio" name="civiliteContactant" value="1" <?php echo ($monsieur) ?> disabled>
                        <label for="">Monsieur</label>
                    </div>
                    <!-- Nom -->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="nom" type="text" name="nom" value="<?php echo ($_COOKIE['nom_client']) ?>" readonly />
                        <label for="nom">Nom</label>
                    </div>
                    <!-- Prénom -->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="prenom" type="text" name="prenom" value="<?php echo ($_COOKIE['prenom_client']) ?>" readonly />
                        <label for="prenom">Prénom</label>
                    </div>
                    <!-- Téléphone -->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="phone" type="text" name="port" value="<?php echo (!empty($_COOKIE['port_client']) ? $_COOKIE['port_client'] : '') ?>" readonly />
                        <label for="phone">Téléphone portable</label>
                    </div>
                    <!-- Mail -->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" type="email" name="email" value="<?php echo ($_COOKIE['mail_client']) ?>" readonly />
                        <label for="email">E-mail</label>
                    </div>
                    <!-- Commentaires -->
                    <div>
                        <label for="commentaires">Commentaires</label>
                    </div>
                    <div>
                        <textarea name="commentaires" cols="30" rows="10" class="form-control" readonly><?php echo ($devis['commentaires']) ?></textarea>
                    </div>
                    <br>
                </div>
            </form>
        </div>
    </div>
</div>