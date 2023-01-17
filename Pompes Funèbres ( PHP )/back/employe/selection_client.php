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
<h4 class="col-md-6 mx-auto pb-2 border-bottom border-primary  pt-5 mt-5" style="width: fit-content;">Veuillez selectionner un client</h4>

<!----------------------------------->
<!-- Menu de selection d'un client -->
<!----------------------------------->
<div class="row col-12">
    <form class="col-md-6 mx-auto mt-5" style="width: fit-content;" action="action.php" method="post">
        <div class="col-md-2 mx-auto" style="width: fit-content;">
            <select name="choixClient" id="" class="form-select">
                <?php
                require_once 'bdd.php';

                $sql = $bdd->query("SELECT id_user, nom, prenom FROM site_user WHERE profil = 0 ORDER BY nom ");
                $sql->execute();
                $result = $sql->fetchAll();

                foreach ($result as $client) :
                ?>
                    <option value="<?php echo ($client['id_user']) ?>"><?php echo ($client['nom'] . ' ' . $client['prenom']) ?></option>
                <?php endforeach; ?>
            </select> 
        </div>
        <!-- Boutons du choix de l'action -->
        <div class="col-md-6 mx-auto mt-5" style="width: fit-content;">
            <button type="submit" name="selectionClient" class="btn btn-secondary btn-sm">Modification du client</button>
            <button type="submit" name="visualiserClient" class="btn btn-primary btn-sm mx-2">Visualisation du client</button>
            <button type="submit" name="selectionDevisClient" class="btn btn-secondary btn-sm">Visualisation du devis client</button>
        </div>
    </form>
</div>