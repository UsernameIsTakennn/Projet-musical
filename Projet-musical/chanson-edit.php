<?php
// Formulaire de modification d'une chanson existante

if (!isset($_GET['id']) or $_GET['id'] == null) {
    header('location:chanson-index.php');
    die();
}

$id = $_GET['id'];

require_once('Classes/CRUD.php');
require_once('Classes/Chanson.php');
require_once('Classes/Album.php');

$crud = new CRUD;

$chanson = Chanson::trouver($crud, $id);

if ($chanson) {
    extract($chanson);
} else {
    header('location:chanson-index.php');
    die();
}

$albums = Album::tous($crud);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la chanson</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('nav.php'); ?>

    <main>
        <div class="container">

            <form action="chanson-update.php" method="post">

                <h2>Modifier la chanson</h2>

                <input type="hidden" name="id" value="<?= $id; ?>">

                <label>Titre
                    <input type="text" name="titre" value="<?= $titre; ?>" required>
                </label>

                <label>Durée
                    <input type="time" name="duration" value="<?= $duration; ?>">
                </label>

                <label>Date de sortie
                    <input type="date" name="date_sortie" value="<?= $date_sortie; ?>">
                </label>

                <label>Album
                    <select name="album_id">
                        <option value="">— Aucun —</option>

                        <?php foreach ($albums as $album) { ?>
                            <option value="<?= $album['id']; ?>"
                                <?= ($album['id'] == $album_id) ? 'selected' : ''; ?>>
                                <?= $album['titre']; ?>
                            </option>
                        <?php } ?>

                    </select>
                </label>

                <input type="submit"  value="Enregistrer">

            </form>

        </div>
    </main>

    <?php require_once('footer.php'); ?>

</body>

</html>