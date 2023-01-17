<?php

session_start();
ob_start();

// On vérifie que la personne est bien loguée et que son statut correspond bien à Employé
// Si une des deux conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****' || $_SESSION['statut'] === 0) {
    header('location:../../connexion.php');
} 

require 'bdd.php';

// Gestion de la déconnexion
if(isset($_POST['deconnexionEmploye'])) {
    session_destroy();

    header('location:../../index.php');
}

// Gestion de la modification des informations d'un employé 
if (isset($_POST['modificationEmploye'])) {

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

            // On compare le mot de passe dans le champ du formulaire et celui en bdd
            if ($mdp === $_SESSION['mdp']) {

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
                    fixe='$fixe' WHERE mail=? ");
                $update->execute(array($_SESSION['mail']));

                // Actualisation des données de session de l'employé
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['anniv'] = $anniv;
                $_SESSION['address'] = $address;
                $_SESSION['complement'] = $complement;
                $_SESSION['zip'] = $zip;
                $_SESSION['ville'] = $ville;
                $_SESSION['mail'] = $mail;
                $_SESSION['port'] = $port;
                $_SESSION['fixe'] = $fixe;

                // On redirige vers la page de gestion de l'employé pour la rafraichir
                header('location:index_employe.php?mdp=non');
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
                    mdp='$mdp' WHERE mail=? ");
                $update->execute(array($_SESSION['mail']));

                // Actualisation des données de session de l'employé
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['anniv'] = $anniv;
                $_SESSION['address'] = $address;
                $_SESSION['complement'] = $complement;
                $_SESSION['zip'] = $zip;
                $_SESSION['ville'] = $ville;
                $_SESSION['mail'] = $mail;
                $_SESSION['port'] = $port;
                $_SESSION['fixe'] = $fixe;
                $_SESSION['mdp'] = $mdp;

                // On redirige vers la page de gestion de l'employé pour la rafraichir
                header('location:index_employe.php?mdp=oui');
            }
        }
    }
}

// Formulaire de selection du client pour modification
if (isset($_POST['selectionClient'])) {

    $sql = $bdd->prepare("SELECT * FROM site_user WHERE id_user=?");
    $sql->execute(array($_POST['choixClient']));
    $data = $sql->fetch();

    setcookie('nom_client', $data['nom']);
    setcookie('prenom_client', $data['prenom']);
    setcookie('anniv_client', $data['anniv']);
    setcookie('address_client', $data['address']);
    setcookie('complement_client', $data['complement']);
    setcookie('zip_client', $data['zip']);
    setcookie('ville_client', $data['ville']);
    setcookie('mail_client', $data['mail']);
    setcookie('port_client', $data['port']);
    setcookie('fixe_client', $data['fixe']);
    setcookie('mdp_client', $data['mdp']);

    header('location:modification_client.php');
}

// Formulaire de selection du client pour visualisation
if (isset($_POST['visualiserClient'])) {

    $sql = $bdd->prepare("SELECT * FROM site_user WHERE id_user=?");
    $sql->execute(array($_POST['choixClient']));
    $data = $sql->fetch();

    setcookie('nom_client', $data['nom']);
    setcookie('prenom_client', $data['prenom']);
    setcookie('anniv_client', $data['anniv']);
    setcookie('address_client', $data['address']);
    setcookie('complement_client', $data['complement']);
    setcookie('zip_client', $data['zip']);
    setcookie('ville_client', $data['ville']);
    setcookie('mail_client', $data['mail']);
    setcookie('port_client', $data['port']);
    setcookie('fixe_client', $data['fixe']);
    setcookie('mdp_client', $data['mdp']);

    header('location:visualisation_client.php');
}

// Formulaire de selection du client pour vissualisation de son devis
if (isset($_POST['selectionDevisClient'])) {

    $sql = $bdd->prepare("SELECT * FROM site_user WHERE id_user=?");
    $sql->execute(array($_POST['choixClient']));
    $data = $sql->fetch();

    setcookie('id', $data['id_user']);
    setcookie('civilite_client', $data['civilite']);
    setcookie('nom_client', $data['nom']);
    setcookie('prenom_client', $data['prenom']);
    setcookie('mail_client', $data['mail']);
    setcookie('port_client', $data['port']);
    setcookie('urgent', $data['fk_urgent']);

    header('location:visualisation_devis_client.php');
}


// Gestion de la modification des informations d'un client par un employé
if (isset($_POST['validerClient'])) {

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

            // On compare le mot de passe dans le champ du formulaire et celui en bdd
            // Si ils sont identiques, on met à jour la bdd sans le mot de passe
            if ($mdp === $_COOKIE['mdp_client']) {

                // On sécurise les données reçues du formulaire
                $nom = htmlentities($_POST['nom'], ENT_QUOTES, 'UTF-8');
                $prenom = htmlentities($_POST['prenom'], ENT_QUOTES, 'UTF-8');
                $anniv = htmlentities($_POST['anniv']);
                $address = htmlentities($_POST['address'], ENT_QUOTES, 'UTF-8');
                $complement = htmlentities($_POST['complement'], ENT_QUOTES, 'UTF-8');
                $zip = htmlentities($_POST['zip'], ENT_QUOTES, 'UTF-8');
                $ville = htmlentities($_POST['ville'], ENT_QUOTES, 'UTF-8');
                $mail = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
                $port = $_POST['port'];
                $fixe = $_POST['fixe'];

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
                    fixe='$fixe' WHERE mail = ? ");
                $update->execute(array($_COOKIE['mail_client']));

                // Actualisation des données de cookie du client
                setcookie('nom_client', $nom);
                setcookie('prenom_client', $prenom);
                setcookie('anniv_client', $anniv);
                setcookie('address_client', $address);
                setcookie('complement_client', $complement);
                setcookie('zip_client', $zip);
                setcookie('ville_client', $ville);
                setcookie('mail_client', $mail);
                setcookie('port_client', $port);
                setcookie('fixe_client', $fixe);

                // On redirige vers la page de gestion de l'employé pour la rafraichir
                header('location:modification_client.php?mdp=non');
            } else {
                // Si ils sont différent, on met à jour la bdd avec le nouveau mot de passe
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
                    mdp='$mdp' WHERE mail=? ");
                $update->execute(array($_COOKIE['mail_client']));

                // Actualisation des données de session de l'employé
                setcookie('nom_client', $nom);
                setcookie('prenom_client', $prenom);
                setcookie('anniv_client', $anniv);
                setcookie('address_client', $address);
                setcookie('complement_client', $complement);
                setcookie('zip_client', $zip);
                setcookie('ville_client', $ville);
                setcookie('mail_client', $mail);
                setcookie('port_client', $port);
                setcookie('fixe_client', $fixe);
                setcookie('mdp_client', $mdp);

                // On redirige vers la page de gestion de l'employé pour la rafraichir
                header('location:modification_client.php?mdp=oui');
            }
        } else {
            header('location:index_employe.php');
        }
    }
}

// Suppression d'un compte client
if(isset($_POST['suppressionClient'])) {

    $mdpSuppression = $_POST['mdpSuppression'];
    $mdpSuppression = hash('sha256', $mdpSuppression);

    $sql = $bdd->prepare("SELECT mdp FROM site_user WHERE mail=?");
    $sql->execute(array($_SESSION['mail']));
    $mdpBdd = $sql->fetch();

    if($mdpSuppression === $mdpBdd['mdp']) {

        $delete = $bdd->prepare("DELETE FROM site_user WHERE mail=?");
        $delete->execute(array($_POST['email']));
    
        header('location:index_employe.php?sup=ok');
    } else header('location:index_employe.php?sup=nok');
}

ob_end_flush();
?>