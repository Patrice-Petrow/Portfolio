<?php
require 'bdd.php';
require 'header.php';
?>

<!-------------->
<!-- Masthead -->
<!-------------->
<header class="headercontact mb-3 mb-md-5 "></header>

<!--------------------------->
<!-- Formulaire de contact -->
<!--------------------------->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <!-- Téléphonne -->
        <div class="col-lg-8 col-xl-6 text-center">
            <h2>Nous contacter par téléphonne !</h2>
            <a class="btn btn-primary btn-xl mt-4 fs-3" href="tel: <?= $donneesSociete['tel'] ?>"><i class="bi-phone fs-2 mb-3 "></i> <?= $donneesSociete['tel'] ?></a>
            <hr class="divider mt-5" />
        </div>
        <!-- Mail -->
        <div class="container px-4 px-lg-5 mt-4">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 text-center">
                    <h2 class="mt-0">Vous souhaitez nous écrire !</h2>
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                <div class="col-lg-6">
                    <form id="contactForm" data-sb-form-api-token="API_TOKEN" method="POST" action="action.php">
                        <!-- Nom input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="nom" type="text" name="nom" placeholder="Saisir votre nom..." data-sb-validations="required" />
                            <label for="nom">Nom</label>
                            <div class="invalid-feedback" data-sb-feedback="nom:required">Votre nom est requis.</div>
                        </div>
                        <!-- Prenom input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="prenom" type="text" name="prenom" placeholder="Saisir votre prénom..." data-sb-validations="required" />
                            <label for="prenom">Prénom</label>
                            <div class="invalid-feedback" data-sb-feedback="prenom:required">Votre prénom est requis.</div>
                        </div>
                        <!-- Email input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" type="email" name="email" placeholder="nom@exemple.com" data-sb-validations="required,email" />
                            <label for="email">E-mail</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">Votre email est requis.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Adresse mail invalide.</div>
                        </div>
                        <!-- Téléphone input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="phone" type="text" name="tel" placeholder="01 02 03 04 05" data-sb-validations="required" />
                            <label for="phone">Téléphone</label>
                            <div class="invalid-feedback" data-sb-feedback="phone:required">Votre numéro de téléphone.</div>
                        </div>
                        <!-- Message input-->
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="message" type="text" name="message" placeholder="Ecrire votre message ici..." style="height: 10rem" data-sb-validations="required"></textarea>
                            <label for="message">Message</label>
                            <div class="invalid-feedback" data-sb-feedback="message:required">Merci de saisir votre message.</div>
                        </div>
                        <!-- Submit Button-->
                        <div class="d-grid"><button class="btn btn-primary btn-xl" id="submitButton" type="submit" name="formulairePageContact">Envoyer</button></div>
                    </form>
                </div>
            </div>
        </div>
        <hr class="divider mt-3" />
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                <h2 class="mb-3">Pour venir nous rencontrer !</h2>
            </div>
            <div class="row text-center">
                <!-- Google map -->
                <div class="col">
                    <iframe class="googleMap mx-auto" src="<?php echo ($donneesSociete['map']) ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <!-- Coordonnées -->
                <div class="col mx-auto col-md-5">
                    <h5>Pompes Funèbres&ensp;<strong><?php echo ($donneesSociete['nom']) ?></strong></h5>
                    <p><?php echo ($donneesSociete['adress']) ?></p>
                    <p><?php echo ($donneesSociete['zip'] . ' ' . $donneesSociete['ville']) ?></p>
                    <div class="col mb-2">
                        <a href="tel: <?= $donneesSociete['tel'] ?>" class="nav-link lienContact"><i class="bi bi-phone">&emsp;</i><?php echo ($donneesSociete['tel']) ?></a>
                    </div>
                    <div class="col">
                        <a href="mailto: <?php echo ($donneesSociete['mail']) ?>" class="nav-link lienContact"><i class="bi bi-envelope">&emsp;</i><?php echo ($donneesSociete['mail']) ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer-->
<?php
require 'footer.php';
?>