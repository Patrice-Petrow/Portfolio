<?php
require 'bdd.php';
require 'header.php';
?>

<!-------------->
<!-- Masthead -->
<!-------------->
<header class="headertemoignages mb-3 mb-md-5"></header>

<!----------->
<!-- Titre -->
<!----------->
<div class="row gx-4 gx-lg-5 justify-content-center mx-auto">
    <div class="col-lg-8 col-xl-6 text-center">
        <h2>Témoignages</h2>
        <hr class="divider mb-5" />
    </div>
</div>

<!-- Récupération des témoignages liés au site visité -->
<?php
$societe = $donneesSociete['societe_id'];
$sql = "SELECT nom, prenom, civilite, descr, id_temoignage FROM site_temoignage JOIN site_user ON site_user.id_user = site_temoignage.fk_userName 
        AND fk_societe = '$societe' ORDER BY id_temoignage DESC";
$request = $bdd->query($sql);
$temoignages = $request->fetchAll();

// Affichage des témoignages
foreach ($temoignages as $temoignage) :
?>

    <div class="col-11 col-lg-8 mx-auto">
        <span><?php if ($temoignage['civilite'] == '0') {
                    echo ('Mme ' . $temoignage['nom'] . ' ' . $temoignage['prenom']);
                } else {
                    echo ('Mr ' . $temoignage['nom'] . ' ' . $temoignage['prenom']);
                } ?></span>
        <span class="form-control shadow p-3 mb-5 mt-1 bg-body rounded"><?= $temoignage['descr'] ?></span>
    </div>

<?php endforeach; ?>

















<!-- Footer-->
<?php
require 'footer.php';
?>