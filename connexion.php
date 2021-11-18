<!-- FORMULAIRE DE CONNEXION DE MON SITE:
Le formulaire doit avoir deux inputs : “login” et “password”. Lorsque le
formulaire est validé, s’il existe un utilisateur en bdd correspondant à ces
informations, alors l’utilisateur est considéré comme connecté et une (ou
plusieurs) variables de session sont créées. -->
<!-- créer une variable de session = qui stocke le login, le statut (admin/utilisateur) etc... -->

<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'moduleconnexion');

//var_dump ($_SESSION);

if(isset($_POST['connexion'])){
  $login=$_POST['user_login'];
  $password=$_POST['password'];

  $login=htmlentities(trim($login));
  $password=htmlentities(trim($password));

//_____________________
//ces informations récoltées sont utilisées dans profil.php
  $repTest = mysqli_query($connect, "SELECT * FROM `utilisateurs` WHERE `login`= '".$login."'");
  $rTest = mysqli_fetch_all($repTest,MYSQLI_ASSOC);
  foreach ($rTest as $value){
    var_dump ($value);
    
  }

  //_____________________

  $repLogin = mysqli_query($connect, "SELECT `login` FROM `utilisateurs` WHERE `login`= '".$login."'");
  $repImg = mysqli_query($connect, "SELECT `imgprofil` FROM `utilisateurs` WHERE `login`= '".$login."'");
  $img=mysqli_fetch_assoc($repImg);
  //num rows --- si true or false  (1 == la requête marche) si la requête marche ça passe
  if(mysqli_num_rows($repLogin)){
    $repPassword = mysqli_query($connect, "SELECT `password` FROM `utilisateurs` 
    WHERE `password`= '".$password."'");

    if(mysqli_num_rows($repPassword)){
      $_SESSION['utilisateur_login']= $login;
      $_SESSION['utilisateur_password']= $password;
      $_SESSION['utilisateur_img']=$img;
      //____________________
      //pareillement elles seront usées dans profil.php
      $_SESSION['utilisateur_prenom']=$prenom;
      $_SESSION['utilisateur_nom']=$nom;
      $_SESSION['utilisateur_bio']=$bio;


      // header('Location: index.php');
    }else {
    $logErr = "Le mot de passe ou le login rentrés ne sont pas corrects.";
  }
  }

  $repLogin = mysqli_query($connect, "SELECT `login` FROM `utilisateurs` WHERE `login`= '".$login."'");
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
          <input type="password" id="pass" name="password">
        </div>
      <button type="submit" name="connexion">Log in</button>
    </form>
    </main>

    <footer>
    
    </footer>
</body>
</html>