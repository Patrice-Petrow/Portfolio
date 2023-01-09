<?php

session_start();

// On vérifie que la personne est bien loguée et que son statut correspond bien à Client
// Si une des deux conditions est fausse: redirection sur la page de connexion.
if ($_SESSION['log'] != 1 || $_SESSION['profil'] != '*****') {
    header('location:../../connexion.php');
}

require '../../class/Messages.php';
require 'header_client.php';
$errors = null;
$success = false;

if (isset($_POST['message'])) {
    $temoignage = new Message ($_POST['message']);
    if ($temoignage->isValid()) {
        $societe = $_SESSION['id_societe'];
        $message = htmlentities($_POST['message']);

        $sql = $bdd->prepare("INSERT INTO site_temoignage SET fk_userName = ?, fk_societe = '$societe', star = 10, descr = '$message' ");
        $sql->execute(array($_SESSION['id']));

        $success = true;
        $_POST = [];
    } else {
        $errors = $temoignage->getErrors();
    }
}

?>

<!----------->
<!-- Titre -->
<!----------->
<h4 class="col-md-6 mx-auto pb-2 border-bottom border-primary pt-5 my-5" style="width: fit-content;">Laissez ici votre témoignage</h4>


<!-------------------------->
<!-- Formulaire de saisie -->
<!-------------------------->
<form action="" method="post">
    <div class="col-lg-6 mx-auto">

        <!-- Si $errors n'est pas vide, affichage une alerte -->
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                Formulaire invalide
            </div>
        <?php endif ?>
        <!-- Si $success est true, affichage une alerte -->
        <?php if ($success) : ?>
            <div class="alert alert-success">
                Merci pour votre message !
                <?php var_dump($donneesSociete); ?>
            </div>
        <?php endif ?>
            
        <textarea name="message" cols="30" rows="10" class="form-control mt-4 <?= isset($errors['message'])? 'is-invalid' : '' ?>" placeholder="Votre message"></textarea>
        <?php if(isset($errors['message'])): ?>
            <div class="invalid-feedback"><?php echo($errors['message']) ?></div>
        <?php endif ?>

    </div>
    <div class="col-lg-6 mx-auto mt-4">
        <input type="submit" value="Poster" name="posterTemoignages" class="btn btn-primary">
    </div>
</form>