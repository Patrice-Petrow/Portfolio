<?php 

require_once 'bdd.php';
require 'header.php';
?>

<!-------------->
<!-- Masthead -->
<!-------------->
<header class="headeremplois mb-5"></header>

<!------------->
<!-- En-tête -->
<!------------->
<div class="row gx-4 gx-lg-5 justify-content-center mx-auto">
    <div class="col-lg-8 col-xl-6 text-center">
        <h2>Formulaire de candidature spontanée</h2>
        <hr class="divider mb-5" />
    </div>
</div>

<!---------------------------------------->
<!-- Formulaire de candidature spontanée-->
<!---------------------------------------->
<section>
    <div class="col-11 col-lg-6 mx-auto" id="formulaireSpontanee">
        <div class="col-md-8 mx-auto">
            <form action="action.php" method="post" enctype="multipart/form-data">
                <!-- Nom -->
                <input class="form-control mb-3" type="text" name="nom" id="" placeholder="Nom">
                <!-- Prénom -->
                <input class="form-control mb-2" type="text" name="prenom" id="" placeholder="Prénom">&emsp;
                <!-- Nom de la société -->
                <h6 class="col-md-5 mb-3" style="width: fit-content;">Vous postulez pour le site de :</h5>
                <input type="text" name="choixSiteSpontanee" class="form-control mb-4" value="<?php echo ($donneesSociete['nom'] . ' - ' . $donneesSociete['ville']) ?>" readonly>               
                <!-- Upload du CV -->
                <div class="mt-4">
                    <label class="fontlabel" for="cv">CV (au format doc ou pdf)</label><br>
                    <span class="fontlabel" style="font-size: small;"><i>2 Mo maximum</i></span><br>
                    <input class="form-control mt-2" type="file" name="cv" id="" accept=".doc, .pdf">
                </div>
                <!-- Upload de la lettre de motivation -->
                <div class="mt-4">
                    <label class="fontlabel" for="cv">Lettre de motivation (au format doc ou pdf)</label><br>
                    <span class="fontlabel" style="font-size: small;"><i>2 Mo maximum</i></span><br>
                    <input class="form-control mt-2" type="file" name="lm" id="" accept=".doc, .pdf">
                </div>
                <!-- Bouton -->
                <input type="submit" class="btn btn-primary mt-4" value="Envoyer" name="candidatureSpontanee">
            </form>
        </div>
    </div>
</section>

<?php
require 'footer.php';
?>