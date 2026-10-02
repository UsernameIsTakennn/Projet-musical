<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Projet musique</title>
</head>

<body>
    <?php require_once('nav.php'); ?>
    <main>
        <section>
            <div>
                <h1>Projet musical</h1>
                <p>Un système de gestion simple pour découvrir les artistes, explorer leurs albums,  consulter leurs chansons et consulter les genres musicaux.</p>
            </div>
        </section>

        <section>
            <h3>Artistes</h3>
            <a href="artiste-index.php">
                <p>Découvrez les artistes!</p>
            </a>

            <h3>Albums</h3>
            <a href="album-index.php">
                <p>Explorez les albums!</p>
            </a>

            <h3>Chansons</h3>
            <a href="chanson-index.php">
                <p>Consultez les chansons!</p>
            </a>

            <h3>Genres</h3>
            <a href="genre-index.php">
                <p>Découvrez les genres musicaux!</p>
            </a>
        </section>
    </main>

    <?php require_once('footer.php'); ?>
</body>

</html>