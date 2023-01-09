<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'assets/PHPMailer/src/Exception.php';
require 'assets/PHPMailer/src/PHPMailer.php';
require 'assets/PHPMailer/src/SMTP.php';
require 'bdd.php';

//Formulaire de contact de la page Accueil et de la page Nous contacter
if (isset($_POST['formulaireContact']) || isset($_POST['formulairePageContact']) || isset($_POST['formulairePrevoyance'])) {

    // On vérifie que tous les champs sont remplis
    if (!isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['tel'], $_POST['message'])) {
        $messageErreur = 'Merci de remplir tous les champs !';
    } else {
        // Sécurisation des données reçues du formulaire
        $nom = htmlentities($_POST['nom'], ENT_QUOTES, "UTF-8");
        $prenom = htmlentities($_POST['prenom'], ENT_QUOTES, "UTF-8");
        $email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
        $tel = htmlentities($_POST['tel'], ENT_QUOTES, "UTF-8");
        $message = htmlentities($_POST['message'], ENT_QUOTES, "UTF-8");

        // Injection en BDD
        $insert = $bdd->exec("INSERT INTO site_contact SET nom='$nom', prenom='$prenom', email='$email', tel='$tel', message_contact='$message'");

        // Envoi du mail
        // Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                                       //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.ionos.fr';                        //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = "*****";                                //SMTP username
            $mail->Password   = "*****";                                //SMTP password
            $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom("*****", "Contact site internet");
            $mail->addAddress("{$donneesSociete['mail']}", "PF {$donneesSociete['nom']}");

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Message';
            $mail->Body    = "Bonjour,<br><br>
                vous venez de recevoir un nouveau message.<br><br>
                <strong>Nom : </strong>{$nom}<br>
                <strong>Pr&eacute;nom : </strong>{$prenom}<br>
                <strong>E-mail : </strong>{$email}<br>
                <strong>T&eacute;l&eacute;phone : </strong>{$tel}<br>
                <strong>Message : </strong>{$message}";

            $mail->send();
        } catch (Exception $e) {
            die("Votre message n'a pu être envoyé. Erreur : {$mail->ErrorInfo}");
        }
    }

    header('location:index.php');
}

// Formulaire de connexion
if (isset($_POST['formulaireConnexion'])) {
    $mail = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
    $mdp = htmlentities($_POST['mdp'], ENT_QUOTES, 'UTF-8');

    // On vérifie si le compte existe (le mail sert d'identifiant unique pour un compte)
    $check = $bdd->prepare("SELECT * FROM site_user WHERE mail=?");
    $check->execute(array($mail));
    $data = $check->fetch();

    $row = $check->rowCount();

    // Si un compte existe
    if ($row === 1) {
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

            $mdp = hash('sha256', $mdp);

            // Vérification que le mot de passe correspond à celui enregistré en BDD
            if ($mdp === $data['mdp']) {

                $profil = $data['profil'];
                $statut = $data['statut'];

                // Connexion avec un profil désactivé
                if ($statut === '0') {
                    header('location:index.php?compte=inactif');

                    // Connexin avc un profil client
                } else if ($profil === '*****') {

                    $_SESSION['log'] = 1;
                    $_SESSION['id'] = $data['id_user'];
                    $_SESSION['civilite'] = $data['civilite'];
                    $_SESSION['nom'] = $data['nom'];
                    $_SESSION['prenom'] = $data['prenom'];
                    $_SESSION['anniv'] = $data['anniv'];
                    $_SESSION['address'] = $data['address'];
                    $_SESSION['complement'] = $data['complement'];
                    $_SESSION['zip'] = $data['zip'];
                    $_SESSION['ville'] = $data['ville'];
                    $_SESSION['mail'] = $data['mail'];
                    $_SESSION['port'] = $data['port'];
                    $_SESSION['fixe'] = $data['fixe'];
                    $_SESSION['mdp'] = $mdp;
                    $_SESSION['urgent'] = $data['fk_urgent'];
                    $_SESSION['perso'] = $data['perso'];
                    $_SESSION['profil'] = $data['profil'];
                    $_SESSION['site'] = $donneesSociete['dossier'];
                    $_SESSION['id_societe'] = $donneesSociete['societe_id'];

                    header('location:back/client/index_client.php');

                    // Connexion avec un profil employé
                } else if ($profil === '*****') {

                    $_SESSION['log'] = 1;
                    $_SESSION['nom'] = $data['nom'];
                    $_SESSION['prenom'] = $data['prenom'];
                    $_SESSION['anniv'] = $data['anniv'];
                    $_SESSION['address'] = $data['address'];
                    $_SESSION['complement'] = $data['complement'];
                    $_SESSION['zip'] = $data['zip'];
                    $_SESSION['ville'] = $data['ville'];
                    $_SESSION['mail'] = $data['mail'];
                    $_SESSION['port'] = $data['port'];
                    $_SESSION['fixe'] = $data['fixe'];
                    $_SESSION['mdp'] = $mdp;
                    $_SESSION['profil'] = $data['profil'];
                    $_SESSION['statut'] = $data['statut'];
                    $_SESSION['site'] = $donneesSociete['dossier'];

                    header('location:back/employe/index_employe.php');

                    // Connexion avec un profil administrateur
                } else if ($profil === '*****') {

                    $_SESSION['log'] = 1;
                    $_SESSION['id_user'] = $data['id_user'];
                    $_SESSION['nom'] = $data['nom'];
                    $_SESSION['prenom'] = $data['prenom'];
                    $_SESSION['profil'] = $data['profil'];
                    $_SESSION['site'] = $donneesSociete['dossier'];

                    header('location:back/administrateur/index_administrateur.php');

                    // Connexion avec le profil RH
                } else if ($profil === '*****') {

                    $_SESSION['log'] = 1;
                    $_SESSION['nom'] = $data['nom'];
                    $_SESSION['prenom'] = $data['prenom'];
                    $_SESSION['anniv'] = $data['anniv'];
                    $_SESSION['address'] = $data['address'];
                    $_SESSION['complement'] = $data['complement'];
                    $_SESSION['zip'] = $data['zip'];
                    $_SESSION['ville'] = $data['ville'];
                    $_SESSION['mail'] = $data['mail'];
                    $_SESSION['port'] = $data['port'];
                    $_SESSION['fixe'] = $data['fixe'];
                    $_SESSION['mdp'] = $mdp;
                    $_SESSION['profil'] = $data['profil'];
                    $_SESSION['statut'] = $data['statut'];
                    $_SESSION['site'] = $donneesSociete['dossier'];

                    header('location:back/rh/index_rh.php');

                    // Si la connexion ne correspond à aucun type de profil
                } else {
                    header('location:inscription.php');
                }
                // Si il a un problème avec le mot de passe
            } else {
                header('location:inscription.php');
            }
            // Si le mail saisi n'a pas une structure adéquate
        } else {
            header('location:inscription.php');
        }
        // Si aucun compte n'existe
    } else {
        header('location:inscription.php');
    }
}

// Formulaire d'inscription
if (isset($_POST['formulaireInscription'])) {

    // Gestion du reCaptcha
    // Vérification que le champ reponse_recaptcha contient une valeur. Si ce n'est pas le cas : redirection vers l'Accueil
    if (empty($_POST['reponse_recaptcha'])) {
        header('location:index.php?err=1');
    } else {
        // On prépare l'url vers qui va être interrogée via une API
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=*****={$_POST['reponse_recaptcha']}";

        // Pour récupérer la réponse de l'API il y a deux solutions :
        // Si curl est installé
        if (function_exists('curl_version')) {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($curl);
            // Sinon on utilise file_get_contents()
        } else {
            $response = file_get_contents($url);
        }
        // On vérifie que la réponse de l'API n'est pas vide ou NULL. Si c'est le cas : redirection vers l'Accueil
        if (empty($response) || is_null($response)) {
            header('Location: index.php?err=2');
            // Si la réponse n'est pas vide ou nulle
        } else {
            $data = json_decode($response);
            // On vérifie que le contrôle est un succès. Si c'est le cas on traite le formulaire
            if ($data->success) {

                // On vérifie que les données du formulaire sont cohérente avec ce qu'attend la BDDD                      
                if (
                    strlen($_POST['nom']) <= 30 && strlen($_POST['prenom']) <= 30 && isset($_POST['anniv']) && strlen($_POST['address']) <= 40
                    && strlen($_POST['complement']) <= 40 && strlen($_POST['zip']) === 5 && strlen($_POST['ville']) <= 30
                ) {
                    // On récupère et on sécurise le mot de passe saisi et sa confirmation
                    $mdp = htmlentities($_POST['mdp'], ENT_QUOTES, 'UTF-8');
                    $mdpConf = htmlentities($_POST['mdpConf'], ENT_QUOTES, 'UTF-8');

                    // On contrôle que le mot de passe et sa confirmation sont identiques
                    if ($mdp === $mdpConf) {

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
                        $mdp = hash('sha256', $mdp);
                        $fk_urgent = htmlentities($_POST['urgent'], ENT_QUOTES, 'UTF-8');
                        $perso = htmlentities($_POST['perso'], ENT_QUOTES, 'UTF-8');

                        // Injection des données dans la BDD
                        $insert = $bdd->prepare('INSERT INTO site_user (nom, prenom, anniv, address, complement, zip, ville, mail, port, fixe, mdp, fk_urgent, perso) 
                                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                        $insert->execute(array($nom, $prenom, $anniv, $address, $complement, $zip, $ville, $mail, $port, $fixe, $mdp, $fk_urgent, $perso));

                        // On redirige vers la page de connexion
                        header('location:connexion.php');
                        // Si le mot de passe et la confirmation sont différents
                    } else header('location:index.php?err=3');
                    // Si les données ne correspondent pas à ce qu'attends la BDD      
                } else header('location:index.php?err=4');
                // Si le contrôle est un échec : redirection vers l'Accueil
            } else header('location:index.php?err=5');
        }
    }
}

// Demande de devis
if (isset($_POST['DevisObseques'])) {

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

        // Contrôle si le contactant existe déjà en BDD
        $check = $bdd->prepare("SELECT * FROM site_user WHERE mail=?");
        $check->execute(array($mail));
        $data = $check->fetch();
        $row = $check->rowCount();

        if ($row === 1) {
            // Si oui : récupération de son id et on met à jour les informations
            $user = $data['id_user'];

            $update = $bdd->prepare("UPDATE site_user SET civilite='$civilite', nom='$nom', prenom='$prenom', port='$telephone', mail='$mail', fk_urgent='$urgent' WHERE id_user=?");
            $update->execute(array($user));
        } else {
            // Si non :
            // Injection en BDD des coordonnées du contactant
            $insert1 = $bdd->prepare("INSERT INTO site_user SET civilite='$civilite', nom='$nom', prenom='$prenom', port='$telephone', mail='$mail', fk_urgent='$urgent' ");
            $insert1->execute();

            // Récupératin de l'id_user nouvellement généré
            $check = $bdd->prepare("SELECT * FROM site_user WHERE mail=?");
            $check->execute(array($mail));
            $data = $check->fetch();
            $user = $data['id_user'];
        }

        // Injection en BDD du type d'obsèques, cérémonie religieuse, lieu de stockage, commentaires
        $insert2 = $bdd->prepare("INSERT INTO site_defunt SET fk_user='$user', commentaires='$commentaires', fk_stockage='$stockage', fk_religion='$ceremonie', fk_cremaType='$obseques' ");
        $insert2->execute();

        // Envoie d'un mail
        // Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                                       //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.ionos.fr';                        //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = '*****';                                //SMTP username
            $mail->Password   = '*****';                                //SMTP password
            $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom("*****", "Demande de devis");
            $mail->addAddress("{$donneesSociete['mail']}", "PF {$donneesSociete['nom']}");

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Demande de devis';
            $mail->Body    = "Bonjour,<br><br>vous venez de recevoir une demande de devis de la part de <i>{$prenom} {$nom}</i>.<br>
                Cette demande de devis est disponible depuis votre espace personnel.                
                
                <br><br> Vous pouvez vous connecter &agrave;  votre espace presonel en cliquant 
                <a href='http://{$donneesSociete['domaine']}/connexion.php'>ici</a> !";

            $mail->send();

            header('location:emplois.php');
        } catch (Exception $e) {
            echo "Votre demande de devis n'a pu être envoyée. Erreur : {$mail->ErrorInfo}";
        }

        Header('location:index.php');
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

            // Contrôle si le contactant existe déjà en BDD
            $check = $bdd->prepare("SELECT * FROM site_user WHERE mail=?");
            $check->execute(array($mail));
            $data = $check->fetch();
            $row = $check->rowCount();

            if ($row === 1) {
                // Si oui : récupération de son id et on met à jour les informations
                $user = $data['id_user'];

                $update = $bdd->prepare("UPDATE site_user SET civilite='$civilite', nom='$nom', prenom='$prenom', port='$telephone', mail='$mail', fk_urgent='$urgent' WHERE id_user=?");
                $update->execute(array($user));
            } else {
                // Si non :
                // Injection en BDD des coordonnées contactant
                $insert1 = $bdd->prepare("INSERT INTO site_user SET civilite='$civilite', nom='$nom', prenom='$prenom', port='$telephone', mail='$mail', fk_urgent='$urgent' ");
                $insert1->execute();

                // Récupératin de l'id_user nouvellement généré
                $check = $bdd->prepare("SELECT * FROM site_user WHERE mail=?");
                $check->execute(array($mail));
                $data = $check->fetch();
                $user = $data['id_user'];
            }

            // Injection en BDD des informations conernant le defunt / personne en fin de vie
            $insert2 = $bdd->prepare("INSERT INTO site_defunt SET fk_user='$user', civilite='$civiliteDefunt', nomDef='$nomDefunt', prenomDef='$prenomDefunt', 
            commentaires='$commentaires', zipDef='$zip', villeDef='$ville', fk_stockage='$stockage', fk_religion='$ceremonie', fk_cremaType='$obseques' ");
            $insert2->execute();

            // Envoie d'un mail
            // Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                                       //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.ionos.fr';                        //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = '*****';                                //SMTP username
                $mail->Password   = '*****';                                //SMTP password
                $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom("*****", "Demande de devis");
                $mail->addAddress("{$donneesSociete['mail']}", "PF {$donneesSociete['nom']}");

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Demande de devis';
                $mail->Body    = "Bonjour,<br><br>vous venez de recevoir une demande de devis de la part de <i>{$prenom} {$nom}</i>.<br>
                Cette demande de devis est disponible depuis votre espace personnel.                
                
                <br><br> Vous pouvez vous connecter &agrave;  votre espace presonel en cliquant 
                <a href='http://{$donneesSociete['domaine']}/connexion.php'>ici</a> !";
    
                $mail->send();

                header('location:emplois.php');
            } catch (Exception $e) {
                echo "Votre demande de devis n'a pu être envoyée. Erreur : {$mail->ErrorInfo}";
            }

            Header('location:index.php');
        }
    Header('location:index.php');
}

// Envoie d'une candidature en réponse à une annonce
if (isset($_POST['envoyerCandidature'])) {

    // Upload du CV
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] === 0) {

        // On récupère les informations du fichier
        $nomfichier = $_FILES['cv']['name'];
        $type = $_FILES['cv']['type'];
        $taille = $_FILES['cv']['size'];

        // On récupère l'extension du fichier en la forçant en minuscule
        $extension = strtolower(pathinfo($nomfichier, PATHINFO_EXTENSION));

        // On précise quels types MIME son acceptés
        $autorise = [
            'doc' => 'application/msword',
            'pdf' => 'application/pdf'
        ];

        // On vérifie que l'extension et le type MIME du fichier reçu figurent parmis ceux autorisés
        if (array_key_exists($extension, $autorise) && in_array($type, $autorise)) {

            // On vérifie que le poid du fichier ne dépasse pas les 2 Mo
            if ($taille <= 2024 * 1024) {

                $date = date('d-m-y_h:i:s');
                $nomfichier = $date . '-' . $nomfichier;

                // On génère le chemin de saugarde du fichier
                $sauvegarde = "uploads/$nomfichier";

                // On déplace le fichier temp vers le dossier de sauvegarde
                if (move_uploaded_file($_FILES['cv']['tmp_name'], $sauvegarde)) {
                    chmod($sauvegarde, 0644);
                } else {
                    die("L'envoie du fichier a échoué");
                }
            } else {
                die("Le fichier est trop lourd");
            }
        } else {
            die("L'extension du fichier ne conviens pas");
        }
    } else {
        die("Erreur lors de l'envoie du formulaire");
    }

    // Injection des informations postulant en BDD
    $id = $_POST['id_annonce'];
    $nom = htmlentities($_POST['nom'], ENT_QUOTES, 'UTF-8');
    $prenom = htmlentities($_POST['prenom'], ENT_QUOTES, 'UTF-8');
    $cv = $sauvegarde;
    $societe = $_POST['fk_societe'];

    $insert = $bdd->prepare("INSERT INTO site_postulant SET fk_emploi='$id', fk_societe='$societe', nom_postulant='$nom', prenom_postulant='$prenom', cv='$cv'");
    $insert->execute();

    // Envoie d'un mail
    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.ionos.fr';                        //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '*****';                                //SMTP username
        $mail->Password   = '*****';                                //SMTP password
        $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom("*****", 'Candidature annonce');
        $mail->addAddress('*****', 'Recrutement');

        //Attachments
        $mail->addAttachment("$sauvegarde", 'CV');              //Add attachments

        //Content
        $mail->isHTML(true);                                    //Set email format to HTML
        $mail->Subject = 'Candidature';
        $mail->Body    = "Bonjour,<br><br>vous venez de recevoir une candidature pour l'annonce <strong>{$_POST['nom_emploi']}</strong> parue sur le site de 
        <strong>{$donneesSociete['nom']}</strong> 	&agrave; <strong>{$donneesSociete['ville']}</strong> de la part de <i>{$prenom} {$nom}</i> <br><br> Vous pouvez vous 
        connecter &agrave;  votre espace en cliquant <a href='http://{$donneesSociete['domaine']}.fr/connexion.php'>ici</a> ! ";
        $mail->send();

        header('location:emplois.php');
    } catch (Exception $e) {
        echo "Votre candidature n'a pu être envoyée. Erreur : {$mail->ErrorInfo}";
    }
}

// Envoie d'une candidature spontanée
if (isset($_POST['candidatureSpontanee'])) {

    // Upload du CV
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] === 0 && isset($_FILES['lm']) && $_FILES['lm']['error'] === 0) {

        // On récupère les informations des fichiers
        $nomfichierCV = $_FILES['cv']['name'];
        $typeCV = $_FILES['cv']['type'];
        $tailleCV = $_FILES['cv']['size'];
        $nomfichierLM = $_FILES['lm']['name'];
        $typeLM = $_FILES['lm']['type'];
        $tailleLM = $_FILES['lm']['size'];
        $site = $donneesSociete['societe_id'];

        // On récupère l'extension des fichiers en la forçant en minuscule
        $extensionCV = strtolower(pathinfo($nomfichierCV, PATHINFO_EXTENSION));
        $extensionLM = strtolower(pathinfo($nomfichierLM, PATHINFO_EXTENSION));

        // On précise quels types MIME son acceptés
        $autorise = [
            'doc' => 'application/msword',
            'pdf' => 'application/pdf'
        ];

        // Onvérifie que l'extension et le type MIME des fichiers reçus figurent parmis ceux autorisés
        if (array_key_exists($extensionCV, $autorise) && in_array($typeCV, $autorise) && array_key_exists($extensionLM, $autorise) && in_array($typeLM, $autorise)) {

            // On vérifie que le poid des fichiers ne dépasse pas les 2 Mo
            if ($tailleCV <= 2024 * 1024 && $tailleLM <= 2024 * 1024) {

                $date = date('d-m-y_h:i:s');
                $nomfichierCV = $date . '-' . $nomfichierCV;
                $date = date('d-m-y_h:i:s');
                $nomfichierLM = $date . '-' . $nomfichierLM;

                // On génère le chemin de saugarde des fichiers
                $sauvegardeCV = "uploads/$nomfichierCV";
                $sauvegardeLM = "uploads/$nomfichierLM";

                // On déplace les fichiers temp vers le dossier de sauvegarde
                if (move_uploaded_file($_FILES['cv']['tmp_name'], $sauvegardeCV) && move_uploaded_file($_FILES['lm']['tmp_name'], $sauvegardeLM)) {
                    chmod($sauvegardeCV, 0644);
                    chmod($sauvegardeLM, 0644);
                } else {
                    die("L'envoie des fichiers a échoué");
                }
            } else {
                die("Au moins un des fichiers est trop lourd");
            }
        } else {
            die("Le type de fichiers ne conviens pas");
        }
    } else {
        die("Erreur lors de l'envoie du formulaire");
    }

    // Injection des informations postulant en BDD
    $nom = htmlentities($_POST['nom'], ENT_QUOTES, 'UTF-8');
    $prenom = htmlentities($_POST['prenom'], ENT_QUOTES, 'UTF-8');
    $cv = $sauvegardeCV;
    $lm = $sauvegardeLM;

    $insert = $bdd->prepare("INSERT INTO site_postulant SET fk_emploi=1, fk_societe='$site', nom_postulant='$nom', prenom_postulant='$prenom', cv='$cv', lettre_motivation='$lm' ");
    $insert->execute();

    // Envoie d'un mail
    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.ionos.fr';                        //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '*****';                                //SMTP username
        $mail->Password   = '*****';                                //SMTP password
        $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom("*****", "Candidature spontannee");
        $mail->addAddress('*****', 'Recrutement');

        //Attachments
        $mail->addAttachment("$sauvegardeCV", 'CV');         //Add attachments
        $mail->addAttachment("$sauvegardeLM", 'Lettre de motivation');         //Add attachments

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Candidature';
        $mail->Body    = "Bonjour,<br><br>vous venez de recevoir une candidature spontann&eacute;e pour le site de <strong>{$donneesSociete['nom']}</strong> &agrave; 
        <strong>{$donneesSociete['ville']}</strong> de la part de <i>{$prenom} {$nom}</i>. <br><br> Vous pouvez vous connecter &agrave;  votre espace en cliquant 
        <a href='http://{$donneesSociete['domaine']}/connexion.php'>ici</a> !";

        $mail->send();

        header('location:emplois.php');
    } catch (Exception $e) {
        echo "Votre candidature n'a pu être envoyée. Erreur : {$mail->ErrorInfo}";
    }
}

