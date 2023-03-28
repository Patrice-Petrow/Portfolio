<?php

session_start();
ob_start();

require 'bdd.php';

?>

<?php
// On vérifie que la personne est bien loguée, que son statut correspond bien à RH et que son compte est actif
// Si une des trois conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****' || $_SESSION['statut'] === 0) {
    header('location:../../connexion.php');
}

// Gestion de la déconnexion
if (isset($_POST['deconnexionRH'])) {
    session_destroy();

    header('location:../../index.php');
}

// Selection du site pour l'affichage des annonces
if (isset($_POST['selectionSite'])) {
    $choix = $_POST['choixSite'];
    setcookie('choix', $choix);
    setcookie('siteChoix', $choix);

    $sql = $bdd->prepare("SELECT * FROM site_emplois WHERE statut IS NOT NULL AND fk_societe = ?");
    $sql->execute(array($choix));
    $data = $sql->fetch();

    if (empty($data)) {
        setcookie('noResult', 'inline');
        setcookie('affichage', 'none');
        header('location:selection_annonce_rh.php');
    } else {

        $sql = $bdd->prepare("SELECT * FROM societe_pf WHERE societe_id = ?");
        $sql->execute(array($choix));
        $data = $sql->fetch();

        setcookie('idSite', $data['societe_id']);
        setcookie('nomSite', $data['nom']);
        setcookie('nomVille', $data['ville']);
        setcookie('affichage', 'inline');
        setcookie('noResult', 'none');

        header('location:selection_annonce_rh.php');
    }
}

// Récupération des informations pour la modification d'une annonce
if (isset($_POST['modifier'])) {

    $sql = $bdd->prepare("SELECT * FROM site_emplois WHERE id_emploi = ?");
    $sql->execute(array($_POST['id_emploi']));
    $data = $sql->fetch();

    setcookie('idEmploi', $data['id_emploi']);
    setcookie('nomEmploi', utf8_encode($data['nom_emploi']));
    setcookie('descriptionEmploi', utf8_encode($data['description_emploi']));
    setcookie('obligationEmploi', utf8_encode($data['obligation_emploi']));
    setcookie('contratEmploi', $data['contrat']);
    setcookie('tempsEmploi', $data['temps']);
    setcookie('salaireEmploi', $data['salaire_heure']);
    setcookie('statutEmploi', $data['statut']);

    header('location:modification_annonce_rh.php');
}

// Modification d'une annonce
if (isset($_POST['modificationAnnonce'])) {
    if (
        strlen($_POST['nom']) <= 50 && strlen($_POST['description']) <= 1500 && strlen($_POST['obligatoire']) <= 250 &&
        strlen($_POST['contrat']) <= 30
    ) {

        $nom = htmlentities($_POST['nom'], ENT_QUOTES, 'UTF-8');
        $description = htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8');
        $obligatoire = htmlentities($_POST['obligatoire'], ENT_QUOTES, 'UTF-8');
        $contrat = htmlentities($_POST['contrat'], ENT_QUOTES, 'UTF-8');
        $temps = htmlentities($_POST['temps'], ENT_QUOTES);
        $salaire = htmlentities($_POST['salaire'], ENT_QUOTES);
        $site = $_POST['idSite'];
        $statut = $_POST['statut'];

        $update = $bdd->prepare("UPDATE site_emplois SET nom_emploi='$nom', description_emploi='$description', obligation_emploi='$obligatoire',
                contrat='$contrat', temps='$temps', salaire_heure='$salaire', fk_societe='$site', statut='$statut' WHERE id_emploi=?");
        $update->execute(array($_COOKIE['idEmploi']));

        setcookie('affichage', 'none');

        header('location:selection_annonce_rh.php?modif=ok');
    }
}

// Création d'une annonce
if (isset($_POST['creationAnnonce'])) {
    if (
        strlen($_POST['nom']) <= 50 && strlen($_POST['description']) <= 1500 && strlen($_POST['obligatoire']) <= 250 &&
        strlen($_POST['contrat']) <= 30
    ) {

        $nom = htmlentities($_POST['nom'], ENT_QUOTES, 'UTF-8');
        $description = htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8');
        $obligatoire = htmlentities($_POST['obligatoire'], ENT_QUOTES, 'UTF-8');
        $contrat = htmlentities($_POST['contrat'], ENT_QUOTES, 'UTF-8');
        $temps = htmlentities($_POST['temps'], ENT_QUOTES);
        $salaire = htmlentities($_POST['salaire'], ENT_QUOTES);
        $site = $_POST['choixSite'];

        $update = $bdd->prepare("INSERT INTO site_emplois SET nom_emploi='$nom', description_emploi='$description', obligation_emploi='$obligatoire',
                contrat='$contrat', temps='$temps', salaire_heure='$salaire', fk_societe='$site'");
        $update->execute();

        setcookie('affichage', 'none');

        header('location:selection_annonce_rh.php?creation=ok');
    }
}

// Récupération des information pour duplication d'une annonce
if (isset($_POST['dupliquer'])) {

    $sql = $bdd->prepare("SELECT * FROM site_emplois WHERE id_emploi = ?");
    $sql->execute(array($_POST['id_emploi']));
    $data = $sql->fetch();

    setcookie('idEmploi', $data['id_emploi']);
    setcookie('nomEmploi', utf8_encode($data['nom_emploi']));
    setcookie('descriptionEmploi', utf8_encode($data['description_emploi']));
    setcookie('obligationEmploi', utf8_encode($data['obligation_emploi']));
    setcookie('contratEmploi', $data['contrat']);
    setcookie('tempsEmploi', $data['temps']);
    setcookie('salaireEmploi', $data['salaire_heure']);
    setcookie('statutEmploi', $data['statut']);
    
    header('location:duplication_annonce_rh.php');
}

// Duplication d'une annonce
if (isset($_POST['duplicationAnnonce'])) {
    if (
        strlen($_POST['nom']) <= 50 && strlen($_POST['description']) <= 1500 && strlen($_POST['obligatoire']) <= 250 &&
        strlen($_POST['contrat']) <= 30
    ) {

        $nom = htmlentities($_POST['nom'], ENT_QUOTES, 'UTF-8');
        $description = htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8');
        $obligatoire = htmlentities($_POST['obligatoire'], ENT_QUOTES, 'UTF-8');
        $contrat = htmlentities($_POST['contrat'], ENT_QUOTES, 'UTF-8');
        $temps = htmlentities($_POST['temps'], ENT_QUOTES);
        $salaire = htmlentities($_POST['salaire'], ENT_QUOTES);
        $site = $_POST['choixSite'];

        $update = $bdd->prepare("INSERT INTO site_emplois SET nom_emploi='$nom', description_emploi='$description', obligation_emploi='$obligatoire',
                contrat='$contrat', temps='$temps', salaire_heure='$salaire', fk_societe='$site'");
        $update->execute();

        setcookie('affichage', 'none');
        
        header('location:selection_annonce_rh.php?creation=ok');
    }
}

// Suppression d'une candidature
if(isset($_POST['supCandidature'])) {

    $fichierCV = $_POST['cv_postulant'];
    $fichierLM = $_POST['lm_postulant'];

    if (empty($fichierLM) ) {
        $fichierCV = "../../$fichierCV";
        unlink($fichierCV);
    } else {
        $fichierCV = "../../$fichierCV";
        $fichierLM = "../../$fichierLM";     
        unlink($fichierCV);
        unlink($fichierLM);
    }

    $delete = $bdd->prepare("DELETE FROM site_postulant WHERE id_postulant = ?");
    $delete->execute(array($_POST['id_postulant']));

    header('location:candidature_rh.php');
}

ob_end_flush();