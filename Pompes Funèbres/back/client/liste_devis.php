<?php

session_start();

if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****') {
    header('location:../../connexion.php');
}

require 'header_client.php';

// Récupération des informations devis
$sql = $bdd->prepare("SELECT * FROM site_defunt WHERE fk_user=? ORDER BY id_defunt DESC");
$sql->execute(array($_SESSION['id']));
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
<h4 class="col-md-6 mx-auto pb-2 border-bottom border-primary pt-5 my-5" style="width: fit-content;">Votre devis en cours</h4>

<!----------------------------------------------------------------->
<!-- Message si il n'y a aucne annnonce pour le site selectionné -->
<!----------------------------------------------------------------->
<div class="row">
    <div class="alert alert-danger col-md-2 mx-auto mt-5 text-center" role="alert" style="display: <?php echo ($affNodevis) ?>;">Vous n'avez aucun devis en cours</div>
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
                if ($_SESSION['urgent'] === '3') {
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
                        <input type="radio" name="civiliteDefunt" value="0" <?php echo ($madameDef) ?> disabled>
                        <label for="">Madame</label>&emsp;
                        <input type="radio" name="civiliteDefunt" value="1" <?php echo ($monsieurDef) ?> disabled>
                        <label for="">Monsieur</label>
                    </div>
                    <br>
                    <!-- Nom -->
                    <div>
                        <input type="text" name="nomDefunt" placeholder="<?php echo ($devis['nomDef']) ?>" class="form-control" readonly>
                    </div>
                    <br>
                    <!-- Prénom -->
                    <div>
                        <input type="text" name="prenomDefunt" placeholder="<?php echo ($devis['prenomDef']) ?>" class="form-control" readonly>
                    </div>
                    <br>
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
                            <input type="radio" name="lieux" value="1" <?php echo ($domicile) ?> disabled>
                            <label for="">Domicile</label>
                        </div>
                        <div style="width: fit-content;" class="ms-md-4">
                            <input type="radio" name="lieux" value="2" <?php echo ($hopital) ?> disabled>
                            <label for="">Hôpital</label>
                        </div>
                        <div style="width: fit-content;" class="ms-md-4">
                            <input type="radio" name="lieux" value="3" <?php echo ($saispas1) ?> disabled>
                            <label for="">Ne sais pas</label>
                        </div>
                    </div>
                    <br>
                    <!-- Code postal -->
                    <div>
                        <input type="text" name="zip" placeholder="<?php echo ($devis['zipDef']) ?>" class="form-control" readonly>
                    </div>
                    <br>
                    <!-- Ville -->
                    <div>
                        <input type="text" name="ville" placeholder="<?php echo ($devis['villeDef']) ?>" class="form-control" readonly>
                    </div>
                </div>
                <br>

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
                                <input type="radio" name="obseques" value="1" <?php echo ($inhumation) ?> disabled>
                                <label for="">Inhumation</label>
                            </div>
                            <div style="width: fit-content;" class="ms-md-4">
                                <input type="radio" name="obseques" value="2" <?php echo ($cremation) ?> disabled>
                                <label for="">Crémation</label>
                            </div>
                            <div style="width: fit-content;" class="ms-md-4">
                                <input type="radio" name="obseques" value="3" <?php echo ($saispas2) ?> disabled>
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
                                <input type="radio" name="ceremonie" value="1" <?php echo ($non) ?> disabled>
                                <label for="">Non</label>
                            </div>
                            <div style="width: fit-content;" class="ms-md-4">
                                <input type="radio" name="ceremonie" value="2" <?php echo ($oui) ?> disabled>
                                <label for="">Oui</label>
                            </div>
                            <div style="width: fit-content;" class="ms-md-4">
                                <input type="radio" name="ceremonie" value="3" <?php echo ($saispas3) ?> disabled>
                                <label for="">Ne sais pas</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <!-- Formulaire contactant -->
                <div>
                    <h5 style="width: fit-content;" class="mx-auto mt-5 mb-3 pb-2 border-bottom border-primary ms-0">Vos coordonnées</h5>
                    <!-- Civilités -->
                    <div>
                        <?php
                        switch ($_SESSION['civilite']) {
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
                    <br>
                    <!-- Nom -->
                    <div>
                        <input type="text" name="nomContactant" placeholder="<?php echo ($_SESSION['nom']) ?>" class="form-control" readonly>
                    </div>
                    <br>
                    <!-- Prénom -->
                    <div>
                        <input type="text" name="prenomContactant" placeholder="<?php echo ($_SESSION['prenom']) ?>" class="form-control" readonly>
                    </div>
                    <br>
                    <!-- Téléphone -->
                    <div>
                        <input type="text" name="telephone" placeholder="<?php echo ($_SESSION['port']) ?>" class="form-control" readonly>
                    </div>
                    <br>
                    <!-- Mail -->
                    <div>
                        <input type="email" name="mail" placeholder="<?php echo ($_SESSION['mail']) ?>" class="form-control" readonly>
                    </div>
                    <br>
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