<?php

// Traite le formulaire de modification d'un album et redirige vers sa fiche

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:album-index.php');
    die();
}

require_once('Classes/CRUD.php');
require_once('Classes/Album.php');

$crud = new CRUD;

$album = new Album(
    $_POST['id'],
    $_POST['titre'],
    $_POST['date_sortie'] !== '' ? $_POST['date_sortie'] : null,
    $_POST['description'],
    $_POST['artiste_id'] !== '' ? $_POST['artiste_id'] : null
);

$update = $album->modifier($crud);

if ($update) {
    header('location:album-show.php?id=' . $_POST['id']);
} else {
    echo "Erreur de la mise à jour";
}
