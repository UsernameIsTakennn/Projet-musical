<?php

// Supprime une chanson

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location:chanson-index.php');
    die();
}

require_once('Classes/CRUD.php');
require_once('Classes/Chanson.php');

$id = $_POST['id'];

$crud = new CRUD;

$chanson = new Chanson($id);

$delete = $chanson->supprimer($crud);

if ($delete) {
    header('location:chanson-index.php');
} else {
    echo "Erreur : Impossible de supprimer la chanson.";
}
