<?php

// Supprime un genre

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:genre-index.php');
    die();
}

require_once('Classes/CRUD.php');
require_once('Classes/Genre.php');

$id = $_POST['id'];

$crud = new CRUD;

$genre = new Genre($id);

$delete = $genre->supprimer($crud);

if ($delete) {
    header('location:genre-index.php');
} else {
    echo "Erreur : Impossible de supprimer le genre.";
}
