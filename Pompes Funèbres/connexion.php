<?php
require 'bdd.php';
require 'header.php';
?>

<!-------------->
<!-- Masthead -->
<!-------------->
<header class="headerconnexion mb-3 mb-md-5"></header>

<!---------------------------->
<!-- Formulaire de connexion-->
<!---------------------------->
<section class="page-section" id="connexion">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                <h2 class="mt-0">Espace des personnes déjà enregistrées</h2>
                <hr class="divider" />
                <p class="text-muted mb-5">Si vous ne possedez pas de compte, vous pouvez vous insrcire en cliquant <a href="/inscription.php">ici</a> !</p>
            </div>
        </div>
        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
            <div class="col-lg-6">

                <form id="contactForm" data-sb-form-api-token="API_TOKEN" method="POST" action="action.php">
                    <!-- Email input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" type="email" name="email" placeholder="nom@exemple.com" data-sb-validations="required,email" />
                        <label for="email">E-mail</label>
                        <div class="invalid-feedback" data-sb-feedback="email:required">Votre email est requis.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Adresse mail invalide.</div>
                    </div>
                    <!-- Mot de passe input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="mdp" type="password" name="mdp" data-sb-validations="required" />
                        <label for="phone">Mot de passe</label>
                        <div class="invalid-feedback" data-sb-feedback="phone:required">Entrer un mot de passe.</div>
                    </div>
                    <!-- Submit Button-->
                    <div class="d-grid">
                        <button class="btn btn-primary btn-xl" id="submitButton" type="submit" name="formulaireConnexion">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-------------------------->
<!-- Section Informations -->
<!-------------------------->
<section class="page-section bg-primary" style="overflow: hidden;">
    <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center mx-auto" id="animation5">
        <div class="col-lg-8 align-self-end">
            <h1 class="text-white font-weight-bold">Pompes Funèbres</h1>
            <h1 class="text-white font-weight-bold"><?= $donneesSociete['nom']; ?></h1>
            <hr class="divider divider-light" />
        </div>
        <div class="col-lg-8 align-self-baseline">
            <p class="text-white-75 mb-5">Vous accompagne dans la prise en charge du défunt, dans vos démarches pour protéger vos proches. Ou pour de simple renseignements.</p>
            <p class="text-white-75 mb-5">Nous contacter 24H/24 et 7J/7 :</p>
            <a class="btn btn-light btn-xl" href="tel: <?= $donneesSociete['tel'] ?>"><i class="bi-phone fs-2 mb-3 "></i> <?= $donneesSociete['tel'] ?></a>
        </div>
    </div>
</section>

<!---------------------------------------->
<!-- Renvoi vers la page Nous contacter -->
<!---------------------------------------->
<section class="page-section bg-dark" style="overflow: hidden;">
    <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center mx-auto" id="animation6">
        <div class="col-lg-8 align-self-end">
            <h2 class="text-white font-weight-bold">Vous rencontrez des difficultés pour vous connecter :</h2>
            <hr class="divider divider-light" />
        </div>
        <div class="col-lg-8 align-self-baseline">
            <a class="btn btn-light btn-xl" href="/contact.php">Contacter&ensp;nous</a>
        </div>
    </div>
</section>


<!-- Footer-->
<?php
require 'footer.php';
?>

<script>
    // Surveillance de la section Informations, pour déclenchement de son animation
    let section5 = document.querySelector('#animation5');
    section5.classList.add('dimension0');
    observer5.observe(section5);

    // Surveillance de la section de renvoie vers Nous Contacter, pour déclenchement de son animation
    let section6 = document.querySelector('#animation6');
    section6.classList.add('dimension0');
    observer6.observe(section6);
</script>