<?php
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
    <title>Nouvelle chanson</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('nav.php'); ?>

    <main>
        <div class="container">
            <form action="chanson-store.php" method="post">
                <h2>Nouvelle chanson</h2>

                <label>Titre
                    <input type="text" name="titre" required>
                </label>

                <label>Durée
                    <input type="time" name="duration" step="1">
                </label>

                <label>Date de sortie
                    <input type="date" name="date_sortie">
                </label>

                <label>Album
                    <select name="album_id">
                        <option value="">— Aucun —</option>

                        <?php foreach ($albums as $album) { ?>
                            <option value="<?= $album['id']; ?>">
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