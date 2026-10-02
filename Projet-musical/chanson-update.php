<?php

// Traite le formulaire de modification d'une chanson et redirige vers sa fiche

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:chanson-index.php');
    die();
}

require_once('Classes/CRUD.php');
require_once('Classes/Chanson.php');

$crud = new CRUD;

$chanson = new Chanson(
    $_POST['id'],
    $_POST['titre'],
    $_POST['duration'],
    $_POST['date_sortie'] !== '' ? $_POST['date_sortie'] : null,
    $_POST['album_id'] !== '' ? $_POST['album_id'] : null
);

$update = $chanson->modifier($crud);

if ($update) {
    header('location:chanson-show.php?id=' . $_POST['id']);
} else {
    echo "Erreur de la mise à jour";
}
