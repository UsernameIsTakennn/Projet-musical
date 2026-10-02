<?php
// Affiche la liste de toutes les chansons

require_once('Classes/CRUD.php');
require_once('Classes/Chanson.php');

$crud = new CRUD;

$chansons = Chanson::tous($crud);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chansons - Catalogue musical</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('nav.php'); ?>

    <main>

        <h1>Chansons</h1>

        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Durée</th>
                    <th>Date de sortie</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($chansons as $chanson): ?>
                    <tr>
                        <td>
                            <?= $chanson['titre'] ?>
                        </td>

                        <td>
                            <?= $chanson['duration'] ?>
                        </td>

                        <td>
                            <?= $chanson['date_sortie'] ?>
                        </td>

                        <td>
                            <a href="chanson-show.php?id=<?= $chanson['id'] ?>">
                                Voir plus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="chanson-create.php">
            Ajouter une chanson
        </a>

    </main>

    <?php require_once('footer.php'); ?>

</body>

</html>