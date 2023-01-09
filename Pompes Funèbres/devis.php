<?php
require 'bdd.php';
require 'header.php';
?>

<!-------------->
<!-- Masthead -->
<!-------------->
<header class="headerdevis mb-3 mb-md-5"></header>

<!----------->
<!-- Titre -->
<!----------->
<div class="row justify-content-center mx-auto">
    <div class="col-lg-8 col-xl-6 text-center">
        <h2>Formulaire de demande de devis</h2>
        <hr class="divider mb-5"/>
    </div>
</div>

<!------------------------------------>
<!-- Formulaire de demande de devis -->
<!------------------------------------>
<div class="col-11 col-lg-5 justify-content-center mx-auto">
    <div>
        <div>
            <form action="action.php" method="POST">
                <!-- Type de demande -->
                <h5 style="width: fit-content;" class="mx-auto mb-3 pb-2 border-bottom border-primary ms-0">Objet de votre demande</h5>
                <div style="width: fit-content;" class="row mx-auto ms-0">
                    <div style="width: fit-content;" class="ms-md-4">
                        <input type="radio" name="urgent" id="" value="3" onchange="aff_defunt('non')">
                        <label for="">Prévoyance</label>&emsp;
                    </div>
                    <div style="width: fit-content;">
                        <input type="radio" name="urgent" id="" value="2" onchange="aff_defunt('oui')">
                        <label for="">Une fin de vie</label>&emsp;
                    </div>
                    <div style="width: fit-content;">
                        <input type="radio" name="urgent" id="" value="1" onchange="aff_defunt('oui')">
                        <label for="">Un décès</label>
                    </div>
                </div>
                <!-- Formualire concernant le défunt -->
                <div id="formulaireDefunt" style="display: none;">
                    <h5 style="width: fit-content;" class="mx-auto mt-5 mb-3 pb-2 border-bottom border-primary ms-0">Informations sur le défunt</h5>
                    <!-- Civilités -->
                    <div>
                        <span>Civilités :</span>&emsp;
                        <input type="radio" name="civiliteDefunt" id="" value="0">
                        <label for="">Madame</label>&emsp;
                        <input type="radio" name="civiliteDefunt" id="" value="1">
                        <label for="">Monsieur</label>
                    </div>
                    <!-- Nom -->
                    <div class="my-3">
                        <input type="text" name="nomDefunt" id="" placeholder="Nom" class="form-control">
                    </div>
                    <!-- Prénom -->
                    <div class="my-3">
                        <input type="text" name="prenomDefunt" id="" placeholder="Prénom" class="form-control">
                    </div>
                    <!-- Lieux défunt -->
                    <div class="my-3 row">
                        <div class="mb-2">
                            <span class="fontlabel">Où se trouve le défunt ?</span>&emsp;
                        </div>
                        <div style="width: fit-content;" class="ms-md-4">
                            <input type="radio" name="lieux" id="" value="1" onchange="aff_defunt_lieux('oui')">
                            <label for="">Domicile</label>&emsp;
                        </div>
                        <div style="width: fit-content;">
                            <input type="radio" name="lieux" id="" value="2" onchange="aff_defunt_lieux('oui')">
                            <label for="">Hôpital</label>&emsp;
                        </div>
                        <div style="width: fit-content;">
                            <input type="radio" name="lieux" id="" value="3" onchange="aff_defunt_lieux('non')">
                            <label for="">Ne sais pas</label>
                        </div>
                    </div>
                    <div id="lieux" style="display: none;">
                        <!-- Code postal -->
                        <div class="my-3">
                            <input type="text" name="zip" id="" placeholder="Code postal" class="form-control">
                        </div>
                        <!-- Ville -->
                        <div>
                            <input type="text" name="ville" id="" placeholder="Ville" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- Formulaire Prévoyance -->
                <div>
                    <h5 style="width: fit-content;" class="mx-auto mt-5 mb-3 pb-2 border-bottom border-primary ms-0">Informations sur les obsèques</h5>
                    <!-- Type d'obsèques -->
                    <div class="my-3  row">
                        <div class="mb-2">
                            <span class="fontlabel">Type d'obsèques :</span>&emsp;
                        </div>
                        <div style="width: fit-content;" class="ms-md-4">
                            <input type="radio" name="obseques" id="" value="1">
                            <label for="">Inhumation</label>&emsp;
                        </div>
                        <div style="width: fit-content;">
                            <input type="radio" name="obseques" id="" value="2">
                            <label for="">Crémation</label>&emsp;
                        </div>
                        <div style="width: fit-content;">
                            <input type="radio" name="obseques" id="" value="3">
                            <label for="">Ne sais pas</label>
                        </div>
                    </div>
                    <!-- Cérémonie religieuse -->
                    <div class="my-3 row">
                        <div class="mb-1">
                            <span class="fontlabel">Une cérémonie religieuse aura-t-elle lieux ?</span>&emsp;
                        </div>
                        <div style="width: fit-content;" class="ms-md-4">
                            <input type="radio" name="ceremonie" id="" value="2">
                            <label for="">Oui</label>&emsp;
                        </div>
                        <div style="width: fit-content;">
                            <input type="radio" name="ceremonie" id="" value="1">
                            <label for="">Non</label>&emsp;
                        </div>
                        <div style="width: fit-content;">
                            <input type="radio" name="ceremonie" id="" value="3">
                            <label for="">Ne sais pas</label>
                        </div>
                    </div>
                </div>

                <!-- Formulaire contactant -->
                <div>
                    <h5 style="width: fit-content;" class="mx-auto mt-5 mb-3 pb-2 border-bottom border-primary ms-0">Vos coordonnées</h5>
                    <!-- Civilités -->
                    <div class="my-3">
                        <span>Civilités :</span>&emsp;
                        <input type="radio" name="civiliteContactant" value="0">
                        <label for="">Madame</label>&emsp;
                        <input type="radio" name="civiliteContactant" value="1">
                        <label for="">Monsieur</label>
                    </div class="my-3">
                    <!-- Nom -->
                    <div>
                        <input type="text" name="nomContactant" placeholder="Nom" class="form-control" required>
                    </div>
                    <!-- Prénom -->
                    <div class="my-3">
                        <input type="text" name="prenomContactant" placeholder="Prénom" class="form-control" required>
                    </div>
                    <!-- Téléphone -->
                    <div class="my-3">
                        <input type="text" name="telephone" placeholder="Numéro de téléphone" class="form-control" required>
                    </div>
                    <!-- Mail -->
                    <div class="my-3">
                        <input type="email" name="mail" placeholder="Adresse mail" class="form-control" required>
                    </div>
                    <!-- Commentaires -->
                    <div class="my-3">
                        <label for="commentaires">Commentaires</label>
                    </div>
                    <div class="my-3">
                        <textarea name="commentaires" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <!-- Validation CGU -->
                <div class="my-4">
                    <input type="checkbox" name="cguDevis" id="cguDevis">
                    <label for="cguDevis" class="cgu ps-1">J'accepte les conditions générales d'utilisation</label>
                    <a class="border btn btn-light btn-sm ms-3 py-0 px-1 lienCGU" id="boutonCGUDevis"><small>Consulter les CGU</small></a>
                </div>
                <!-- Conditions Générales d'Utilisation -->
                <div class="col border rounded mx-auto cguModal" id="conditionsDevis">
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
                    <a class="border btn btn-primary m-3" id="accepterCGUDevis">J'accepte les CGU</a>
                    <a class="border btn btn-secondary btn-sm m-3" id="fermerCGUDevis">Fermer</a>
                </div>
                <div class="d-grid">
                    <input type="submit" class="btn btn-primary btn-xl mb-2" name="DevisObseques" value="Envoyer" id="DevisObseques" disabled>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Footer-->
<?php
require 'footer.php';
?>

<script>

    // Activation / Désactivation du bouton Envoyer en fonction de la checkbox CGU
    const cguDevis = document.getElementById('cguDevis');
    const bouton = document.getElementById('DevisObseques');

    cguDevis.addEventListener('click', () => {

        if (cguDevis.checked == true) {
            bouton.disabled = false;
        } else {
            bouton.disabled = true;
        }
    })

    // Activation de la modal CGU
    const modalButton = document.getElementById('boutonCGUDevis');

    modalButton.addEventListener('click', () => {
        const modal = document.getElementById('conditionsDevis');
        modal.style.display = "block";
    })

    // Fermeture de la modal CGU
    const modalClose = document.getElementById('fermerCGUDevis');

    modalClose.addEventListener('click', () => {
        const modal = document.getElementById('conditionsDevis');
        modal.style.display = "none";
    })

    // Accepter les CGU dans la modal
    const modalAccept = document.getElementById('accepterCGUDevis');

    modalAccept.addEventListener('click', () => {
        const modal = document.getElementById('conditionsDevis');
        modal.style.display = "none";
        cguDevis.checked = true;
        bouton.disabled = false;
    })
    
</script>