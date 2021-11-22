<!-- PROFIL DU CONNECTE :
Cette page possède un formulaire permettant à l’utilisateur de modifier ses
informations. Ce formulaire est par défaut pré-rempli avec les informations
qui sont actuellement stockées en base de données. -->

<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'moduleconnexion');

if(!isset($_SESSION['utilisateur_id'])){
  header('Location:connexion.php');
}

$profil=mysqli_query($connect, 'SELECT * FROM `utilisateurs` WHERE `id`= "'.$_SESSION['utilisateur_id']."'");

//le bout de code suivant est seulement pour l'image de profil -- non demandé par la consigne
  if (isset($_POST['sauvimg'])){
    //$_FILES gets all the information from the uploaded file from an imput from a form
    $file=$_FILES['profilImg'];
    //print_r($file);
    //le ['name'] en dessous va donner le nom que l'on voit dans l'array disponible avec le var_dump d'au-dessus etc...pour ce qui suit (type...)
    $fileName=$_FILES['profilImg']['name'];
    $fileType=$_FILES['profilImg']['type'];
    //tmp_name == l'image n'est pas upload, so the image is stockée somewhere temporary
    //if error = 0 pas d'erreur if 1 une erreur
    $fileTmpName=$_FILES['profilImg']['tmp_name'];
    $fileSize=$_FILES['profilImg']['size'];
    $fileError=$_FILES['profilImg']['error'];

    //which files - donc leur extension - we want to allow:
    $fileExt = explode('.', $fileName); // we want to explode the name by the dot pour avoir le nom d'un côté et son extension de l'autre
    $fileActExt = strtolower(end($fileExt)); //ici on fait en sorte que l'extension upload soit en minuscule pck certains peuvent upload avec JPG et rend le truc plus facile à manage si tout est pareil
    //end -> goes to the last piece of data from an array ici on l'a quand on utilise la fonction explode

    $allowedExt = array('jpeg', 'jpg', 'png');
    
    if (in_array($fileActExt, $allowedExt)){

      if ($fileError === 0){
        
        if ($fileSize < 1000000){
          
          //when upload the file it gets a proper name :: on va alors créer un id unique :
          $fileNewName = uniqid('', true).".".$fileActExt; //on a rajouté l'extension sinon renommé sans extension et donc ce n'est plus une image
          //on veut lui dire où il va être envoyé
        
          $fileDestination = "Uploads/".$fileNewName;

          move_uploaded_file($fileTmpName, $fileDestination);

          $queryInsert = mysqli_query($connect, "UPDATE `utilisateurs` SET `imgprofil`='$fileNewName' WHERE `login`= '".$_SESSION['utilisateur_login']."'");
           
          header('Location:connexion.php');

          $data = mysqli_fetch_array($queryInsert);

          while($data = mysqli_fetch_array($queryInsert)){ ?>
            <img class="profilimg" src="Uploads/<?php echo $_SESSION['utilisateur_img']; ?>" alt="Profile picture" class='profil' width="180px" height="185px">
          
        <?php
         }
         
        }else {
          $sizeErr .= "Le fichier est trop lourd.";
        }
      }else {
        $pictureErr .= "Il y a une erreur dans le fichier.";
      }
    }else{
      $profilErr .= "Ce type de fichier n'est pas pris en compte par le site web. Extensions possibles : .jpeg, .jpg et .png.";
    }
  }
  
  if (isset($_POST['enregistrer'])){
    //var_dump([$_POST]);
      $newLogin = $_POST['user_login'];
      $newFirstname = $_POST['user_firstname'];
      $newLastname = $_POST['user_lastname'];
      $newPassword = $_POST['password'];
      $newConfpass = $_POST['password2'];
      $newBio = $_POST['user_bio'];

      if ($newConfpass !== $newPassword) {
        $confpasswordErr .= "Le mot de passe et sa confirmation ne sont pas les mêmes.";
      }

      $rpLogin = mysqli_query($connect, "SELECT `login` FROM `utilisateurs` WHERE `login`= '".$newLogin."'");
      // $repLogin = mysqli_fetch_all($queryLogin, MYSQLI_ASSOC);  
        if(mysqli_num_rows($rpLogin)){
          $loginErr .= "Ce nom d'utilisateur est déjà pris.";}


     $queryUpdate = mysqli_query($connect, "UPDATE `utilisateurs` SET `login`='$newLogin',`prenom`='$newFirstname',`nom`='$newLastname',`password`='$newPassword',`bio`='$newBio' WHERE `login`= '".$_SESSION['utilisateur_login']."'");

  header('Location:connexion.php');
  }

  if (isset($_POST['deco'])){
    session_destroy();
    header('Location:connexion.php');
  }


  ?>
<img class="profilimg" src="Uploads/<?php echo $_SESSION['utilisateur_img']; ?>" alt="Profile picture" class='profil' width="180px" height="185px">




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
  <title>Profil || TITRE DE MON SITE</title>
  <link rel="stylesheet" href="profil.css">
</head>
<body>
    <header>
    <a href="index.php"><img class="leaflogo" src="Images/leaflogo.png" width="30px"></a>
      <p id="indexlien"> Back to the index</p>
    <form action="profil.php" method="post">
        <input id="deco" type="submit" name="deco" value="Deconnexion"></input>
    </form>
    </header>

    <main>
      
      <article id="passeport">
        <div id="toppasseport"><p id="titre">- Passeport de <?php echo $_SESSION['utilisateur_login']; ?> -</p></div>
        <div id="row">
        <section id="pourimage">
        <div class="contourimg"></div>
          <form action="profil.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="profilImg">
                <span><?php echo $profilErr; echo $pictureErr; echo $sizeErr; ?></span>
                <input class="boutonsauv" type="submit" name="sauvimg" value="Sauvegarder">
          </form>
        </section>
        
      
        <section id="pourtext">
          <div id="bio">
            <input class="bubble-text sb14" type="text" value="<?php echo $_SESSION['utilisateur_bio'] ?>" id="bio" name="user_bio">
          </div>

              <label for="name">Login</label>
              <input class="formpourtext" type="text" value="<?php echo $_SESSION['utilisateur_login'] ?>" id="login" name="user_login"> 
              <!-- <span class="error">*<?php echo $loginErr;?></span> -->

            <div id="nomprenom">
              <label for="name">Prénom</label>
              <input class="formpourtext" type="text" value="<?php echo $_SESSION['utilisateur_prenom'] ?>" id="firstname" name="user_firstname">
              <label for="name">Nom</label>
              <input class="formpourtext" type="text" value="<?php echo $_SESSION['utilisateur_nom'] ?>" id="lastname" name="user_lastname">
            </div>

            <label for="msg">Mot de passe</label>
            <input class="formpourtext" type="password" id="pass" name="password"><p><span class="error">
            <label for="msg">Confirmation du mot de passe</label>
            <input class="formpourtext" type="password" id="pass2" name="password2">*<?php echo $confpasswordErr;?>  

                  <button class="boutoninscription" type="submit" name="enregistrer">Save the changes</button>
        </form>
      </section>
      </div>
      <div id="bottompasseport"><p id="port"><<<<<<<<<<<<<<<<<<<<<<<<<<<<<</p></div>
      </article>
    </main>

    <footer>
    
    </footer>
</body>
</html>

