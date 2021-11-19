<!-- MA PAGE D'ACCUEIL DU SITE -->
<?php
session_start();
var_dump($_SESSION);

  if(!isset($_SESSION['utilisateur_login'])){ 
    
    ?>

  <a href="connexion.php">Log in</a>
  <a href="inscription.php">Register</a>

  <?php
    
  }else { ?>
    <a href="profil.php">Mon profil</a>
    <form action="index.php" method="post">
        <button type="submit" name="logout">Deconnexion</button>
    </form>
<?php
}

if (isset($_POST['logout'])){
  session_destroy();
}
?>


<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil || TITRE DE MON SITE</title>
  <link rel="stylesheet" href="UC.css">
</head>
<body>
    <header>

    </header>

    <main>
    
    <img src="Uploads/<?php echo $_SESSION['utilisateur_img']; ?>" alt="Profile picture" class='profil' width="180px" height="185px">
    
    </main>

    <footer>
    
    </footer>
</body>
</html>