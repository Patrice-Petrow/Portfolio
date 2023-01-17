<?php

session_start();

// On vérifie que la personne est bien loguée et que son statut correspond bien à Employé
// Si une des deux conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****') {
    header('location:../../connexion.php');
}

require 'header_employe.php';

?>

<!----------->
<!-- Titre -->
<!----------->
<h4 class="col-md-6 mx-auto pb-2 border-bottom border-primary  pt-5 mt-5" style="width: fit-content;">Formulaire de modification de votre compte</h4>


<!--------------------------------------------------->
<!-- Formulaire avec les informations de l'employé -->
<!--------------------------------------------------->
<div class="col-md-8 mx-auto mt-5">
    <form id="" data-sb-form-api-token="API_TOKEN" method="POST" action="action.php">
        <!-- Nom input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="nom" type="text" name="nom" value="<?php echo($_SESSION['nom']) ?>" />
            <label for="nom">Nom</label>
        </div>
        <!-- Prenom input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="prenom" type="text" name="prenom" value="<?php echo($_SESSION['prenom']) ?>"/>
            <label for="prenom">Prénom</label>
        </div>
        <!-- Anniversaire input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="anniv" type="date" name="anniv" value="<?php echo($_SESSION['anniv']) ?>" />
            <label for="anniv">Anniversaire</label>
        </div>
        <!-- Adresse input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="address" type="text" name="address" value="<?php echo($_SESSION['address']) ?>" />
            <label for="address">Adresse</label>
        </div>
        <!-- Complément d'adresse input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="complement" type="text" name="complement" value="<?php echo($_SESSION['complement']) ?>" />
            <label for="complement">Complément d'adresse</label>
        </div>
        <!-- Code postal input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="zip" type="text" name="zip" value="<?php echo($_SESSION['zip']) ?>" />
            <label for="zip">Code postal</label>
        </div>
        <!-- Ville input -->
        <div class="form-floating mb-3">
            <input class="form-control" id="ville" type="text" name="ville" value="<?php echo($_SESSION['ville']) ?>" />
            <label for="ville">Ville</label>
        </div>
        <!-- Email input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="email" type="email" name="email" value="<?php echo($_SESSION['mail']) ?>" />
            <label for="email">E-mail</label>
        </div>
        <!-- Téléphone portable input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="phone" type="text" name="port" value="<?php echo($_SESSION['port']) ?>" />
            <label for="phone">Téléphone portable</label>
        </div>
        <!-- Téléphone fixe input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="fixe" type="text" name="fixe" value="<?php echo($_SESSION['fixe']) ?>" />
            <label for="fixe">Téléphone fixe</label>
        </div>
        <!-- Mot de passe input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="mdp" type="password" name="mdp" value="<?php echo($_SESSION['mdp']) ?>" />
            <label for="mdp">Mot de passe</label>
        </div>
        <!-- Confirmation du mot de passe input-->
        <div class="form-floating mb-3">
            <input class="form-control" id="mdpConf" type="password" name="mdpConf" value="<?php echo($_SESSION['mdp']) ?>" />
            <label for="mdpConf">Confirmez le mot de passe</label>
        </div>
        <!-- Submit Button-->
        <button class="btn btn-secondary btn-sm mb-5" id="submitButton" type="submit" name="modificationEmploye">Valider les modifications</button>
    </form>
</div>