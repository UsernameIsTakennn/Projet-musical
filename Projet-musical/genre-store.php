<?php

// Enregistre un nouveau genre dans la base de données

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:genre-index.php');
    die();
}

require_once('Classes/CRUD.php');
require_once('Classes/Genre.php');

$crud = new CRUD;

$genre = new Genre(
    null,
    $_POST['nom']
);

$insert = $genre->enregistrer($crud);

if ($insert) {
    header("location:genre-show.php?id=$insert");
} else {
    header("location:genre-index.php");
}
