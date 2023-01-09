<?php

session_start();

// On vérifie que la personne est bien loguée et que son statut correspond bien à Administrateur
// Si une des deux conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] !== 1 || $_SESSION['profil'] !== '*****') {
    header('location:../' . $_SESSION['site'] . '/connexion.php');
}

setcookie('affichage', 'none');
setcookie('noResult', 'none');

require 'header_administrateur.php';

?>

<!----------------------------------------------------------------------------->
<!-- Affichage des différents liens avec screenshot des pages de destination -->
<!----------------------------------------------------------------------------->
<br>
<div class="row row-cols-1 row-cols-md-2 g-5 mt-5 mx-auto">
    <!-- Gestion employés -->
    <div class="col">
        <div class="card">
            <a href="selection_employe.php" class="nav-link liensfooter">
                <div class="card-body">
                    <h5 class="card-title border-bottom border-primary py-1">Gérer le compte d'un employé</h5>
                </div>
                <img src="../../assets/img/profils/Administateur-1.jpg" class="card-img-top border border-gray" alt="Photo de la page de selection d'un employé">
            </a>
        </div>
    </div>
    <!-- Suppression d'un compte client -->
    <div class="col">
        <div class="card">
            <a href="suppression_client.php" class="nav-link liensfooter">
                <div class="card-body">
                    <h5 class="card-title border-bottom border-primary py-1">Supprimer un compte client</h5>
                </div>
                <img src="../../assets/img/profils/Administateur-2.jpg" class="card-img-top border border-gray" alt="Photo de la page de suppression d'un compte client">
            </a>
        </div>
    </div>
    <!-- Gestion des avis client -->
    <div class="col">
        <div class="card">
            <a href="gestion_avis.php" class="nav-link liensfooter">
                <div class="card-body">
                    <h5 class="card-title border-bottom border-primary py-1">Gerez les avis client</h5>
                </div>
                <img src="../../assets/img/profils/Administateur-3.jpg" class="card-img-top border border-gray" alt="Photo de la page de gestion des avis client">
            </a>
        </div>
    </div>
</div>