<?php

// Traite le formulaire de modification d'un genre et redirige vers sa fiche

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:genre-index.php');
    die();
}

require_once('Classes/CRUD.php');
require_once('Classes/Genre.php');

$crud = new CRUD;

$genre = new Genre(
    $_POST['id'],
    $_POST['nom']
);

$update = $genre->modifier($crud);

if ($update) {
    if ($_POST['chanson_id'] !== '') {
        $genre->ajouterChanson($crud, $_POST['chanson_id']);
    }

    header('location:genre-show.php?id=' . $_POST['id']);
} else {
    echo "Erreur de la mise à jour";
}
