<?php

session_start();

// On vérifie que la personne est bien loguée et que son statut correspond bien à Client
// Si une des deux conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****') {
    header('location:../../connexion.php');
}

require 'header_client.php';

?>

<!----------->
<!-- Titre -->
<!----------->
<h4 class="col-md-6 mx-auto pb-2 border-bottom border-primary  pt-5 my-5" style="width: fit-content;">Suppresion du compte</h4>

<!----------------------------------------->
<!-- Formulirae de suppression de compte -->
<!----------------------------------------->
<div class="col-10 mx-auto" style="width: fit-content;">
    <form action="action.php" method="post" class="">
        <div>
            <label for="mdpSuppression">Veuillez saisir votre mot de passe</label>
            <input type="password" name="mdpSuppression" class="ms-3">
            <button type="submit" name="suppressionCompte" class="btn btn-danger btn-sm ms-3">Supprimer le compte</button>
        </div>
    </form>
    <br>
    <p>Après la suppression de votre compte vous serez redirigé vers l'accueil du site.</p>
</div>