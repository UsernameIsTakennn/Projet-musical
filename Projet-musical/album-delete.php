<?php

// Supprime un album

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:album-index.php');
    die();
}

require_once('Classes/CRUD.php');
require_once('Classes/Album.php');

$id = $_POST['id'];

$crud = new CRUD;

$album = new Album($id);

$delete = $album->supprimer($crud);

if ($delete) {
    header('location:album-index.php');
} else {
    echo "Erreur : Impossible de supprimer l'album.";
}
