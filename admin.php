<!-- PAGE ADMIN :
Cette page est accessible UNIQUEMENT pour l’utilisateur “admin”. Elle
permet de lister l’ensemble des informations des utilisateurs présents dans
la base de données. -->

<?php
session_start();
//var_dump($_SESSION);

$connect = mysqli_connect('localhost', 'laurasavickaite', 'Lilirosesa1997.', 'laura-savickaite_moduleconnexion');
// $connect = mysqli_connect('localhost', 'root', '', 'laura-savickaite_moduleconnexion');

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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300&display=swap" rel="stylesheet">
  <title>Admin || AACLF</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body>
    <header>
    <a href="index.php"><img class="leaflogo" src="Images/leaflogo.png" width="30px"></a>
      <p id="indexlien"> Back to the index</p>
    <form action="admin.php" method="post">
        <button id="deco" type="submit" name="deco">Deconnexion</button>
    </form>
    </header>

    <main>
      <table>
      <thead>
        <tr>
            <th>login</th>
            <th>prenom</th>
            <th>nom</th>
            <th>mot de passe</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($utilisateurs as $value){
            echo "<tr><td>". $value ['login'] ."</td>";
            echo "<td>". $value ['prenom'] ."</td>";
            echo "<td>". $value ['nom'] ."</td>";
            echo "<td>". $value ['password'] ."</td></tr>";
        }
        ?>
    </tbody>
      </table>
    </main>

    <footer>

    </footer>
</body>
</html>