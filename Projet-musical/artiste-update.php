<?php

// Traite le formulaire de modification d'un artiste et redirige vers sa fiche

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:artiste-index.php');
    die();
}

require_once('Classes/CRUD.php');
require_once('Classes/Artiste.php');

$crud = new CRUD;

$artiste = new Artiste(
    $_POST['id'],
    $_POST['nom'],
    $_POST['pays'],
    $_POST['date_naissance'] !== '' ? $_POST['date_naissance'] : null,
    $_POST['biographie']
);

$update = $artiste->modifier($crud);

if ($update) {
    header('location:artiste-show.php?id=' . $_POST['id']);
} else {
    echo "Erreur de la mise à jour";
}
