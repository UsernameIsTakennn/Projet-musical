<?php

// Enregistre une nouvelle chanson dans la base de données

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:chanson-index.php');
    die();
}

require_once('Classes/CRUD.php');
require_once('Classes/Chanson.php');

$crud = new CRUD;

$chanson = new Chanson(
    null,
    $_POST['titre'],
    $_POST['duration'],
    $_POST['date_sortie'] !== '' ? $_POST['date_sortie'] : null,
    $_POST['album_id'] !== '' ? $_POST['album_id'] : null
);

$insert = $chanson->enregistrer($crud);

if ($insert) {
    header("location:chanson-show.php?id=$insert");
} else {
    header("location:chanson-index.php");
}
