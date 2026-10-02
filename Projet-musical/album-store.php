<?php

// Enregistre un nouvel album dans la base de données

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:album-index.php');
    die();
}

require_once('Classes/CRUD.php');
require_once('Classes/Album.php');

$crud = new CRUD;

$album = new Album(
    null,
    $_POST['titre'],
    $_POST['date_sortie'] !== '' ? $_POST['date_sortie'] : null,
    $_POST['description'],
    $_POST['artiste_id'] !== '' ? $_POST['artiste_id'] : null
);

$insert = $album->enregistrer($crud);

if ($insert) {
    header("location:album-show.php?id=$insert");
} else {
    header("location:album-index.php");
}
