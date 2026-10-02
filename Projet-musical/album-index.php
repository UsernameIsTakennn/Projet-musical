<?php
// Affiche la liste de tous les albums

require_once('Classes/CRUD.php');
require_once('Classes/Album.php');

$crud = new CRUD;

$albums = Album::tous($crud);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums - Projet musical</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('nav.php'); ?>

    <main>

        <h1>Albums</h1>

        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Date de sortie</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($albums as $album): ?>
                    <tr>
                        <td>
                            <?= $album['titre'] ?>
                        </td>

                        <td>
                            <?= $album['date_sortie'] ?>
                        </td>

                        <td>
                            <?= $album['description'] ?>
                        </td>

                        <td>
                            <a href="album-show.php?id=<?= $album['id'] ?>">
                                Voir plus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="album-create.php">
            Ajouter un album
        </a>

    </main>

    <?php require_once('footer.php'); ?>

</body>

</html>