<?php
// Affiche la fiche d'une chanson, incluant ses genres

if (!isset($_GET['id']) or $_GET['id'] == null) {
    header('location:chanson-index.php');
    die();
}

$id = $_GET['id'];

require_once('Classes/CRUD.php');
require_once('Classes/Chanson.php');

$crud = new CRUD;

$chansonData = Chanson::trouver($crud, $id);

if ($chansonData) {
    $chanson = new Chanson(
        $chansonData['id'],
        $chansonData['titre'],
        $chansonData['duration'],
        $chansonData['date_sortie'],
        $chansonData['album_id']
    );
} else {
    header('location:chanson-index.php');
    die();
}

$genres = $chanson->genres($crud);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chanson — <?= $chansonData['titre']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('nav.php'); ?>

    <main>

        <div class="container">

            <h1><?= $chansonData['titre']; ?></h1>

            <p>
                <strong>Durée : </strong>
                <?= $chansonData['duration']; ?>
            </p>

            <p>
                <strong>Date de sortie : </strong>
                <?= $chansonData['date_sortie']; ?>
            </p>

            <h3>Genres</h3>

            <?php if (count($genres) > 0) { ?>

                <ul>
                    <?php foreach ($genres as $genre) { ?>
                        <li>
                            <a href="genre-show.php?id=<?= $genre['id']; ?>">
                                <?= $genre['nom']; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>

            <?php } else { ?>

                <p>Aucun genre associé pour l'instant.</p>

            <?php } ?>

            <a href="chanson-edit.php?id=<?= $id; ?>" class="bouton_modifier">
                Modifier
            </a>

            <form action="chanson-delete.php" method="post" style="display:inline">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="submit" value="Supprimer" class="btn red">
            </form>

        </div>

    </main>

    <?php require_once('footer.php'); ?>

</body>

</html>