
<?php
require 'bdd.php';
require 'header.php';
$hote = $_SERVER['HTTP_HOST'];
?>

<!-- Masthead -->
<header class="masthead">
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end">
                <h1 class="text-white font-weight-bold">Pompes Funèbres</h1>
                <h1 class="text-white font-weight-bold"><?= $donneesSociete['nom']; ?></h1>
                <hr class="divider" />
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-75 mb-5">Vous accompagne dans la prise en charge du défunt, dans vos démarches pour protéger vos proches. Ou pour de simple renseignements.</p>
                <p class="text-white-75 mb-5">Nous contacter 24H/24 et 7J/7 :</p>
                <a class="btn btn-primary btn-xl" href="tel: <?= $donneesSociete['tel'] ?>"><i class="bi-phone fs-2 mb-3 "></i> <?= $donneesSociete['tel'] ?></a>
            </div>
        </div>
    </div>
</header>

<section class="m-5">
    <h2>MENTIONS LEGALES ET POLITIQUE DE CONFIDENTIALITÉS</h2>
    <h6>Merci de lire attentivement les présentes modalités d'utilisation du présent site avant de le parcourir. En vous connectant sur ce site, vous acceptez sans réserve les présentes modalités.</h6>
    <br>
    <h4>Editeur du site</h4>
    <p>Le site <?= $hote; ?> est édité par la société de Pompes Funèbres <?= $donneesSociete['nom']; ?>.</p>
    <p>La société <?= $donneesSociete['nom']; ?> a pour forme juridique :
        <?php
        if ($donneesSociete['forme_juridique'] == 'S.A.S.') {
            $forme_juridique = 'Société par Actions Simplifiées.';
        } elseif ($donneesSociete['forme_juridique'] == 'S.A.S.U.') {
            $forme_juridique = 'Société par Actions Simplifiées Unipersonnelle.';
        } elseif ($donneesSociete['forme_juridique'] == 'S.A.R.L.') {
            $forme_juridique = 'Société à Responsabilité Limité.';
        };
        echo $forme_juridique;
        ?>
    </p>
    <p>Ayant un capital social de : <?= $donneesSociete['capital']; ?> euros.</p>
    <p>Et immatriculé au registre du commerce et des sociétés de <?= $donneesSociete['ville_enregistrement']; ?>, sous le numéro SIREN : <?= $donneesSociete['siren']; ?></p>
    <p>Dont le siège social se situe : <?= $donneesSociete['adress'] . ', ' . $donneesSociete['zip'] . ' ' . $donneesSociete['ville']; ?></p>
    <p>Son numéro de T.V.A. intracommunautaire est : <?= $donneesSociete['intracomm']; ?></p>
    <br>
    <h4>Hébergement</h4>
    <p>L'hébergement du site est réalisé au sein de la société IONOS</p>
    <p>situé au 7 place de la Gare, 57200 Sarreguemines. FRANCE.</p>
<br>
<h4>Conditions d'utilisation</h4>
<p>Le site accessible par l'url suivant : <?= $hote; ?> est exploité dans le respect de la législation française. L'utilisation de ce site est régie par les présentes conditions générales. En utilisant le site, vous reconnaissez avoir pris connaissance de ces conditions et les avoir acceptées. Celles-ci pourront être modifiées à tout moment et sans préavis par la société <?= $donneesSociete['nom'].' '.$donneesSociete['forme_juridique']; ?> laquelle ne saurait être tenu pour responsable en aucune manière d’une mauvaise utilisation du service.</p>


</section>


<!-- Footer-->
<?php
require 'footer.php';
?>

