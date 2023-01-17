<?php

session_start();

// On vérifie que la personne est bien loguée et que son statut correspond bien à Client
// Si une des deux conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****' ) {
    header('location:../../connexion.php');
} 

require 'header_client.php';

?>

<!----------------------------------------------------------------------------->
<!-- Affichage des différents liens avec screenshot des pages de destination -->
<!----------------------------------------------------------------------------->
<br>
<div class="row row-cols-1 row-cols-md-2 g-5 mt-5 mx-auto">
    <!-- Gestion des informations du compte -->
    <div class="col">
        <div class="card">
            <a href="compte_client.php" class="nav-link liensfooter">
                <div class="card-body">
                    <h5 class="card-title border-bottom border-primary py-1">Gérez les informations de votre compte</h5>
                </div>
                <img src="../../assets/img/profils/Client-1.jpg" class="card-img-top border border-gray" alt="Photo de la page de gestion de compte">
            </a>
        </div>
    </div>
    <!-- Suppression du compte -->
    <div class="col">
        <div class="card">
            <a href="suppression_compte.php" class="nav-link liensfooter">
                <div class="card-body">
                    <h5 class="card-title border-bottom border-primary py-1">Supprimez votre compte</h5>
                </div>
                <img src="../../assets/img/profils/Client-2.jpg" class="card-img-top border border-gray" alt="Photo de la page de suppression de compte">
            </a>
        </div>
    </div>
    <!-- Visualisation du devis en cours -->
    <div class="col">
        <div class="card">
            <a href="liste_devis.php" class="nav-link liensfooter">
                <div class="card-body">
                    <h5 class="card-title border-bottom border-primary py-1">Visualisez votre devis en cours</h5>
                </div>
                <img src="../../assets/img/profils/Client-3.jpg" class="card-img-top border border-gray" alt="Photo de la page de visualisation du devis en cours">
            </a>
        </div>
    </div>
    <!-- Création d'un devis -->
    <div class="col">
        <div class="card">
            <a href="devis_client.php" class="nav-link liensfooter">
                <div class="card-body">
                    <h5 class="card-title border-bottom border-primary py-1">Faites une demande de devis</h5>
                </div>
                <img src="../../assets/img/profils/Client-4.jpg" class="card-img-top border border-gray" alt="Photo de la page de création de devis">
            </a>
        </div>
    </div>
    <!-- Enregistrement d'un témoignage -->
    <div class="col">
        <div class="card">
            <a href="temoignage_client.php" class="nav-link liensfooter">
                <div class="card-body">
                    <h5 class="card-title border-bottom border-primary py-1">Pour déposer un témoignage</h5>
                </div>
                <img src="../../assets/img/profils/Client-5.jpg" class="card-img-top border border-gray" alt="Photo de la page d'enregistrement d'un témoignage">
            </a>
        </div>
    </div>
</div>
