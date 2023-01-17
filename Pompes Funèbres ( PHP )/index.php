<?php
require_once 'bdd.php';
require_once 'header.php';
?>

<!-------------->
<!-- Masthead -->
<!-------------->
<header class="masthead">
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end">
                <h1 class="text-white font-weight-bold">Pompes Funèbres</h1>
                <h1 class="text-white font-weight-bold"><?= $donneesSociete['nom']; ?></h1>
                <hr class="divider" />
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-75 mb-5">Vous accompagne dans la prise en charge du défunt, dans vos démarches pour protéger vos proches. Ou pour de simple renseignements.</p>
                <p class="text-white-75 mb-5">Nous contacter 24H/24 et 7J/7 :</p>
                <a class="btn btn-primary btn-xl fs-3" href="tel: <?= $donneesSociete['tel'] ?>"><i class="bi-phone fs-2 mb-3 "></i> <?= $donneesSociete['tel'] ?></a>
            </div>
        </div>
    </div>
</header>

<!----------->
<!-- About -->
<!----------->
<section class="page-section bg-primary" id="about">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 text-center opacity0" id="animation1">
                <h2 class="text-white mt-0">Vous souhaitez nous contacter par écrit ?</h2>
                <hr class="divider divider-light" />
                <p class="text-white-75 mb-4">N'hésitez pas à nous envoyer un message !</p>
                <a class="btn btn-light btn-xl" href="#contact">Message</a>
            </div>
        </div>
    </div>
</section>

<!-------------->
<!-- Services -->
<!-------------->
<section class="page-section" id="services">
    <div id="animation2">
        <div class="container px-4 px-lg-5">
            <h2 class="text-center mt-0">Devis en ligne</h2>
            <hr class="divider" />
            <div class="row gx-4 gx-lg-5 mb-4">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <h3 class="h4 mb-2">Devis obsèques</h3>
                        <p class="text-muted mb-0">Un décès vient de survenir, appelez nous et/ou commencez votre devis en ligne !</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <h3 class="h4 mb-2">Devis prévoyance</h3>
                        <p class="text-muted mb-0">Vous souhaitez protéger vos proches, appelez nous et/ou commencez votre devis en ligne !</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <h3 class="h4 mb-2">Marbrerie</h3>
                        <p class="text-muted mb-0">Vous souhaitez faire des travaux de marbrerie, mettre en place ou changer un monument !</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <h3 class="h4 mb-2">Entretiens</h3>
                        <p class="text-muted mb-0">Votre monument ou celui de votre famille nécessite des réparations, améliorations !</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container px-lg-5 h-100">
            <div class="row  gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-baseline">
                    <a class="btn btn-primary btn-xl" href="devis.php">Devis en ligne</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!--------------->
<!-- Portfolio -->
<!--------------->
<div id="portfolio">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-lg-4 col-sm-6 ">
                <a class="portfolio-box" href="assets/img/portfolio/fullsize/1.jpg" title="Homme qui fait du jardinage">
                    <img class="img-fluid" src="assets/img/portfolio/thumbnails/1.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">Devis : </div>
                        <div class="project-name">Prévoyance</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6 ">
                <a class="portfolio-box" href="assets/img/portfolio/fullsize/2.jpg" title="Obsèques roses blanches">
                    <img class="img-fluid" src="assets/img/portfolio/thumbnails/2.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">Devis : </div>
                        <div class="project-name">Obsèques</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6 ">
                <a class="portfolio-box" href="assets/img/portfolio/fullsize/3.jpg" title="Repas de famille">
                    <img class="img-fluid" src="assets/img/portfolio/thumbnails/3.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">Devis : </div>
                        <div class="project-name">Prévoyance</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6 ">
                <a class="portfolio-box" href="assets/img/portfolio/fullsize/4.jpg" title="Enterrement rose rouge">
                    <img class="img-fluid" src="assets/img/portfolio/thumbnails/4.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">Devis : </div>
                        <div class="project-name">Obsèques</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6 ">
                <a class="portfolio-box" href="assets/img/portfolio/fullsize/5.jpg" title="Couple prévoyant">
                    <img class="img-fluid" src="assets/img/portfolio/thumbnails/5.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">Devis : </div>
                        <div class="project-name">Prévoyance</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6 ">
                <a class="portfolio-box" href="assets/img/portfolio/fullsize/6.jpg" title="Adieu !">
                    <img class="img-fluid" src="assets/img/portfolio/thumbnails/6.jpg" alt="..." />
                    <div class="portfolio-box-caption p-3">
                        <div class="project-category text-white-50">Devis : </div>
                        <div class="project-name">Obsèques</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-------------------->
<!-- Call to action -->
<!-------------------->
<section class="page-section bg-dark text-white">
    <div class="container px-4 px-lg-5 text-center">
        <h2 class="mb-4">Passer une annonce gratuite sur le registre des décès !</h2>
        <a class="btn btn-light btn-xl" href="https://registre-deces.fr">Passer une annonce</a>
    </div>
</section>

<!------------->
<!-- Contact -->
<!------------->
<section class="page-section" id="contact">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                <h2 class="mt-0">Vous souhaitez nous écrire !</h2>
                <hr class="divider" />
                <p class="text-muted mb-5">Pour un renseignement complémentaire. Pour un devis, cliquer <a href="devis.php">ici</a> !</p>
            </div>
        </div>
        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
            <div class="col-lg-6">

                <form method="POST" action="action.php">
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
                    <div class="d-grid"><button class="btn btn-primary btn-xl" id="submitButton" type="submit" name="formulaireContact">Envoyer</button></div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer-->
<?php
require 'footer.php';
?>

<script>
    let section1 = document.querySelector('#animation1');
    section1.classList.add('opacity0');
    observer1.observe(section1);

    let section2 = document.querySelector('#animation2');
    section2.classList.add('opacity0');
    observer2.observe(section2);

</script>