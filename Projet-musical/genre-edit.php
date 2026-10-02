<?php
// Formulaire de modification d'un genre existant

if (!isset($_GET['id']) or $_GET['id'] == null) {
    header('location:genre-index.php');
    die();
}

$id = $_GET['id'];

require_once('Classes/CRUD.php');
require_once('Classes/Genre.php');
require_once('Classes/Chanson.php');

$crud = new CRUD;

$genre = Genre::trouver($crud, $id);

if ($genre) {
    extract($genre);
} else {
    header('location:genre-index.php');
    die();
}

$chansons = Chanson::tous($crud);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le genre</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('nav.php'); ?>

    <main>
        <div class="container">

            <form action="genre-update.php" method="post">

                <h2>Modifier le genre</h2>

                <input type="hidden" name="id" value="<?= $id; ?>">

                <label>Nom
                    <input type="text" name="nom" value="<?= $nom; ?>" required>
                </label>

                <label>Chanson
                    <select name="chanson_id">
                        <option value="">— Aucun —</option>

                        <?php foreach ($chansons as $chanson) { ?>
                            <option value="<?= $chanson['id']; ?>"
                                <?= ($chanson['id'] == $chanson_id) ? 'selected' : ''; ?>>
                                <?= $chanson['titre']; ?>
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