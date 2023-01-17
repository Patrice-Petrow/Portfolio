<?php
require 'bdd.php';
require 'header.php';
?>

<!-------------->
<!-- Masthead -->
<!-------------->
<header class="headerinscription mb-3 mb-md-5"></header>

<!------------->
<!-- En-tête -->
<!------------->
<section class="page-section" id="connexion">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                <h2 class="mt-0">Formulaire d'inscription</h2>
                <hr class="divider" />
                <p class="text-muted mb-5">Pour vous connecter à votre compte, cliquer <a href="/connexion.php">ici</a> !</p>
            </div>
        </div>
        <!-- Formulaire d'inscription -->
        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
            <div class="col-lg-6">
                <form id="contactForm" data-sb-form-api-token="API_TOKEN" method="POST" action="action.php">
                    <!-- Nom input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="nom" type="text" name="nom" placeholder="Saisir votre nom..." data-sb-validations="required" required />
                        <label for="nom">Nom <small>*</small></label>
                        <div class="invalid-feedback" data-sb-feedback="nom:required">Votre nom est requis.</div>
                    </div>
                    <!-- Prenom input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="prenom" type="text" name="prenom" placeholder="Saisir votre prénom..." data-sb-validations="required" required />
                        <label for="prenom">Prénom <small>*</small></label>
                        <div class="invalid-feedback" data-sb-feedback="prenom:required">Votre prénom est requis.</div>
                    </div>
                    <!-- Anniversaire input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="anniv" type="date" name="anniv" placeholder="Saisir votre prénom..." data-sb-validations="required" />
                        <label for="anniv">Anniversaire</label>
                        <div class="invalid-feedback" data-sb-feedback="anniv:required">La date d'anniversaire est requise</div>
                    </div>
                    <!-- Adresse input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="address" type="text" name="address" placeholder="Saisir votre prénom..." data-sb-validations="required" />
                        <label for="address">Adresse</label>
                        <div class="invalid-feedback" data-sb-feedback="address:required">Votre adresse est requise</div>
                    </div>
                    <!-- Complément d'adresse input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="complement" type="text" name="complement" placeholder="Saisir votre prénom..." />
                        <label for="complement">Complément d'adresse</label>
                    </div>
                    <!-- Code postal input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="zip" type="text" name="zip" placeholder="Saisir votre prénom..." data-sb-validations="required" />
                        <label for="zip">Code postal</label>
                        <div class="invalid-feedback" data-sb-feedback="zip:required">Votre code postal est requis</div>
                    </div>
                    <!-- Ville input -->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="ville" type="text" name="ville" placeholder="Saisir votre prénom..." data-sb-validations="required" />
                        <label for="ville">Ville</label>
                        <div class="invalid-feedback" data-sb-feedback="ville:required">Votre ville est requise</div>
                    </div>
                    <!-- Email input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" type="email" name="email" placeholder="nom@exemple.com" data-sb-validations="required,email" required />
                        <label for="email">E-mail <small>*</small></label>
                        <div class="invalid-feedback" data-sb-feedback="email:required">Votre email est requis.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Adresse mail invalide.</div>
                    </div>
                    <!-- Téléphone portable input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="phone" type="text" name="port" placeholder="01 02 03 04 05" required />
                        <label for="phone">Téléphone portable <small>*</small></label>
                    </div>
                    <!-- Téléphone fixe input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="fixe" type="text" name="fixe" placeholder="01 02 03 04 05" />
                        <label for="fixe">Téléphone fixe</label>
                    </div>
                    <!-- Bénéficiaire l'inscription ? -->
                    <div>
                        <p>L'inscription est pour :</p>
                        <input type="radio" name="perso" value="0" checked>
                        <label for="">Vous</label>
                        &emsp;
                        <input type="radio" name="perso" value="1">
                        <label for="">Un proche</label>
                    </div>
                    <br>
                    <!-- Motif de l'inscription -->
                    <div>
                        <p>Pour quelle raison vous inscrivez-vous ?</p>
                        <select name="urgent" class="form-select">
                            <?php
                            require_once 'bdd.php';

                            $sql = $bdd->query("SELECT * FROM site_urgent ORDER BY nom DESC");
                            $sql->execute(array());
                            $result = $sql->fetchAll();

                            foreach ($result as $choice) :
                            ?>
                                <option value="<?php echo ($choice['id_urgent']); ?>"><?php echo ($choice['nom']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br>
                    <!-- Mot de passe input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="mdp" type="password" name="mdp" placeholder="nom@exemple.com" data-sb-validations="required" />
                        <label for="mdp">Mot de passe</label>
                        <div class="invalid-feedback" data-sb-feedback="mdp:required">Votre email est requis.</div>
                    </div>
                    <!-- Confirmation du mot de passe input-->
                    <div class="form-floating mb-2">
                        <input class="form-control" id="mdpConf" type="password" name="mdpConf" placeholder="nom@exemple.com" data-sb-validations="required" />
                        <label for="mdpConf">Confirmez le mot de passe</label>
                        <div class="invalid-feedback" data-sb-feedback="mdpConf:required">Votre email est requis.</div>
                    </div>
                    <input type="hidden" name="reponse_recaptcha" id="ReponseRecaptcha">
                    <div class="col-3 small mb-4">
                        <small>* Champs obligatoires</small>
                    </div>
                    <!-- Validation CGU -->
                    <div class="my-4">
                        <input type="checkbox" name="cguInscription" id="cguInscription">
                        <label for="cguInscription" class="cgu ps-1">J'accepte les conditions générales d'utilisation</label>
                        <a class=" border btn btn-light btn-sm ms-3 py-0 px-1 lienCGU" id="boutonCGUInscription"><small>Consulter les CGU</small></a>
                    </div>
                    <!-- Conditions Générales d'Utilisation -->
                    <div class="col border rounded mx-auto cguModal" id="conditionsInscription">
                        <div class="col bg-light">
                            <h1 class="mb-2 p-2">Pompes Funèbres <?php echo ($donneesSociete['nom']) ?></h1>
                            <h2 class="p-2">Conditions générales d'Utilisation</h2>
                            <hr class="gray">
                        </div>
                        <div class="col p-2 ">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe eum nesciunt amet libero delectus id beatae vel consequatur quas cumque? Vero perspiciatis maiores
                                magni esse voluptas ab neque placeat, optio, non laborum ea accusamus. Veritatis doloremque aperiam dolore animi, ratione, quaerat molestiae nisi quibusdam culpa
                                fugiat possimus modi dolorem eum magnam perferendis repellat quasi nemo, laboriosam beatae repellendus. Veniam vel nisi rem et nam, ab sit quae blanditiis, id
                                adipisci harum debitis est incidunt ex enim repudiandae culpa ducimus quia nemo laudantium necessitatibus. Sapiente aspernatur autem reiciendis sit iste inventore
                                alias! Distinctio dolore recusandae hic quia reprehenderit! Neque perspiciatis ipsa alias id odio quam, deleniti voluptates eius et asperiores unde dolorum suscipit
                                ex repellendus amet quis accusamus similique! Temporibus harum atque unde in amet nam officia sit ea expedita id numquam pariatur cum, aliquid nihil explicabo
                                perferendis magni error voluptatibus exercitationem dolores, esse facere veritatis ducimus! Praesentium quisquam dicta nostrum ullam, minima cupiditate iste
                                voluptatum odio vitae deleniti saepe dolorum ex ipsa, velit culpa explicabo porro quod, tempore fuga atque esse unde delectus ratione! Aperiam dignissimos modi
                                soluta aspernatur excepturi expedita harum repudiandae magnam maiores repellat, esse laborum inventore aut eius commodi quisquam a quas, dolore totam, mollitia rem
                                id sit. Commodi ipsa temporibus deserunt nemo, repellat reiciendis dolorem. Odit adipisci distinctio odio? Perspiciatis ratione, minima repellendus placeat eos
                                minus debitis consequuntur est at, fuga molestiae similique odio! Fuga, voluptates! Numquam in dolore impedit, unde vero autem minima quod architecto ullam dolores
                                ratione quis voluptas ducimus expedita. Nihil excepturi ipsa mollitia. Cupiditate officiis inventore dignissimos nostrum enim, eius laboriosam excepturi quisquam
                                accusantium provident quidem facere esse possimus deleniti. Commodi nobis minima voluptatem quisquam ut, accusamus error labore animi quos nam molestiae. In
                                voluptatum minima vero quam eum nulla sed perferendis accusantium accusamus? Voluptate ex ipsam sint eius rem corrupti ut. Quam, provident! Iure repellat temporibus
                                delectus. Quae quis maxime tempore harum rem molestiae illum vero! Vitae delectus numquam tenetur rerum veniam, exercitationem accusantium corporis eligendi non
                                unde voluptatibus sint dicta quam voluptas perspiciatis at! Nihil tenetur velit ipsa suscipit recusandae numquam minus expedita quibusdam dicta eligendi! Sunt
                                necessitatibus minus ipsam cupiditate illo tempore consequuntur debitis. Dolores voluptas eveniet tempora commodi recusandae quasi quod quo odio, reiciendis
                                architecto voluptatibus sint ipsam voluptates rerum minus nisi explicabo sit incidunt officia vero facere, qui accusamus deserunt alias! Distinctio rerum
                                consequatur architecto deserunt amet cumque nulla molestias soluta suscipit, corporis voluptatibus consequuntur alias fugiat dolorum porro magnam minus quisquam
                                deleniti eum dolor facere eos? Ad accusamus atque nesciunt? Quia fugit placeat mollitia accusamus atque corrupti perferendis reiciendis et incidunt deserunt ratione
                                est qui illum ipsa, expedita error eaque, odit adipisci esse consectetur beatae delectus quaerat ab! Temporibus dignissimos optio exercitationem animi quis minus
                                esse laborum asperiores quidem. Suscipit ipsa eaque id accusantium quo impedit voluptatum dolorum officiis molestias numquam, reprehenderit tempore, incidunt cum
                                vitae recusandae ut veniam atque minima in, iste debitis facilis maiores aut. Ipsa eaque neque laborum eveniet assumenda aperiam autem sequi explicabo quibusdam
                                exercitationem iure amet, eius facere incidunt odio nisi!</p>
                        </div>
                        <a class="border btn btn-primary m-3" id="accepterCGUInscription">J'accepte les CGU</a>
                        <a class="border btn btn-secondary btn-sm m-3" id="fermerCGUInscription">Fermer</a>
                    </div>
                    <!-- Submit Button-->
                    <div class="d-grid"><button class="btn btn-primary btn-xl" id="submitButton" type="submit" name="formulaireInscription" disabled>Envoyer</button></div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-------------------------->
<!-- Section Informations -->
<!-------------------------->
<section class="page-section bg-primary">
    <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center mx-auto" id="animation3">
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

<!-------------------------------->
<!-- Renvoi vers Nous Contacter -->
<!-------------------------------->
<section class="page-section bg-dark">
    <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center mx-auto" id="animation4">
        <div class="col-lg-8 align-self-end">
            <h2 class="text-white font-weight-bold">Vous rencontrez des difficultés pour vous inscrire :</h2>
            <hr class="divider divider-light" />
        </div>
        <div class="col-lg-8 align-self-baseline">
            <a class="btn btn-light btn-xl" href="/contact.php">Contacter&ensp;nous</a>
        </div>
    </div>
</section>

<!------------------------------>
<!-- Script pour le reCaptcha -->
<!------------------------------>
<script src="https://www.google.com/recaptcha/api.js?render=*****"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('*****', {
            action: 'homepage'
        }).then(function(token) {
            document.getElementById('ReponseRecaptcha').value = token
        });
    });
</script>

<script>
    // Activation / Désactivation du bouton Envoyer en fonction de la checkbox CGU
    const cguInscription = document.getElementById('cguInscription');
    const bouton = document.getElementById('submitButton');

    cguInscription.addEventListener('click', () => {

        if (cguInscription.checked == true) {
            bouton.disabled = false;
        } else {
            bouton.disabled = true;
        }
    })

    // Activation de la modal CGU
    const modalButton = document.getElementById('boutonCGUInscription');

    modalButton.addEventListener('click', () => {
        const modal = document.getElementById('conditionsInscription');
        modal.style.display = "block";
    })

    // Fermeture de la modal CGU
    const modalClose = document.getElementById('fermerCGUInscription');

    modalClose.addEventListener('click', () => {
        const modal = document.getElementById('conditionsInscription');
        modal.style.display = "none";
    })

    // Accepter les CGU dans la modal
    const modalAccept = document.getElementById('accepterCGUInscription');

    modalAccept.addEventListener('click', () => {
        const modal = document.getElementById('conditionsInscription');
        modal.style.display = "none";
        cguInscription.checked = true;
        bouton.disabled = false;
    })
</script>

<!-- Footer-->
<?php
require 'footer.php';
?>
<script>
    // Surveillance de la section Informations, pour déclenchement de son animation
    let section3 = document.querySelector('#animation3');
    section3.classList.add('dimension0');
    observer3.observe(section3);

    // Surveillance de la section de renvoie vers Nous Contacter,  pour déclenchement de son animation
    let section4 = document.querySelector('#animation4');
    section4.classList.add('dimension0');
    observer4.observe(section4);
</script>