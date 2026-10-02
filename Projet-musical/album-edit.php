<?php
// Formulaire de modification d'un album existant
if (!isset($_GET['id']) or $_GET['id'] == null) {
    header('location:album-index.php');
    die();
}

$id = $_GET['id'];

require_once('Classes/CRUD.php');
require_once('Classes/Album.php');
require_once('Classes/Artiste.php');

$crud = new CRUD;

$album = Album::trouver($crud, $id);

if ($album) {
    extract($album);
} else {
    header('location:album-index.php');
    die();
}

$artistes = Artiste::tous($crud);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'album</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('nav.php'); ?>

    <main>
        <div class="container">

            <form action="album-update.php" method="post">

                <h2>Modifier l'album</h2>

                <input type="hidden" name="id" value="<?= $id; ?>">

                <label>Titre
                    <input type="text" name="titre" value="<?= $titre; ?>" required>
                </label>

                <label>Date de sortie
                    <input type="date" name="date_sortie" value="<?= $date_sortie; ?>">
                </label>

                <label>Description
                    <input type="text" name="description" value="<?= $description; ?>">
                </label>

                <label>Artiste
                    <select name="artiste_id">
                        <option value="">— Aucun —</option>

                        <?php foreach ($artistes as $artiste) { ?>
                            <option value="<?= $artiste['id']; ?>"
                                <?= ($artiste['id'] == $artiste_id) ? 'selected' : ''; ?>>
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