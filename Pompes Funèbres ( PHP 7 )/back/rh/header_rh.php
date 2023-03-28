<?php
require 'bdd.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pompes Funèbres <?= $donneesSociete['nom'] ?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../../assets/favicon.ico" />
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../css/styles.css" rel="stylesheet" />
    <!-- Feuille de style peros -->
    <link rel="stylesheet" href="../../css/stylePerso.css">

</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav" style="background-color: #d4c0ee;">
        <div class="container px-4 px-lg-5">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0 mx-auto">
                    <li class="nav-item"><a class="nav-link" href="index_rh.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="selection_annonce_rh.php">Gestion annonce</a></li>
                    <li class="nav-item"><a class="nav-link" href="creation_annonce_rh.php">Création d'une annonce</a></li>
                    <li class="nav-item"><a class="nav-link" href="candidature_rh.php">Candidatures</a></li>
            </div>
        </div>
        <div>
            <form action="action.php" method="POST">
                <button type="submit" name="deconnexionRH" class="btn btn-light btn-sm pull-right me-5">Déconnexion</i></button>
            </form>
        </div>
    </nav>