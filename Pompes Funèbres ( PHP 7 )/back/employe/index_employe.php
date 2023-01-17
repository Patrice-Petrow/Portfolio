<?php

session_start();

// On vérifie que la personne est bien loguée et que son statut correspond bien à Employé
// Si une des deux conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****' || $_SESSION['statut'] === 0) {
    header('location:../../connexion.php');
} 

require_once 'header_employe.php';

?>

<!----------------------------------------------------------------------------->
<!-- Affichage des différents liens avec screenshot des pages de destination -->
<!----------------------------------------------------------------------------->
<br>
<div class="row row-cols-1 row-cols-md-2 g-5 mt-5 mx-auto">
    <!-- Gestion du compte de l'employé -->
    <div class="col">
        <div class="card">
            <a href="compte_employe.php" class="nav-link liensfooter">
                <div class="card-body">
                    <h5 class="card-title border-bottom border-primary py-1">Gerer les informations de votre compte</h5>
                </div>
                <img src="../../assets/img/profils/Employe-1.jpg" class="card-img-top border border-gray" alt="Photo de la page de gestion de compte">
            </a>
        </div>
    </div>
    <!-- Gestion d'un compte client -->
    <div class="col">
        <div class="card">
            <a href="selection_client.php" class="nav-link liensfooter">
                <div class="card-body">
                    <h5 class="card-title border-bottom border-primary py-1">Gérer un compte client</h5>
                </div>
                <img src="../../assets/img/profils/Employe-2.jpg" class="card-img-top border border-gray" alt="Photo de la page de gestion d'un compte client">
            </a>
        </div>
    </div>
</div>