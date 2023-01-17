<?php

require 'bdd.php';

session_start();
ob_start();

// On vérifie que la personne est bien loguée et que son statut correspond bien à Administrateur
// Si une des deux conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****') {
    header('location:../../connexion.php');
}

// Gestion de la déconnexion
if (isset($_POST['deconnexionAdmin'])) {
    session_destroy();

    header('location:../../index.php');
}

// Formulaire de selection de l'employé
if (isset($_POST['selectionEmploye'])) {

    $sql = $bdd->prepare("SELECT * FROM site_user WHERE id_user=?");
    $sql->execute(array($_POST['choixEmploye']));
    $data = $sql->fetch();

    setcookie('nom_employe', $data['nom']);
    setcookie('prenom_employe', $data['prenom']);
    setcookie('anniv_employe', $data['anniv']);
    setcookie('address_employe', $data['address']);
    setcookie('complement_employe', $data['complement']);
    setcookie('zip_employe', $data['zip']);
    setcookie('ville_employe', $data['ville']);
    setcookie('mail_employe', $data['mail']);
    setcookie('port_employe', $data['port']);
    setcookie('fixe_employe', $data['fixe']);
    setcookie('mdp_employe', $data['mdp']);
    setcookie('statut_employe', $data['statut']);

    header('location:gestion_employe.php');
}

// Gestion de la modification des informations d'un employé 
if (isset($_POST['validerEmploye'])) {

    if (
        strlen($_POST['nom']) <= 30 && strlen($_POST['prenom']) <= 30 && isset($_POST['anniv']) && strlen($_POST['address']) <= 40
        && strlen($_POST['complement']) <= 40 && strlen($_POST['zip']) === 5 && strlen($_POST['ville']) <= 30
    ) {

        // On récupère et on sécurise le mot de passe saisi et sa confirmation
        $mdp = htmlentities($_POST['mdp'], ENT_QUOTES, 'UTF-8');
        $mdpConf = htmlentities($_POST['mdpConf'], ENT_QUOTES, 'UTF-8');

        // On contrôle que le mot de passe et sa confirmation sont identiques
        // Si c'est le cas on traite le formulaire, sinon redirection vers la page d'accueil
        if ($mdp === $mdpConf) {

            // On comprae le mot de passe dans le champ du formulaire et celui en bdd
            if ($mdp === $_COOKIE['mdp_employe']) {

                // On sécurise les données reçues du formulaire
                $nom = htmlentities($_POST['nom'], ENT_QUOTES, 'UTF-8');
                $prenom = htmlentities($_POST['prenom'], ENT_QUOTES, 'UTF-8');
                $anniv = htmlentities($_POST['anniv']);
                $address = htmlentities($_POST['address'], ENT_QUOTES, 'UTF-8');
                $complement = htmlentities($_POST['complement'], ENT_QUOTES, 'UTF-8');
                $zip = htmlentities($_POST['zip'], ENT_QUOTES, 'UTF-8');
                $ville = htmlentities($_POST['ville'], ENT_QUOTES, 'UTF-8');
                $mail = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
                $port = htmlentities($_POST['port'], ENT_QUOTES, 'UTF-8');
                $fixe = htmlentities($_POST['fixe'], ENT_QUOTES, 'UTF-8');
                $statut = $_POST['actif'];

                // Injection des données dans la BDD sans le mot de passe
                $update = $bdd->prepare("UPDATE site_user SET 
                    nom='$nom',
                    prenom='$prenom',
                    anniv='$anniv',
                    address='$address',
                    complement='$complement',
                    zip='$zip',
                    ville='$ville',
                    mail='$mail',
                    port='$port',
                    fixe='$fixe',
                    statut='$statut' WHERE mail=? ");
                $update->execute(array($_COOKIE['mail_employe']));

                // Actualisation des données de session de l'employé
                setcookie('nom_employe', $nom);
                setcookie('prenom_employe', $prenom);
                setcookie('anniv_employe', $anniv);
                setcookie('address_employe', $address);
                setcookie('complement_employe', $complement);
                setcookie('zip_employe', $zip);
                setcookie('ville_employe', $ville);
                setcookie('mail_employe', $mail);
                setcookie('port_employe', $port);
                setcookie('fixe_employe', $fixe);
                setcookie('statut_employe', $statut);
            
                // On redirige vers la page de gestion de l'employé pour la rafraichir
                header('location:gestion_employe.php?mdp=non');
            } else {
                // On sécurise les données reçues du formulaire
                $mdp = hash('sha256', $mdp);
                $nom = htmlentities($_POST['nom'], ENT_QUOTES, 'UTF-8');
                $prenom = htmlentities($_POST['prenom'], ENT_QUOTES, 'UTF-8');
                $anniv = htmlentities($_POST['anniv']);
                $address = htmlentities($_POST['address'], ENT_QUOTES, 'UTF-8');
                $complement = htmlentities($_POST['complement'], ENT_QUOTES, 'UTF-8');
                $zip = htmlentities($_POST['zip'], ENT_QUOTES, 'UTF-8');
                $ville = htmlentities($_POST['ville'], ENT_QUOTES, 'UTF-8');
                $mail = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
                $port = htmlentities($_POST['port'], ENT_QUOTES, 'UTF-8');
                $fixe = htmlentities($_POST['fixe'], ENT_QUOTES, 'UTF-8');
                $statut = $_POST['actif'];

                // Injection des données dans la BDD avec le mot de passe
                $update = $bdd->prepare("UPDATE site_user SET 
                    nom='$nom',
                    prenom='$prenom',
                    anniv='$anniv',
                    address='$address',
                    complement='$complement',
                    zip='$zip',
                    ville='$ville',
                    mail='$mail',
                    port='$port',   
                    fixe='$fixe',
                    mdp='$mdp',
                    statut='$statut' WHERE mail=? ");
                $update->execute(array($_COOKIE['mail_employe']));

                // Actualisation des données de session de l'employé
                setcookie('nom_employe', $data['nom']);
                setcookie('prenom_employe', $data['prenom']);
                setcookie('anniv_employe', $data['anniv']);
                setcookie('address_employe', $data['address']);
                setcookie('complement_employe', $data['complement']);
                setcookie('zip_employe', $data['zip']);
                setcookie('ville_employe', $data['ville']);
                setcookie('mail_employe', $data['mail']);
                setcookie('port_employe', $data['port']);
                setcookie('fixe_employe', $data['fixe']);
                setcookie('mdp_employe', $data['mdp']);
                setcookie('statut_employe', $data['statut']);
            
                // On redirige vers la page de gestion de l'employé pour la rafraichir
                header('location:gestion_employe.php?mdp=oui');
            }
        }
    }
}

// Suppression d'un compte client
if(isset($_POST['selectionClient'])) {

    $mdpSuppression = $_POST['mdpSuppression'];
    $mdpSuppression = hash('sha256', $mdpSuppression);

    $sql = $bdd->prepare("SELECT mdp FROM site_user WHERE id_user=?");
    $sql->execute(array($_SESSION['id_user']));
    $mdpBdd = $sql->fetch();

    if($mdpSuppression === $mdpBdd['mdp']) {

        $delete = $bdd->prepare("DELETE FROM site_user WHERE id_user=?");
        $delete->execute(array($_POST['choixClient']));
    
        header('location:index_administrateur.php?sup=ok');
    } else header('location:index_administrateur.php?sup=nok');
}

// Selection du site pour affiche des avis
if (isset($_POST['siteAvis'])) {
    $choix = $_POST['choixSiteAvis'];

    $sql = $bdd->prepare("SELECT * FROM site_temoignage WHERE fk_societe = ?");
    $sql->execute(array($choix));
    $data = $sql->fetch();

    if (empty($data)) {
        setcookie('affichage', 'none');
        setcookie('noResult', 'inline');

        header('location:gestion_avis.php');
    } else {

        $sql = $bdd->prepare("SELECT * FROM societe_pf WHERE societe_id = ?");
        $sql->execute(array($choix));
        $data = $sql->fetch();

        setcookie('idSiteAvis', $data['societe_id']);
        setcookie('nomSite', $data['nom']);
        setcookie('nomVille', $data['ville']);
        setcookie('affichage', 'inline');
        setcookie('noResult', 'none');

        header('location:gestion_avis.php');
    }
}

// Suppression d'un avis supprimerAvis
if (isset($_POST['supprimerAvis'])) {

    $delete = $bdd->prepare("DELETE FROM site_temoignage WHERE id_temoignage = ?");
    $delete->execute(array($_POST['id_temoignage']));

    header('location:gestion_avis.php');
}

ob_end_flush();
?>
