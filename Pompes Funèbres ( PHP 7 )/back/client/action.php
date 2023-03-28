<?php

session_start();
ob_start();

require 'bdd.php';

// On vérifie que la personne est bien loguée et que son statut correspond bien à Client
// Si une des deux conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****' ) {
    header('location:../../connexion.php');
} 

// Gestion de la déconnexion
if(isset($_POST['deconnexionClient'])) {
    session_destroy();

    header('location:../../index.php');
}

// Gestion de la modification des informations du client 
if (isset($_POST['modificationsClient'])) {

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

                // Actualisation des données de session du client
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
                header('location:index_client.php?mdp=non');
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

                // Actualisation des données de session du client
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
                header('location:index_client.php?mdp=oui');
            }
        } else {
            header('location:index_client.php');
        }
    }
}

// Suppression du compte par le client
if(isset($_POST['suppressionCompte'])) {

    $mdpSuppression = $_POST['mdpSuppression'];
    $mdpSuppression = hash('sha256', $mdpSuppression);

    $sql = $bdd->prepare("SELECT mdp FROM site_user WHERE mail=?");
    $sql->execute(array($_SESSION['mail']));
    $mdpBdd = $sql->fetch();

    if($mdpSuppression === $mdpBdd['mdp']) {

        $delete = $bdd->prepare("DELETE FROM site_user WHERE mail=?");
        $delete->execute(array($_SESSION['mail']));
    
        session_destroy();

        header('location:../../index.php?sup=ok');
    } else header('location:index_client.php?sup=nok');
}

// Formulaire de création d'un nouveau devis pour un client enregistré
if (isset($_POST['devisObsequesClient'])) {

    // Devis prévoyance
    if ($_POST['urgent'] === '3') {

        // Collecte et sécurisation des informations
        $urgent = $_POST['urgent'];
        $civilite = $_POST['civiliteContactant'];
        $nom = htmlentities($_POST['nomContactant'], ENT_QUOTES, 'UTF-8');
        $prenom = htmlentities($_POST['prenomContactant'], ENT_QUOTES, 'UTF-8');
        $telephone = htmlentities($_POST['telephone'], ENT_QUOTES, 'UTF-8');
        $mail = htmlentities($_POST['mail'], ENT_QUOTES, 'UTF-8');
        $obseques = $_POST['obseques'];
        $ceremonie = $_POST['ceremonie'];
        $commentaires = htmlentities($_POST['commentaires'], ENT_QUOTES, 'UTF-8');
        $stockage = 3;
        $user = $_SESSION['id'];

        // Injection en BDD du type d'obsèques, cérémonie religieuse, lieu de stockage, commentaires
        $insert2 = $bdd->prepare("INSERT INTO site_defunt SET fk_user='$user', commentaires='$commentaires', fk_stockage='$stockage', fk_religion='$ceremonie', fk_cremaType='$obseques' ");
        $insert2->execute();

        Header('location:index_client.php');

    } else 

        // Devis Obsèques
        if ($_POST['urgent'] === '1' || $_POST['urgent'] === '2') {

        // Collecte et sécurisation des informations
        $civiliteDefunt = $_POST['civiliteDefunt'];
        $nomDefunt = htmlentities($_POST['nomDefunt'], ENT_QUOTES, 'UTF-8');
        $prenomDefunt = htmlentities($_POST['prenomDefunt'], ENT_QUOTES, 'UTF-8');
        $stockage = $_POST['lieux'];
        $zip = htmlentities($_POST['zip'], ENT_QUOTES, 'UTF-8');
        $ville = htmlentities($_POST['ville'], ENT_QUOTES, 'UTF-8');
        $urgent = $_POST['urgent'];
        $civilite = $_POST['civiliteContactant'];
        $nom = htmlentities($_POST['nomContactant'], ENT_QUOTES, 'UTF-8');
        $prenom = htmlentities($_POST['prenomContactant'], ENT_QUOTES, 'UTF-8');
        $telephone = htmlentities($_POST['telephone'], ENT_QUOTES, 'UTF-8');
        $mail = htmlentities($_POST['mail'], ENT_QUOTES, 'UTF-8');
        $obseques = $_POST['obseques'];
        $ceremonie = $_POST['ceremonie'];
        $commentaires = htmlentities($_POST['commentaires'], ENT_QUOTES, 'UTF-8');
        $user = $_SESSION['id'];

        // Injection en BDD des informations conernant le defunt / personne en fin de vie
        $update = $bdd->prepare("UPDATE site_user SET fk_urgent='$urgent' WHERE id_user=?");
        $update->execute(array($user));

        $insert2 = $bdd->prepare("INSERT INTO site_defunt SET fk_user='$user', civilite='$civiliteDefunt', nomDef='$nomDefunt', prenomDef='$prenomDefunt', 
            commentaires='$commentaires', zipDef='$zip', villeDef='$ville', fk_stockage='$stockage', fk_religion='$ceremonie', fk_cremaType='$obseques' ");
        $insert2->execute();

        $_SESSION['urgent'] = $urgent;

        Header('location:index_client.php');
    } Header('location:index_client.php');
}

ob_end_flush();
?>
