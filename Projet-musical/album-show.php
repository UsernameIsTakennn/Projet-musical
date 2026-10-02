<?php
// Affiche la fiche détaillée d'un album, incluant ses chansons

if (!isset($_GET['id']) or $_GET['id'] == null) {
    header('location:album-index.php');
    die();
}

$id = $_GET['id'];

require_once('Classes/CRUD.php');
require_once('Classes/Album.php');

$crud = new CRUD;

$albumData = Album::trouver($crud, $id);

if ($albumData) {
    $album = new Album(
        $albumData['id'],
        $albumData['titre'],
        $albumData['date_sortie'],
        $albumData['description'],
        $albumData['artiste_id']
    );
} else {
    header('location:album-index.php');
    die();
}

$chansons = $album->chansons($crud);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album — <?= $albumData['titre']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('nav.php'); ?>

    <main>

        <div class="container">

            <h1><?= $albumData['titre']; ?></h1>

            <p>
                <strong>Date de sortie : </strong>
                <?= $albumData['date_sortie']; ?>
            </p>

            <p>
                <strong>Description : </strong>
                <?= $albumData['description']; ?>
            </p>

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

            <a href="album-edit.php?id=<?= $id; ?>" class="bouton_modifier">
                Modifier
            </a>

            <form action="album-delete.php" method="post" style="display:inline">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="submit" value="Supprimer" class="btn red">
            </form>

        </div>

    </main>

    <?php require_once('footer.php'); ?>

</body>

</html>