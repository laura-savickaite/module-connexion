<!-- FORMULAIRE DE CONNEXION DE MON SITE:
Le formulaire doit avoir deux inputs : “login” et “password”. Lorsque le
formulaire est validé, s’il existe un utilisateur en bdd correspondant à ces
informations, alors l’utilisateur est considéré comme connecté et une (ou
plusieurs) variables de session sont créées. -->

<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'moduleconnexion');

if(isset($_SESSION['id'])){
  header('Location: index.php');
  exit;
}

if(isset($_POST['connexion'])){
  $login=$_POST['user_login'];
  $password=$_POST['password'];

  $login=htmlentities(trim($login));
  $password=htmlentities(trim($password));

  $repLogin = mysqli_query($connect, "SELECT `login` FROM `utilisateurs` WHERE `login`= '".$login."'");
  if(mysqli_num_rows($repLogin)){
    $repPassword = mysqli_query($connect, "SELECT `password` FROM `utilisateurs` WHERE `password`= '".$password."'");

    if(mysqli_num_rows($repPassword)){
      echo "ok"; 
    }
    if(mysqli_num_rows($repLogin) !== $login && mysqli_num_rows($repPassword) !== $password){
      $logErr = "Le mot de passe ou le login rentrés ne correspondent pas.";
    }
  }

}

?>


<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion || TITRE DE MON SITE</title>
  <link rel="stylesheet" href="UC.css">
</head>
<body>
    <header>

    </header>

    <main>
    <form action="" method="post">
        <div><?php echo $logErr; ?></div>
        <div>
            <label for="name">Login :</label>
            <input type="text" id="login" name="user_login"> 
        </div>
        <div>
          <label for="msg">Mot de passe :</label>
          <input type="password" id="pass" name="password"minlength="8" required>
        </div>
      <button type="submit" name="connexion">Log in</button>
    </form>
    </main>

    <footer>
    
    </footer>
</body>
</html>