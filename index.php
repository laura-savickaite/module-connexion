<!-- MA PAGE D'ACCUEIL DU SITE -->
<?php
session_start();
var_dump($_SESSION);

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
    <form action="index.php" method="post">
      <button type="submit" name="logout">Deconnexion</button></form>
    
    </main>

    <footer>
    
    </footer>
</body>
</html>