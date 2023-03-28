<?php

session_start();

require_once 'bdd.php';

// On vérifie que la personne est bien loguée, que son statut correspond bien à RH et que son compte est actif
// Si une des trois conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****' || $_SESSION['statut'] === 0) {
    header('location:../../connexion.php');
}

require_once 'header_rh.php';

?>

<!----------->
<!-- Titre -->
<!----------->
<h4 class="col-md-6 mx-auto pb-2 border-bottom border-primary  pt-5 mt-5" style="width: fit-content;">Formulaire de modification d'une annonce</h4>

<!------------------------------------------>
<!-- Formulaire de modification d'annonce -->
<!------------------------------------------>
<div class="col-md-6 mx-auto mt-5">
    <form action="action.php" method="post">
        <!-- Nom de l'annonce -->
        <div>
            <label for="nom">Libellé</label>
            <input class="form-control" id="nom" type="text" name="nom" value="<?php echo($_COOKIE['nomEmploi']) ?>"/>
        </div>
        <br>
        <!-- Description de l'annonce -->
        <div>
            <label for="description">Description du poste</label>
        </div>
        <div>
            <textarea name="description" cols="100" rows="10" class="form-control"><?php echo($_COOKIE['descriptionEmploi']) ?></textarea>
        </div>
        <br>
        <!-- Informations complémentaires -->
        <div>
            <label for="obligatoire">Informations complémentaires</label>
        </div>
        <div>
            <textarea name="obligatoire" cols="100" rows="5" class="form-control"><?php echo($_COOKIE['obligationEmploi']) ?></textarea>
        </div>
        <br>
        <!-- Type de contrat -->
        <div>
            <label for="contrat">Type de contrat</label>
            <input type="text" class="form-control" name="contrat" value="<?php echo($_COOKIE['contratEmploi']) ?>">
        </div>
        <br>
        <!-- Durré de tarvail -->
        <div>
            <label for="temps">Durée de travail hebdomadaire</label><br>
            <span><small><i>Exemple (Temps plein, 15 heures hebdomadaires, etc...)</i></small></span>
            <input type="text" class="form-control" name="temps" value="<?php echo($_COOKIE['tempsEmploi']) ?>">
        </div>
        <br>
        <!-- Salaire horaire -->
        <div>
            <label for="temps">Salaire brut de l'heure</label><br>
            <span><small><i>Exemple (Selon profil, 10.27 € de l'heure, etc...)</i></small></span>
            <input type="text" class="form-control" name="salaire" value="<?php echo($_COOKIE['salaireEmploi']) ?>">
        </div>
        <br>
        <!-- Chois du site d'affection de l'annonce -->
        <div>
            <Label>Poste à pourvoir sur le site de :</Label>
            <input type="hidden" name="idSite" value="<?php echo($_COOKIE['idSite']) ?>">
            <input type="text" name="site" class="form-control" value="<?php echo($_COOKIE['nomSite'] .' à '. $_COOKIE['nomVille']) ?>" readonly>
        </div>
        <br>
        <p>L'annonce est :</p>
        <div>
            <?php 
                switch($_COOKIE['statutEmploi']) {
                    case '0':
                        $actif = '';
                        $inactif = 'checked';
                        break;
                    case '1':
                        $actif = 'checked';
                        $inactif = '';
                        break;
                }
            ?>
            <input type="radio" name="statut" value="1" <?php echo($actif) ?>>
            <label for="">Active</label>&emsp;
            <input type="radio" name="statut" value="0" <?php echo($inactif) ?>>
            <label for="">Inactive</label>
        </div>
        <br>
        <!-- Boutons de Validation / Annulation -->
        <div>
            <input type="submit" value="Valider les modifications" name="modificationAnnonce" class="btn btn-primary mb-5">
            <a href="selection_annonce_rh" class="btn btn-secondary mb-5">Annuler</a>
        </div>
    </form>
</div>

