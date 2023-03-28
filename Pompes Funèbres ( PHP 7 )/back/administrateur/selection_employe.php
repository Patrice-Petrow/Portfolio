<?php

session_start();

// On vérifie que la personne est bien loguée et que son statut correspond bien à Administrateur
// Si une des deux conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] !== 1 || $_SESSION['profil'] !== '*****') {
    header('location:../../connexion.php');
}

require 'header_administrateur.php';

?>

<!----------->
<!-- Titre -->
<!----------->
<h4 class="col-md-6 mx-auto pb-2 border-bottom border-primary pt-5 my-5" style="width: fit-content;">Choisir le nom de l'employé</h4>

<!---------------------------------------------->
<!-- Menu déroulant de selection d'un employé -->
<!---------------------------------------------->
<div>
    <div class="col-md-6 mx-auto" style="width: fit-content;">
        <form action="action.php" method="POST">
            <select name="choixEmploye">
                <?php
                require_once 'bdd.php';

                $sql = $bdd->query("SELECT id_user, nom, prenom FROM site_user WHERE profil = ***** ORDER BY nom ");
                $sql->execute(array());
                $result = $sql->fetchAll();

                foreach ($result as $employe) :
                ?>
                    <option value="<?php echo ($employe['id_user']) ?>"><?php echo ($employe['nom'] . ' ' . $employe['prenom']) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="selectionEmploye" class="btn btn-secondary btn-sm ms-3">Valider</button>
        </form>
    </div>
</div>