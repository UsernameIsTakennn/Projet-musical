<?php

// Supprime un artiste

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:artiste-index.php');
    die();
}

require_once('Classes/CRUD.php');
require_once('Classes/Artiste.php');

$id = $_POST['id'];

$crud = new CRUD;

$artiste = new Artiste($id);

$delete = $artiste->supprimer($crud);

if ($delete) {
    header('location:artiste-index.php');
} else {
    echo "Erreur : Impossible de supprimer l'artiste.";
}
