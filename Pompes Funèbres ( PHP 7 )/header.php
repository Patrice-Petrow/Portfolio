<!DOCTYPE html>
<html lang="fr" prefix="og:https://ogp.me/ns#">

<head>
    <meta property="og:title" content="Pompes Funèbres <?php echo ($donneesSociete['nom']) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://<?= $donneesSociete['domaine'] ?>">
    <meta property="og:site_name" content="Pompes Funèbres <?= $donneesSociete['nom'] ?>">
    <meta property="og:description" content="Pompes Funèbres <?= $donneesSociete['meta_desc'] ?>">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="Etoile Secours" />
    <title>Pompes Funèbres <?= $donneesSociete['nom'] ?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- CSS Bootstrap-->
    <link href="/css/styles.css" rel="stylesheet" />
    <!-- Feuille de style personnalisée -->
    <link href="/css/stylePerso.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-233959180-1"></script>
    <!-- Google Analytics -->
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-233959180-1');
    </script>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top " id="mainNav">
        <div class="container px-4 px-lg-6">
            <img src="/assets/logo/<?php echo ($donneesSociete['logo']) ?>" alt="Logo du site" class="logo" id="logo">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="flase" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse ms-5" id="navbarResponsive">
                <ul class="navbar-nav ms-lg-auto my-2 my-lg-0 align-items-end me-1">
                    <li class="nav-item"><a class="nav-link" href="/index.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact.php">Nous Contacter</a></li>
                    <li class="nav-item"><a class="nav-link" href="/devis.php">Devis</a></li>
                    <li class="nav-item"><a class="nav-link" href="/temoignages.php">Témoignages</a></li>
                    <li class="nav-item"><a class="nav-link" href="/prevoyance.php">Prévoyance</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="offre.php">Notre offre</a></li> -->
                    <!-- <li class="nav-item"><a class="nav-link" href="produits.php">Fleurs</a></li> -->
                    <!-- <li class="nav-item"><a class="nav-link" href="registre.php">Registre des décès</a></li> -->
                    <li class="nav-item"><a class="nav-link" href="/connexion.php">Connexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="/inscription.php">Inscription</a></li>
                </ul>
            </div>
        </div>
    </nav>