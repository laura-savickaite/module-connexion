<!-- PAGE ADMIN :
Cette page est accessible UNIQUEMENT pour l’utilisateur “admin”. Elle
permet de lister l’ensemble des informations des utilisateurs présents dans
la base de données. -->

<?php
session_start();
//var_dump($_SESSION);
$connect = mysqli_connect('localhost', 'root', '', 'moduleconnexion');

if (!isset($_SESSION['utilisateur_id'])){
    header('Location:index.php');
} else {
  $pls=mysqli_query($connect, "SELECT `id` FROM `utilisateurs` WHERE `id`= '".$_SESSION['utilisateur_id']."'");
  $rpls = mysqli_fetch_array($pls, MYSQLI_ASSOC);

    foreach($rpls as $index){

      if($index !== "1"){
        header('Location:index.php');
      }
    }
}

mysqli_set_charset($connect,"utf8");

$utilisateurs = mysqli_query ($connect, "SELECT * FROM `utilisateurs`");

$recup = mysqli_fetch_all($utilisateurs, MYSQLI_ASSOC);

if (isset($_POST['deco'])){
  session_destroy();
  header('Location:connexion.php');
}

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin || AACLF</title>
  <link rel="stylesheet" href="UC.css">
</head>
<body>
    <header>
    <form action="admin.php" method="post">
        <button type="submit" name="deco">Deconnexion</button>
    </form>
    </header>

    <main>
      <table>
        
      </table>
    </main>

    <footer>

    </footer>
</body>
</html>