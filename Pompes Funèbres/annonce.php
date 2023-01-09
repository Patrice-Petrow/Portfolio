<?php
require_once 'bdd.php';
require_once 'header.php';

$sql = $bdd->prepare("SELECT * FROM site_emplois WHERE id_emploi=?");
$sql->execute(array($_POST['id_emploi']));
$data = $sql->fetchAll();

?>

<!-------------->
<!-- Masthead -->
<!-------------->
<header class="headeremplois mb-3"></header>

<!----------->
<!-- Titre -->
<!----------->
<div class="row gx-4 gx-lg-5 justify-content-center mx-auto">
    <div class="col-lg-8 col-xl-6 text-center">
        <h2>Formulaire de candidature pour l'annonce :</h2>
        <hr class="divider mb-5" />
    </div>
</div>

<!---------------------------->
<!-- Affichage de l'annonce -->
<!---------------------------->
<?php foreach ($data as $annonce) : ?>
    <div class="card col-11 col-lg-8 mx-auto">
        <h4 class="card-header header-bg-primary"><?php echo (utf8_encode($annonce['nom_emploi'])) ?></h4>
        <div class="card-body">
            <h5 class="card-title border-bottom border-primary pb-2" style="width: fit-content;">Description</h5>
            <p class="card-text jobmodal"><?php echo (utf8_encode($annonce['description_emploi'])) ?></p><br>
            <h5 class="card-title border-bottom border-primary pb-2" style="width: fit-content;">Informations complémentaires</h5>
            <p class="card-text">Type de contrat : <?php echo ($annonce['contrat']) ?>.</p>
            <p class="card-text">Durée de travail hebdomadaire : <?php echo ($annonce['temps']) ?> heures.</p>
            <p class="card-text">Salaire : <?php echo ($annonce['salaire_heure']) ?> Euros de l'heure.</p>
            <p class="card-text">Obligations : <?php echo (utf8_encode($annonce['obligation_emploi'])) ?>.</p>
            <p class="card-text"></p>
            <a href="emplois.php" type="button" class="btn btn-secondary mt-3">Retour à la liste des offres</a>
        </div>
    </div>

<!------------------------------->
<!-- Formulaire de candidature -->
<!------------------------------->
    <div class="col-11 col-lg-8 mx-auto" id="formulaireSpontanee">
        <h4 class="mt-5 border-bottom border-primary pb-2" style="width: fit-content;">Si vous souhaitez postuler à cette annonce, merci de completer le formulaire çi-dessous</h4>
        <div class="col-md-4 ms-0 mt-3">
            <form action="action.php" method="post" enctype="multipart/form-data">
                <!-- Nom -->
                <input class="form-control mb-3" type="text" name="nom" id="" placeholder="Nom">
                <!-- Prénom -->
                <input class="form-control mb-2" type="text" name="prenom" id="" placeholder="Prénom">
                <!-- Upload du CV -->
                <div class="mt-3">
                    <label class="fontlabel" for="cv">CV (au format doc ou pdf)</label><br>
                    <span class="fontlabel" style="font-size: small;"><i>2 Mo maximum</i></span>
                    <input class="form-control mt-2" type="file" name="cv" id="" accept=".doc, .pdf">
                </div>
                <!-- Bouton -->
                <input type="hidden" name="nom_emploi" value="<?php echo (utf8_encode($annonce['nom_emploi'])) ?>">
                <input type="submit" class="btn btn-primary mt-3" value="Envoyer" name="envoyerCandidature">
            </form>
        </div>
    </div>

<?php
endforeach;
require_once 'footer.php';
?>