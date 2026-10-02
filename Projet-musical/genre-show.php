<?php
// Affiche la fiche d'un genre, incluant ses chansons

if (!isset($_GET['id']) or $_GET['id'] == null) {
    header('location:genre-index.php');
    die();
}

$id = $_GET['id'];

require_once('Classes/CRUD.php');
require_once('Classes/Genre.php');

$crud = new CRUD;

$genreData = Genre::trouver($crud, $id);

if ($genreData) {
    $genre = new Genre(
        $genreData['id'],
        $genreData['nom']
    );
} else {
    header('location:genre-index.php');
    die();
}

$chansons = $genre->chansons($crud);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genre — <?= $genreData['nom']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('nav.php'); ?>

    <main>

        <div class="container">

            <h1><?= $genreData['nom']; ?></h1>

            <h3>Chansons</h3>

            <?php if (count($chansons) > 0) { ?>

                <ul>
                    <?php foreach ($chansons as $chanson) { ?>
                        <li>
                            <a href="chanson-show.php?id=<?= $chanson['id']; ?>">
                                <?= $chanson['titre']; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>

            <?php } else { ?>

                <p>Aucune chanson associée pour l'instant.</p>

            <?php } ?>

            <a href="genre-edit.php?id=<?= $id; ?>" class="bouton_modifier">
                Modifier
            </a>

            <form action="genre-delete.php" method="post" style="display:inline">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="submit" value="Supprimer" class="btn red">
            </form>

        </div>

    </main>

    <?php require_once('footer.php'); ?>

</body>

</html>