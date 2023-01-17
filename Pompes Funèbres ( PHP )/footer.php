<footer class="footerbg py-3 mt-3 border-top" id="footer">
    <div class="mx-auto" style="width: fit-content;">
        <div class="row mx-auto my-2 my-lg-2 justify-content-center align-items-center">
            <a class="nav-link liensfooter" href="/emplois.php" style="width: fit-content;">Offres d'emplois</a>
            <span class="nav-link separateurV1" style="width: fit-content;">|</span>
            <a class="nav-link liensfooter" href="/spontanee.php" style="width: fit-content;">Candidatures spontannées</a>
        </div>
        <div class="text-center">
            <span class="separateurH" style="width: fit-content;"><i class="bi bi-dash-lg"></i></span>
        </div>
        <!-- Liens RGPD et CGU -->
        <div class="row mx-auto my-2 my-lg-0 justify-content-center align-items-center">
            <a class="nav-link liensCG text-center" style="width: fit-content;" id="cguFooter">Conditions Générales d'Utilisation</a>
            <span class="nav-link separateurV2" style="width: fit-content;">|</span>
            <a href="rgpd.php" class="nav-link liensCG text-center" style="width: fit-content;">Règlement Général sur la Protection des Données</a>
        </div>
        <div class="text-center">
            <span class="separateurH"><i class="bi bi-dash-lg"></i></span>
        </div>
        <div class="container mt-3 px-4 px-lg-5">
            <div class="small text-center text-muted">Copyright &copy; 2022 - Pompes Funèbres <?= $donneesSociete['nom'] ?></div>
        </div>
    </div>

    <!-- Conditions Générales d'Utilisation -->
    <div class="col-11 border rounded mx-auto cguModal" id="CGU">
        <div class="col-11 bg-light">
            <h1 class="mb-2 p-2">Pompes Funèbres <?php echo ($donneesSociete['nom']) ?></h1>
            <h2 class="p-2">Conditions générales d'Utilisation</h2>
            <hr class="gray">
        </div>
        <div class="col-11 p-2 ">
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
        <a class="border btn btn-primary m-3" id="fermerCGU">Fermer</a>
    </div>

</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- SimpleLightbox plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>

<script src="/js/scripts.js"></script>
<script src="/js/scripts_perso.js"></script>

</body>
<!-------------------------------------------->
<!-- Site réalisé par Petrow Patrice - 2022 -->
<!-------------------------------------------->

</html>