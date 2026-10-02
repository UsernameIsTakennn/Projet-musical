<?php

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
    <title>Nouvel album</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('nav.php'); ?>

    <main>
        <div class="container">

            <form action="album-store.php" method="post">

                <h2>Nouvel album</h2>

                <label>Titre
                    <input type="text" name="titre" required>
                </label>

                <label>Date de sortie
                    <input type="date" name="date_sortie">
                </label>

                <label>Description
                    <input type="text" name="description">
                </label>

                <label>Artiste
                    <select name="artiste_id">
                        <option value="">— Aucun —</option>

                        <?php foreach ($artistes as $artiste) { ?>
                            <option value="<?= $artiste['id']; ?>">
                                <?= $artiste['nom']; ?>
                            </option>
                        <?php } ?>

                    </select>
                </label>

                <input type="submit" value="Enregistrer">

            </form>

        </div>
    </main>

    <?php require_once('footer.php'); ?>

</body>

</html>