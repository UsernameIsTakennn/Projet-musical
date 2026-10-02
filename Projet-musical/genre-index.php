<?php
// Affiche la liste de tous les genres

require_once('Classes/CRUD.php');
require_once('Classes/Genre.php');

$crud = new CRUD;

$genres = Genre::tous($crud);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genres - Catalogue musical</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('nav.php'); ?>

    <main>

        <h1>Genres</h1>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($genres as $genre): ?>
                    <tr>
                        <td>
                            <?= $genre['nom'] ?>
                        </td>

                        <td>
                            <a href="genre-show.php?id=<?= $genre['id'] ?>">
                                Voir plus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="genre-create.php">
            Ajouter un genre
        </a>

    </main>

    <?php require_once('footer.php'); ?>

</body>

</html>