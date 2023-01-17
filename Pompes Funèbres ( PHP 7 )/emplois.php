<?php
require_once 'bdd.php';
require_once 'header.php';

$sql = $bdd->prepare("SELECT * FROM site_emplois WHERE fk_societe = ? AND statut = 1");
$sql->execute(array($donneesSociete['societe_id']));
$data = $sql->fetchAll();

?>

<!------------->
<!-- Masthead-->
<!------------->
<header class="headeremplois mb-3 mb-md-5"></header>

<!----------->
<!-- Titre -->
<!----------->
<div class="row gx-4 gx-lg-5 justify-content-center mx-auto">
  <div class="col-lg-8 col-xl-6 text-center">
    <h2>Nos différentes offres d'emplois </h2>
    <hr class="divider mb-5" />
  </div>
</div>

<!---------------------------------------------------------->
<!-- Affichage de la liste des emplois sous forme de card -->
<!---------------------------------------------------------->
<section class="col-11 row justify-content-center mx-auto">
  <?php foreach ($data as $job) : ?>
    <div class="card col-md-5 m-3 px-0">
      <h4 class="card-header"><?php echo (utf8_encode($job['nom_emploi'])) ?></h4>
      <div class="card-body">
        <h5 class="card-title border-bottom border-primary pb-2" style="width: fit-content;">Description</h5>
        <div class="mb-4">
          <div class="jobdescription"><?php echo (utf8_encode($job['description_emploi'])) ?></div>
          <!-- Bouton d'activation de la modal si la description est trop grande -->
          <?php
          if (strlen(utf8_encode($job['description_emploi'])) > 490) {
            $aff_button = 'inline';
          } else {
            $aff_button = 'none';
          }
          ?>
          <button type="button" class="btn btn-secondary btn-sm my-2 me-2 jobbutton" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display: <?php echo ($aff_button) ?>;">
            Voir la description complète</button>
        </div>
        <h5 class="card-title border-bottom border-primary pb-2" style="width: fit-content;">Informations complémentaires</h5>
        <p class="card-text">Type de contrat : <?php echo ($job['contrat']) ?></p>
        <p class="card-text">Durée de travail hebdomadaire : <?php echo ($job['temps']) ?> heures</p>
        <p class="card-text">Salaire : <?php echo ($job['salaire_heure']) ?> Euros de l'heure</p>
        <p class="card-text"><?php echo ($job['obligation_emploi']) ?></p>
      </div>
      <form action="annonce.php" method="post">
        <input type="hidden" name="id_emploi" value="<?php echo ($job['id_emploi']) ?>">
        <input type="submit" value="Postuler" name="postuler" class="btn btn-primary m-3">
      </form>
    </div>
    <br>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?php echo (utf8_encode($job['nom_emploi'])) ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="card-body">
              <h5 class="card-title">Description</h5>
              <div class="mb-3">
                <div class="jobmodal"><?php echo (utf8_encode($job['description_emploi'])) ?></div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</section>

<?php
require_once 'footer.php';
?>