<?php

session_start();

// On vérifie que la personne est bien loguée et que son statut correspond bien à Administrateur
// Si une des deux conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] !== 1 || $_SESSION['profil'] !== '*****' ) {
    header('location:../../connexion.php');
} 

require 'header_administrateur.php';

?>

<!----------->
<!-- Titre -->
<!----------->
<h4 class="col-md-6 mx-auto pb-2 border-bottom border-primary pt-5 my-5 mt-5" style="width: fit-content;">Suppression d'un compte client</h4>

<!-------------------------------------------------->
<!-- Formulaire de suppression d'un compte client -->
<!-------------------------------------------------->
<div class="col-md-6 mx-auto" style="width: fit-content;">
    <span class="fontlabel">Choisir le nom du client</span>
    <form class="mt-2" action="action.php" method="POST">
        <select name="choixClient" id="" class="form-select">
            <?php
                require_once 'bdd.php';

                $sql = $bdd->query("SELECT id_user, nom, prenom FROM site_user WHERE profil = *****  ORDER BY nom ");
                $sql->execute(array());
                $result = $sql->fetchAll();

                foreach($result as $client):
            ?>
            <option value="<?php echo($client['id_user']) ?>"><?php echo($client['nom'] .' '. $client['prenom']) ?></option>
            <?php endforeach; ?>
        </select>
        <div class="mt-3">
            <br>
            <label for="mdpSuppression">Veuillez saisir votre mot de passe</label>&emsp;
            <input type="password" name="mdpSuppression" id="">&emsp;
            <button type="submit" name="selectionClient" class="btn btn-danger btn-sm">Supprimer le compte</button>
        </div>
    </form>
</div>