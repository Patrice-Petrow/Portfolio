<?php

session_start();

// On vérifie que la personne est bien loguée et que son statut correspond bien à Administrateur
// Si une des deux conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] !== 1 || $_SESSION['profil'] !== '*****') {
    header('location:../../connexion.php');
}

require 'header_administrateur.php';

if ($_COOKIE['statut_employe'] === '1') {
    $oui = 'checked';
    $non = '';
} else if ($_COOKIE['statut_employe'] === '0') {
    $oui = '';
    $non = 'checked';
}
?>

<!----------->
<!-- Titre -->
<!----------->
<h4 class="col-md-6 mx-auto pb-2 border-bottom border-primary pt-5 my-5" style="width: fit-content;">Formulaire de gestion de l'employé</h4>

<!--------------------------------------------------->
<!-- Formulaire avec les informations de l'employé -->
<!--------------------------------------------------->
<div class="col-md-6 mx-auto">
    <form id="" data-sb-form-api-token="API_TOKEN" method="POST" action="action.php">
        <!-- Nom input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="nom" type="text" name="nom" value="<?php echo ($_COOKIE['nom_employe']) ?>" />
            <label for="nom">Nom</label>
        </div>
        <!-- Prenom input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="prenom" type="text" name="prenom" value="<?php echo ($_COOKIE['prenom_employe']) ?>" />
            <label for="prenom">Prénom</label>
        </div>
        <!-- Anniversaire input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="anniv" type="date" name="anniv" value="<?php echo ($_COOKIE['anniv_employe']) ?>" />
            <label for="anniv">Anniversaire</label>
        </div>
        <!-- Adresse input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="address" type="text" name="address" value="<?php echo ($_COOKIE['address_employe']) ?>" />
            <label for="address">Adresse</label>
        </div>
        <!-- Complément d'adresse input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="complement" type="text" name="complement" value="<?php echo (!empty($_COOKIE['complement_employe']) ? $_COOKIE['complement_employe'] : '') ?>" />
            <label for="complement">Complément d'adresse</label>
        </div>
        <!-- Code postal input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="zip" type="text" name="zip" value="<?php echo ($_COOKIE['zip_employe']) ?>" />
            <label for="zip">Code postal</label>
        </div>
        <!-- Ville input -->
        <div class="form-floating mb-3">
            <input class="form-control" id="ville" type="text" name="ville" value="<?php echo ($_COOKIE['ville_employe']) ?>" />
            <label for="ville">Ville</label>
        </div>
        <!-- Email input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="email" type="email" name="email" value="<?php echo ($_COOKIE['mail_employe']) ?>" />
            <label for="email">E-mail</label>
        </div>
        <!-- Téléphone portable input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="phone" type="text" name="port" value="<?php echo (!empty($_COOKIE['port_employe']) ? $_COOKIE['port_employe'] : '') ?>" />
            <label for="phone">Téléphone portable</label>
        </div>
        <!-- Téléphone fixe input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="fixe" type="text" name="fixe" value="<?php echo (!empty($_COOKIE['fixe_employe']) ? $_COOKIE['fixe_employe'] : '') ?>" />
            <label for="fixe">Téléphone fixe</label>
        </div>
        <!-- Mot de passe input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="mdp" type="password" name="mdp" value="<?php echo ($_COOKIE['mdp_employe']) ?>" />
            <label for="mdp">Mot de passe</label>
        </div>
        <!-- Confirmation du mot de passe input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="mdpConf" type="password" name="mdpConf" value="<?php echo ($_COOKIE['mdp_employe']) ?>" />
            <label for="mdpConf">Confirmez le mot de passe</label>
        </div>
        <!-- Activation / Désactivation du compte -->
        <div>
            <div class="col-md-4">
                <div class="row">
                    <div class="mb-2">
                        <span class="fontlabel">Le compte est-il toujours actif ?</span>
                    </div>
                    <div style="width: fit-content;" class="ms-md-4">
                        <input type="radio" name="actif" id="" value="1" <?php echo ($oui) ?>>
                        <label for="">Oui</label>
                    </div>
                    <div style="width: fit-content;" class="ms-md-4">
                        <input type="radio" name="actif" id="" value="0" <?php echo ($non) ?>>
                        <label for="">Non</label>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- Boutons de Validation / Annulation -->
        <button class="btn btn-primary btn-sm mb-5" id="submitButton" type="submit" name="validerEmploye">Valider les modifications</button>
        <a class="btn btn-secondary btn-sm mb-5 ms-3" href="selection_employe.php">Autre employé</a>
    </form>
</div>