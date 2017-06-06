<?php include 'includes/header.php' ?>

<?php
try
{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=Blog;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
?>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Blog</h1>
                        <hr class="small">
                        <span class="subheading">Qu'est ce qui est cool ici ?</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

<?php
// On récupère les 5 derniers billets
$req = $bdd->query('SELECT id, titre, contenu, auteur, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM Blogpost ORDER BY date_creation DESC LIMIT 0, 5');

// On affiche chaque entrée une à une
while ($donnees = $req->fetch())
{
?>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <a href="post.php">
                        <h2 class="post-title">
                           <?php echo htmlspecialchars($donnees['titre']); ?>
                        </h2>
                        <h3 class="post-subtitle">
                            <?php echo htmlspecialchars($donnees['contenu']); ?>
                        </h3>
                    </a>
                    <p class="post-meta">Posted by <?php echo $donnees['auteur']; ?> le <?php echo $donnees['date_creation']; ?></p>
                </div>
                <!-- Pager --> 
            </div>
        </div>
    </div>
    <hr>

<?php
}
$req->closeCursor(); // Termine le traitement de la requête
?>
    <div class="container">
        <ul class="pager">
            <li class="next">
                <a href="#">Plus de posts &rarr;</a>
            </li>
        </ul>
    </div>

<?php include 'includes/footer.php' ?>