<?php

//var_dump($_POST);

// //renvoi à la base de données
$connect = mysqli_connect('localhost', 'root', '', 'laura_savickaite_moduleconnexion');

  //ceci servira à contraster avec les validations fausses du dessous, ainsi plus tard utiliser ceci dans la logique de "si mon formulaire est juste ALORS tu m'envoies dans la base de données" - donc, si post pas vide - tu m'extraies les données - et dans ce cas c'est juste ::::::: plus tard SI le empty est vide dans ce cas tu mets erreur etc....
  
  if(!empty($_POST)){
    extract($_POST);
    $validation=true;
  }
  
  //si appuyé sur le bouton inscription...
  if(isset($_POST['inscription'])){
    
    $login=$_POST['user_login'];
    $prenom=$_POST['user_firstname'];
    $nom=$_POST['user_lastname'];
    $password=$_POST['password'];
    $confpassword=$_POST['password2'];
    //trim évite les espaces, strtolower rend tout en minuscule, le htmlentities convertit les caractères spéciaux pour les entités HTML. Cela signifie qu'il va remplacer les caractères HTML comme <et> avec & lt; & gt ;. et Cela empêche les pirates d'exploiter le code en injectant du code HTML ou Javascript (Cross-site Scripting attacks) dans les formes.
    $login=htmlentities(trim($login));
    $prenom=htmlentities(trim($prenom));
    $nom=htmlentities(trim($nom));
    $password=htmlentities(trim($password));
    $confpassword=htmlentities(trim($confpassword));
      
    

  
    //LES ERREURS POSSIBLES :
    if (empty($login)) {
      $validation=false;
      $loginErr .= "Veuillez rentrer un login.";
    }
    else {
        //avec le WHERE c'est une comparaison : where la colonne login sql reconnait mon POST login donc ma variable $login ici :: si tu reconnais le même login, alors tu me donneras une erreur
      $repLogin = mysqli_query($connect, "SELECT `login` FROM `utilisateurs` WHERE `login`= '".$login. "'");
      // $repLogin = mysqli_fetch_all($queryLogin, MYSQLI_ASSOC);  
        if(mysqli_num_rows($repLogin)){
          $validation=false;
          $loginErr .= "Ce nom d'utilisateur est déjà pris.";
      }
    }

    
    if(empty($password)){
      $validation=false;
      $passwordErr .= "Le mot de passe doit être rempli.";
    }
    elseif ($confpassword !== $password) {
      $validation=false;
      $confpasswordErr .= "Le mot de passe et sa confirmation ne sont pas les mêmes.";
    } 
    
    //pk quand je mets $validation=true ça ne marche pas alors que juste validation si
  if ($validation){
    //maybe crypter le mdp à la fin
    //si conditions bonnes alors tu linseres dans la base de données avec un query de sql
    $queryInsert = mysqli_query($connect, "INSERT INTO `utilisateurs` (login, prenom, nom, password) VALUES ('$login', '$prenom', '$nom', '$password')"); 
    header('Location:connexion.php');

  }
  }
  

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription || AACLF</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="inscription.css">
</head>
<body>
    <header>
    <a href="index.php"><img class="leaflogo" src="Images/leaflogo.png" width="30px"></a>
      <p id="indexlien"> Back to the index</p>
    </header>

    <main>
    <article id="form_inscription">

      <section> 
      <div id="top_part">
        <h1>BOARDING PASS</h1>
      </div>
      <!-- <p><span class="error">* ces champs sont obligatoires</span></p> -->
      <div id="column">
      <div id="billet_part1">
        <form action="inscription.php" method="post">
              <label for="name">Login :</label>
              <input type="text" id="login" name="user_login"> <p class="error1">*<?php echo $loginErr;?></p>

            <label for="name">Prénom :</label>
            <input type="text" id="firstname" name="user_firstname">

            <label for="name">Nom :</label>
            <input type="text" id="lastname" name="user_lastname">

            <img id="barcode" src="Images/barcode.png">
        </div>
        <div id="billet_part2">
            <hr>
            <label for="msg">Mot de passe :</label>
          <!-- <span><p></p>Le mdp doit comprendre au moins XXXX,XXXX et XXXXX (quand on clique sur le champs ceci apparait)</p></span> -->
            <input type="password" id="pass" name="password" required><p class="error2"> *<?php echo $passwordErr;?></p>
            <label for="msg">Confirmation du mot de passe :</label>
            <input type="password" id="pass2" name="password2" required
            ><?php echo $confpasswordErr;?>
                  <div class="boutons">
                    <button class="boutoninscription" type="submit" name="inscription">Sign in</button></form>
                    <p id="comptetxt">Vous avez déjà un compte ? </p>
                    
                    <button class="boutoninscription" onclick="window.location.href = 'connexion.php';" type="submit" name="connexion">Log in</button>
                </div>
          
        </div></div>
        </section>
  </article>

  <article class="aside_inscription">
    <div class="stamp"></div>
    <div class="stamp1"></div>
    <div class="stamp2"></div>
  </article>

  <article id="icon_inscription">
    <div id="cercle1"></div>
    <div id="cercle2"></div>
    <div id="cercle3"></div>
  </article>
            </main>
            
    <footer>
    
    </footer>
</body>
</html>