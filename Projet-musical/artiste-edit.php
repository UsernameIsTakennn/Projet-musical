<?php
// Formulaire de modification d'un artiste existant
if (!isset($_GET['id']) or $_GET['id'] == null) {
    header('location:artiste-index.php');
    die();
}

$id = $_GET['id'];

require_once('Classes/CRUD.php');
require_once('Classes/Artiste.php');

$crud = new CRUD;
$artiste = Artiste::trouver($crud, $id);

if ($artiste) {
    extract($artiste);
} else {
    header('location:artiste-index.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'artiste</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('nav.php'); ?>

    <main>
        <div class="container">

            <form action="artiste-update.php" method="post">

                <h2>Modifier l'artiste</h2>

                <input type="hidden" name="id" value="<?= $id; ?>">

                <label>Nom
                    <input type="text" name="nom" value="<?= $nom; ?>" required>
                </label>

                <label>Pays
                    <input type="text" name="pays" value="<?= $pays; ?>">
                </label>

                <label>Date de naissance
                    <input type="date" name="date_naissance" value="<?= $date_naissance; ?>">
                </label>

                <label>Biographie
                    <input type="text" name="biographie" value="<?= $biographie; ?>">
                </label>

                <input type="submit" value="Enregistrer">

            </form>

        </div>
    </main>

    <?php require_once('footer.php'); ?>

</body>

</html>