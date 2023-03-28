<?php

session_start();

if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****' ) {
    header('location:../../connexion.php');
} 

require 'header_client.php';

?>

<!----------->
<!-- Titre -->
<!----------->
<h4 class="col-md-6 mx-auto pb-2 border-bottom border-primary  pt-5 my-5" style="width: fit-content;">Formulaire de demande de devis</h4>

<!-------------------------------------->
<!-- Formulaire de céation d'un devis -->
<!-------------------------------------->
<div class="col-11 col-lg-5  justify-content-center mx-auto">
    <div>
        <div>
            <form action="action.php" method="POST">
                <!-- Type de demande -->
                <h5 style="width: fit-content;" class="mx-auto mb-3 pb-2 border-bottom border-primary ms-0">Objet de votre demande</h5>
                <div style="width: fit-content;" class="row mx-auto ms-0">
                    <div style="width: fit-content;" class="ms-md-4">
                        <input type="radio" name="urgent" value="3" onchange="aff_defunt('non')">
                        <label for="">Prévoyance</label>&emsp;
                    </div>
                    <div style="width: fit-content;">
                        <input type="radio" name="urgent" value="2" onchange="aff_defunt('oui')">
                        <label for="">Une fin de vie</label>&emsp;
                    </div>
                    <div style="width: fit-content;">
                        <input type="radio" name="urgent" value="1" onchange="aff_defunt('oui')">
                        <label for="">Un décès</label>
                    </div>
                </div>
                <!-- Formualire concernant le défunt -->
                <div id="formulaireDefunt" style="display: none;">
                    <h5 style="width: fit-content;" class="mx-auto mt-5 mb-3 pb-2 border-bottom border-primary ms-0">Informations sur le défunt</h5>
                    <!-- Civilités -->
                    <div>
                        <span>Civilités :</span>&emsp;
                        <input type="radio" name="civiliteDefunt" value="0">
                        <label for="">Madame</label>&emsp;
                        <input type="radio" name="civiliteDefunt" value="1">
                        <label for="">Monsieur</label>
                    </div>
                    <!-- Nom -->
                    <div class="my-3">
                        <input type="text" name="nomDefunt" placeholder="Nom" class="form-control">
                    </div>
                    <!-- Prénom -->
                    <div class="my-3">
                        <input type="text" name="prenomDefunt" placeholder="Prénom" class="form-control">
                    </div>
                    <!-- Lieux défunt -->
                    <div class="my-3 row">
                        <div class="mb-2">
                            <span class="fontlabel">Où se trouve le défunt ?</span>&emsp;
                        </div>
                        <div style="width: fit-content;" class="ms-md-4">
                            <input type="radio" name="lieux" value="1">
                            <label for="">Domicile</label>&emsp;
                        </div>
                        <div style="width: fit-content;">
                            <input type="radio" name="lieux" value="2">
                            <label for="">Hôpital</label>&emsp;
                        </div>
                        <div style="width: fit-content;">
                            <input type="radio" name="lieux" value="3">
                            <label for="">Ne sais pas</label>
                        </div>
                    </div>
                    <!-- Code postal -->
                    <div class="my-3">
                        <input type="text" name="zip" placeholder="Code postal" class="form-control">
                    </div>
                    <!-- Ville -->
                    <div>
                        <input type="text" name="ville" placeholder="Ville" class="form-control">
                    </div>
                </div>

                <!-- Formulaire Prévoyance -->
                <div>
                    <h5 style="width: fit-content;" class="mx-auto mt-5 mb-3 pb-2 border-bottom border-primary ms-0">Informations sur les obsèques</h5>
                    <!-- Type d'obsèques -->
                    <div class="my-3  row">
                        <div class="mb-2">
                            <span class="fontlabel">Type d'obsèques :</span>&emsp;
                        </div>
                        <div style="width: fit-content;" class="ms-md-4">
                            <input type="radio" name="obseques" value="1">
                            <label for="">Inhumation</label>&emsp;
                        </div>
                        <div style="width: fit-content;">
                            <input type="radio" name="obseques" value="2">
                            <label for="">Crémation</label>&emsp;
                        </div>
                        <div style="width: fit-content;">
                            <input type="radio" name="obseques" value="3">
                            <label for="">Ne sais pas</label>
                        </div>
                    </div>
                    <!-- Cérémonie religieuse -->
                    <div class="my-3 row">
                        <div class="mb-1">
                            <span class="fontlabel">Une cérémonie religieuse aura-t-elle lieux ?</span>&emsp;
                        </div>
                        <div style="width: fit-content;" class="ms-md-4">
                            <input type="radio" name="ceremonie" value="2">
                            <label for="">Oui</label>&emsp;
                        </div>
                        <div style="width: fit-content;">
                            <input type="radio" name="ceremonie" value="1">
                            <label for="">Non</label>&emsp;
                        </div>
                        <div style="width: fit-content;">
                            <input type="radio" name="ceremonie" value="3">
                            <label for="">Ne sais pas</label>
                        </div>
                    </div>
                </div>

                <!-- Formulaire contactant -->
                <div>
                    <h5 style="width: fit-content;" class="mx-auto mt-5 mb-3 pb-2 border-bottom border-primary ms-0">Vos coordonnées</h5>
                    <!-- Civilités -->
                    <div class="my-3">
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
                        <input type="radio" name="civiliteContactant" value="0" <?php echo ($madame) ?>>
                        <label for="">Madame</label>&emsp;
                        <input type="radio" name="civiliteContactant" value="1" <?php echo ($monsieur) ?>>
                        <label for="">Monsieur</label>
                    </div class="my-3">
                    <!-- Nom -->
                    <div>
                        <input type="text" name="nomContactant" placeholder="Nom" class="form-control" value="<?php echo ($_SESSION['nom']) ?>">
                    </div>
                    <!-- Prénom -->
                    <div class="my-3">
                        <input type="text" name="prenomContactant" placeholder="Prénom" class="form-control" value="<?php echo ($_SESSION['prenom']) ?>">
                    </div>
                    <!-- Téléphone -->
                    <div class="my-3">
                        <input type="text" name="telephone" placeholder="Numéro de téléphone" class="form-control" value="<?php echo ($_SESSION['port']) ?>">
                    </div>
                    <!-- Mail -->
                    <div class="my-3">
                        <input type="email" name="mail" placeholder="Adresse mail" class="form-control" value="<?php echo ($_SESSION['mail']) ?>">
                    </div>
                    <!-- Commentaires -->
                    <div class="my-3">
                        <label for="commentaires">Commentaires</label>
                    </div>
                    <div class="my-3">
                        <textarea name="commentaires" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <!-- Bouton de validation -->
                <input type="submit" class="btn btn-primary mb-5" name="devisObsequesClient" value="Envoyer">
            </form>
        </div>
    </div>
</div>

<script src="../../js/scripts_perso.js"></script>









