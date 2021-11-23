<!-- MA PAGE D'ACCUEIL DU SITE -->
<?php
session_start();
//var_dump($_SESSION);
$connect = mysqli_connect('localhost', 'laurasavickaite', 'Lilirosesa1997.', 'laura-savickaite_moduleconnexion');


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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300&display=swap" rel="stylesheet">
  <title>Accueil || AACLF</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
            <?php if(!isset($_SESSION['utilisateur_id'])){ 
            
            ?>
          <div class="topindex">
            <a href="connexion.php">Log in</a>
            <a href="inscription.php">Register</a>
          </div>

          <?php
            
          }
          else { 
            ?>

              <a href="profil.php">Mon profil</a>
              <form action="index.php" method="post">
                  <input id="deco" type="submit" name="logout" value="Deconnexion"></input>
              </form>
            
        <?php
        } 
        $query=mysqli_query($connect, "SELECT `id` FROM `utilisateurs` WHERE `id`= '".$_SESSION['utilisateur_id']."'");
        $reponse = mysqli_fetch_array($query, MYSQLI_ASSOC);
        foreach($reponse as $admindex){

          if($admindex == "1"){ ?>
          <a href="admin.php">Tableau Admin</a>
          <?php

          }
        }
                ?>
        <img id="imgprofil" src="Uploads/<?php echo $_SESSION['utilisateur_img']; ?>" alt="Profile picture" class='profil' width="100px" height="100px">
        <div id="labio"><p id="text"><?php echo $_SESSION['utilisateur_bio']; ?> </p></div>
    </header>

    <main>
        
    <div class="home-title">
        <p id="titresite">An Animal Crossing Little Fansite</p>
    </div>
        
      <a href="https://github.com/laura-savickaite/module-connexion"><img class="github" src="Images/github.png" width="50px"></a>
      <img class="ilot" src="Images/melimelonook.png" width="600px">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
       <path fill="#91e2f5" fill-opacity="1" d="M0,32L40,37.3C80,43,160,53,240,96C320,139,400,213,480,218.7C560,224,640,160,720,154.7C800,149,880,203,960,192C1040,181,1120,107,1200,74.7C1280,43,1360,53,1400,58.7L1440,64L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path>
     </svg>

    </main>

    <footer>
    
    </footer>
</body>
</html>