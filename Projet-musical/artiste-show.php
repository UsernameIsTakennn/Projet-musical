<?php
// Affiche la fiche d'un artiste, incluant ses albums

if (!isset($_GET['id']) or $_GET['id'] == null) {
    header('location:artiste-index.php');
    die();
}

$id = $_GET['id'];

require_once('Classes/CRUD.php');
require_once('Classes/Artiste.php');

$crud = new CRUD;

$artisteData = Artiste::trouver($crud, $id);

if ($artisteData) {
    $artiste = new Artiste(
        $artisteData['id'],
        $artisteData['nom'],
        $artisteData['pays'],
        $artisteData['date_naissance'],
        $artisteData['biographie']
    );
} else {
    header('location:artiste-index.php');
    die();
}

$albums = $artiste->albums($crud);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artiste — <?= $artisteData['nom']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('nav.php'); ?>

    <main>

        <div class="container">

            <h1><?= $artisteData['nom']; ?></h1>

            <p>
                <strong>Pays : </strong>
                <?= $artisteData['pays']; ?>
            </p>

            <p>
                <strong>Date de naissance : </strong>
                <?= $artisteData['date_naissance']; ?>
            </p>

            <p>
                <strong>Biographie : </strong>
                <?= $artisteData['biographie']; ?>
            </p>

            <h3>Albums</h3>

            <?php if (count($albums) > 0) { ?>

                <ul>
                    <?php foreach ($albums as $album) { ?>
                        <li>
                            <a href="album-show.php?id=<?= $album['id']; ?>">
                                <?= $album['titre']; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>

            <?php } else { ?>

                <p>Aucun album associé pour l'instant.</p>

            <?php } ?>

            <a href="artiste-edit.php?id=<?= $id; ?>" class="bouton_modifier">
                Modifier
            </a>

            <form action="artiste-delete.php" method="post" style="display:inline">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="submit" value="Supprimer" class="btn red">
            </form>

        </div>

    </main>

    <?php require_once('footer.php'); ?>

</body>

</html>