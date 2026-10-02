<?php

// Enregistre un nouvel artiste dans la base de données

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:artiste-index.php');
    die();
}

require_once('Classes/CRUD.php');
require_once('Classes/Artiste.php');

$crud = new CRUD;

$artiste = new Artiste(
    null,
    $_POST['nom'],
    $_POST['pays'],
    $_POST['date_naissance'] !== '' ? $_POST['date_naissance'] : null,
    $_POST['biographie']
);

$insert = $artiste->enregistrer($crud);

if ($insert) {
    header("location:artiste-show.php?id=$insert");
} else {
    header("location:artiste-index.php");
}
