<?php

session_start();

// On vérifie que la personne est bien loguée et que son statut correspond bien à Employé
// Si une des deux conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****' || $_SESSION['statut'] === 0) {
    header('location:../../connexion.php');
} 


require 'header_employe.php';

?>

<!----------->
<!-- Titre -->
<!----------->
<h4 class="col-md-6 mx-auto pb-2 border-bottom border-primary  pt-5 mt-5" style="width: fit-content;">Formulaire de modification d'un compte client</h4>

<!------------------------------------------------------------->
<!-- Formuliare de modification des informations d'un client -->
<!------------------------------------------------------------->
<div class="col-md-8 mx-auto mt-5">
    <form id="" data-sb-form-api-token="API_TOKEN" method="POST" action="action.php">
        <!-- Nom input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="nom" type="text" name="nom" value="<?php echo($_COOKIE['nom_client']) ?>" />
            <label for="nom">Nom</label>
        </div>
        <!-- Prenom input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="prenom" type="text" name="prenom" value="<?php echo($_COOKIE['prenom_client']) ?>"/>
            <label for="prenom">Prénom</label>
        </div>
        <!-- Anniversaire input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="anniv" type="date" name="anniv" value="<?php echo(!empty($_COOKIE['anniv_client']) ? $_COOKIE['anniv_client'] : '') ?>" />
            <label for="anniv">Anniversaire</label>
        </div>
        <!-- Adresse input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="address" type="text" name="address" value="<?php echo(!empty($_COOKIE['address_client']) ? $_COOKIE['address_client'] : '') ?>" />
            <label for="address">Adresse</label>
        </div>
        <!-- Complément d'adresse input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="complement" type="text" name="complement" value="<?php echo(!empty($_COOKIE['complement_client']) ? $_COOKIE['complement_client'] : '') ?>" />
            <label for="complement">Complément d'adresse</label>
        </div>
        <!-- Code postal input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="zip" type="text" name="zip" value="<?php echo(!empty($_COOKIE['zip_client']) ? $_COOKIE['zip_client'] : '') ?>" />
            <label for="zip">Code postal</label>
        </div>
        <!-- Ville input -->
        <div class="form-floating mb-3">
            <input class="form-control" id="ville" type="text" name="ville" value="<?php echo(!empty($_COOKIE['ville_client']) ? $_COOKIE['ville_client'] : '') ?>" />
            <label for="ville">Ville</label>
        </div>
        <!-- Email input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="email" type="email" name="email" value="<?php echo($_COOKIE['mail_client']) ?>" />
            <label for="email">E-mail</label>
        </div>
        <!-- Téléphone portable input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="phone" type="text" name="port" value="<?php echo(!empty($_COOKIE['port_client']) ? $_COOKIE['port_client'] : '') ?>" />
            <label for="phone">Téléphone portable</label>
        </div>
        <!-- Téléphone fixe input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="fixe" type="text" name="fixe" value="<?php echo(!empty($_COOKIE['fixe_client']) ? $_COOKIE['fixe_client'] : '') ?>" />
            <label for="fixe">Téléphone fixe</label>
        </div>
        <!-- Mot de passe input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="mdp" type="password" name="mdp" value="<?php echo(!empty($_COOKIE['mdp_client']) ? $_COOKIE['mdp_client'] : '') ?>" />
            <label for="mdp">Mot de passe</label>
        </div>
        <!-- Confirmation du mot de passe input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="mdpConf" type="password" name="mdpConf" value="<?php echo(!empty($_COOKIE['mdp_client']) ? $_COOKIE['mdp_client'] : '') ?>" />
            <label for="mdpConf">Confirmez le mot de passe</label>
        </div>
        <!-- Submit Button-->
        <button class="btn btn-primary btn-sm" id="submitButton" type="submit" name="validerClient">Valider les modifications</button>
        <a class="btn btn-secondary btn-sm ms-3" href="selection_client.php">Annuler</a>
        <div>
            <br>
            <label for="mdpSuppression">Veuillez saisir votre mot de passe</label>
            <input type="password" name="mdpSuppression" class="ms-3">
            <button type="submit" name="suppressionClient" class="btn btn-danger btn-sm ms-3">Supprimer le compte client</button>
        </div>
    </form>
    <br>
</div>

