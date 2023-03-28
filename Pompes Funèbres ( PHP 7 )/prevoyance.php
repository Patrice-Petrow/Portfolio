<?php
require 'bdd.php';
require 'header.php';
?>


<!-------------->
<!-- Masthead -->
<!-------------->
<header class="headerinscription mb-5"></header>

<!----------->
<!-- Vidéo -->
<!----------->
<div class="text-center mb-5">
    <iframe class="videoPrevoyance" src="https://www.youtube.com/embed/u4w_z0jyO9U" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <hr class="divider mt-5" />
</div>

<!---------------->
<!-- Téléphonne -->
<!---------------->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h2>Nous contacter par téléphone !</h2>
            <a class="btn btn-primary btn-xl mt-4 mx-auto fs-3" href="tel: <?= $donneesSociete['tel'] ?>"><i class="bi-phone fs-2 mb-3 "></i> <?= $donneesSociete['tel'] ?></a>
            <hr class="divider mt-5" />
        </div>
    </div>
</div>

<!------------->
<!-- Contact -->
<!------------->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h2 class="mt-4">Ecrivez-nous pour plus d'informations !</h2>
            <hr class="divider mt-5" />
        </div>
    </div>
    <div class="row justify-content-center mb-5">
        <div class="col-lg-6">
            <form method="POST" action="action.php">
                <!-- Nom input-->
                <div class="form-floating mb-3">
                    <input class="form-control" type="text" name="nom" placeholder="Nom" required />
                    <label for="nom">Nom</label>
                </div>
                <!-- Prenom input-->
                <div class="form-floating mb-3">
                    <input class="form-control" type="text" name="prenom" placeholder="Prénom" required />
                    <label for="prenom">Prénom</label>
                </div>
                <!-- Email input-->
                <div class="form-floating mb-3">
                    <input class="form-control" type="email" name="email" placeholder="E-mail" required />
                    <label for="email">E-mail</label>
                </div>
                <!-- Téléphone input-->
                <div class="form-floating mb-3">
                    <input class="form-control" type="text" name="tel" placeholder="Téléphone" required />
                    <label for="tel">Téléphone</label>
                </div>
                <!-- Message input-->
                <div class="form-floating mb-3">
                    <textarea class="form-control" type="text" name="message" placeholder="Message" style="height: 10rem" required></textarea>
                    <label for="message">Message</label>
                </div>
                <!-- Submit Button-->
                <div class="d-grid"><button class="btn btn-primary btn-xl" type="submit" name="formulairePrevoyance">Envoyer</button></div>
            </form>
        </div>
    </div>
</div>


<!-- Footer-->
<?php
require 'footer.php';
?>