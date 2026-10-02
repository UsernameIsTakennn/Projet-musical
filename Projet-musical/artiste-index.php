<?php
// Affiche la liste de tous les artistes

require_once('Classes/CRUD.php');
require_once('Classes/Artiste.php');

$crud = new CRUD;

$artistes = Artiste::tous($crud);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artistes - Projet musical</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('nav.php'); ?>

    <main>

        <h1>Artistes</h1>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Pays</th>
                    <th>Date de naissance</th>
                    <th>Biographie</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($artistes as $artiste): ?>
                    <tr>
                        <td>
                            <?= $artiste['nom'] ?>
                        </td>

                        <td>
                            <?= $artiste['pays'] ?>
                        </td>

                        <td>
                            <?= $artiste['date_naissance'] ?>
                        </td>

                        <td>
                            <?= $artiste['biographie'] ?>
                        </td>

                        <td>
                            <a href="artiste-show.php?id=<?= $artiste['id'] ?>">
                                Voir plus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="artiste-create.php">
            Ajouter un artiste
        </a>

    </main>

    <?php require_once('footer.php'); ?>

</body>

</html>