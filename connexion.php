<!-- FORMULAIRE DE CONNEXION DE MON SITE:
Le formulaire doit avoir deux inputs : “login” et “password”. Lorsque le
formulaire est validé, s’il existe un utilisateur en bdd correspondant à ces
informations, alors l’utilisateur est considéré comme connecté et une (ou
plusieurs) variables de session sont créées. -->
<!-- créer une variable de session = qui stocke le login, le statut (admin/utilisateur) etc... -->

<?php
session_start();

$connect = mysqli_connect('localhost', 'laurasavickaite', 'Lilirosesa1997.', 'laura-savickaite_moduleconnexion');
// $connect = mysqli_connect('localhost', 'root', '', 'laura-savickaite_moduleconnexion');

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
    $_SESSION['utilisateur_prenom']=$value ['prenom'];
    $_SESSION['utilisateur_nom']=$value ['nom'];
    $_SESSION['utilisateur_bio']=$value ['bio'];
    $_SESSION['utilisateur_img']=$value ['imgprofil'];
    $_SESSION['utilisateur_id']=$value ['id'];
  }

  //_____________________

  $repLogin = mysqli_query($connect, "SELECT `login` FROM `utilisateurs` WHERE `login`= '".$login."'");
  //num rows --- si true or false  (1 == la requête marche) si la requête marche ça passe
  if(mysqli_num_rows($repLogin)){
    $repPassword = mysqli_query($connect, "SELECT `password` FROM `utilisateurs` 
    WHERE `password`= '".$password."'");

    if(mysqli_num_rows($repPassword)){
      $_SESSION['utilisateur_login']= $login;
      $_SESSION['utilisateur_password']= $password;
      header('Location:index.php');
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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300&display=swap" rel="stylesheet">
  <title>Connexion || TITRE DE MON SITE</title>
  <link rel="stylesheet" href="connexion.css">
</head>
<body>
    <header>
    <a href="index.php"><img class="leaflogo" src="Images/leaflogo.png" width="30px"></a>
      <p id="indexlien"> Back to the index</p>
    </header>

    <main>

    <article id="connexion_carte">
      <section class="topcarte"><h1>Welcome Back!</h1></section>
      <section id="form_connexion">
        <form action="" method="post">
            <div><?php echo @$logErr; ?></div>
            <div>
                <label for="name">Login :</label>
                <input type="text" id="login" name="user_login"> 
            </div>
            <div>
              <label for="msg">Mot de passe :</label>
              <input type="password" id="pass" name="password">
            </div>
          <button class="boutoninscription" type="submit" name="connexion">Log in</button>
        </form>
      </section>
      <section class="bottomcarte"><p id="bottomtext">Thanks for coming back!</p></section>
    </article>

    <article id="side_connexion">
      <section class="topcarte"></section>
      <section id="bottomcard"></section>
    </article>

    </main>

    <footer>
    
    </footer>
</body>
</html>