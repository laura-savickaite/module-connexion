<!-- PROFIL DU CONNECTE :
Cette page possède un formulaire permettant à l’utilisateur de modifier ses
informations. Ce formulaire est par défaut pré-rempli avec les informations
qui sont actuellement stockées en base de données. -->

<!-- pour PROFILE PICTURE : Write a handler, which takes control of he files

check the mime type by checking the content, not the extension
have arbitrary names, not the name from the upload, that might interfer (imagine 5 people uploading a "profile.png")
let the handler deliver the image by an id ("...imagloader?file=4711"),
name of the file (and extension and location) is stored in a database (with the user record?) -->

<?php
session_start();
var_dump($_SESSION);

$test=$_SESSION['utilisateur_login'];
$test2=$_SESSION['utilisateur_password'];

$connect = mysqli_connect('localhost', 'root', '', 'moduleconnexion');

if ($_POST['sauvimg']){
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

  //var_dump($fileTmpName);

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
        $queryInsert = mysqli_query($connect, "UPDATE `utilisateurs` SET `imgprofil`='$fileNewName' WHERE `login`= '".$test."'");

        $result = mysqli_query($connect, "SELECT * FROM `utilisateurs`  WHERE `login`= '".$test."'");
        while($data = mysqli_fetch_array($result)){
          ?>
        <div class="profilepic">
              <img src="Uploads/<?php echo $data['imgprofil']; ?>" alt="Profile picture" class='profil' width="180px" height="185px">
        </div>
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
  ?>
  


<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil || TITRE DE MON SITE</title>
  <link rel="stylesheet" href="UC.css">
</head>
<body>
    <header>

    </header>

    <main>
      Bonjour <?php echo $_SESSION['utilisateur_login']; ?>
      
      <form action="profil.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="profilImg"><br><br>
            <span><?php echo $profilErr; echo $pictureErr; echo $sizeErr; ?></span>
            <input type="submit" name="sauvimg" value="Sauvegarder">
      <div>
        <label>Bio</label>
        <textarea name="bio" id="bio" cols="30" rows="2"></textarea>
      </div>
      </form>

      <form action="profil.php" method="post">
        <div>
            <label for="name">Login :</label>
            <input type="text" id="login" name="user_login"> <p><span class="error">*<?php echo $loginErr;?></span></p>
        </div>
        <div>
          <label for="name">Prénom :</label>
          <input type="text" id="firstname" name="user_firstname">
        </div>
        <div>
          <label for="name">Nom :</label>
          <input type="text" id="lastname" name="user_lastname">
        </div>
        <div>
          <label for="msg">Mot de passe :</label>
        <div>Le mdp doit comprendre au moins XXXX,XXXX et XXXXX (quand on clique sur le champs ceci apparait)</div>
          <input type="password" id="pass" name="password"minlength="8" required><p><span class="error"> *<?php echo $passwordErr;?></span></p>
          <label for="msg">Confirmation du mot de passe :</label>
          <input type="password" id="pass2" name="password2"
          minlength="8" required><?php echo $confpasswordErr;?>
        </div>
                
                <button type="submit" name="enregistrer">Save the changes</button>
        </form>

    </main>

    <footer>
    
    </footer>
</body>
</html>
