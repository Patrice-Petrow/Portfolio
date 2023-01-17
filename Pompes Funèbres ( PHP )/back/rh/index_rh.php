<?php

session_start();

// On vérifie que la personne est bien loguée, que son statut correspond bien à RH et que son compte est actif
// Si une des trois conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****' || $_SESSION['statut'] === 0) {
    header('location:../../connexion.php');
}

setcookie('affichage', 'none');
setcookie('noResult', 'none');

require 'header_rh.php';

?>

<br>

<!----------------------------------------------------------------------------->
<!-- Affichage des différents liens avec screenshot des pages de destination -->
<!----------------------------------------------------------------------------->
<div class="row row-cols-1 row-cols-md-2 g-5 mt-5 mx-auto">
    <!-- Gestion des annonces -->
    <div class="col">
        <div class="card">
            <a href="selection_annonce_rh.php" class="nav-link liensfooter">
                <div class="card-body">
                    <h5 class="card-title border-bottom border-primary py-1">Gérer les annonces</h5>
                </div>
                <img src="../../assets/img/profils/RH-1.jpg" class="card-img-top border border-gray" alt="Photo de la page de gestion des annonces">
            </a>
        </div>
    </div>
    <!-- Création d'annonce -->
    <div class="col">
        <div class="card">
            <a href="creation_annonce_rh.php" class="nav-link liensfooter">
                <div class="card-body">
                    <h5 class="card-title border-bottom border-primary py-1">Créer une nouvelle annonce</h5>
                </div>
                <img src="../../assets/img/profils/RH-2.jpg" class="card-img-top border border-gray" alt="Photo de la page de création d'une annonce">
            </a>
        </div>
    </div>
    <!-- Candidatures -->
    <div class="col">
        <div class="card">
            <a href="candidature_rh.php" class="nav-link liensfooter">
                <div class="card-body">
                    <h5 class="card-title border-bottom border-primary py-1">Gérer les candidatures</h5>
                </div>
                <img src="../../assets/img/profils/RH-3.jpg" class="card-img-top border border-gray" alt="Photo de la page de gestion des candidatures">
            </a>
        </div>
    </div>
</div>