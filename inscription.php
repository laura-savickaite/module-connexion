<!-- LE FORMULAIRE D'INSCRIPTION POUR MON SITE:
Le formulaire doit contenir l’ensemble des champs présents dans la table
“utilisateurs” (sauf “id”) + une confirmation de mot de passe. Dès qu’un utilisateur remplit ce formulaire, les données sont insérées dans la base de
données et l’utilisateur est redirigé vers la page de connexion. -->

<?php

$login=$_POST['user_login'];
$prenom=$_POST['user_firstname'];
$nom=$_POST['user_lastname'];
$email=$_POST['user_mail'];
$password=$_POST['password'];
$confpassword=$_POST['password2'];

//créer une session à chaque fois pour se souvenir de l'utilisateur
session_start();

//renvoi à la base de données
include (moduleconnexion.sql); //?????

//si conditions bonnes alors tu linseres dans la base de données
    //INSERT INTO utilisateurs (login, prenom, nom, mail, password) 
    //VALUES ($login, $firstname, $lastname, $mail, $pass2)

//s'il y a déjà une session, cela évite à l'utilisateur d'être sur la page d'inscription
if(isset($_SESSION['id'])){
    header('Location: connexion.php');
    exit;
}

//si post rempli alors tu m'extraies les informations
if (!empty($_POST)){
    extract($_POST);
//si appuyé sur le bouton inscription...
  if(isset($_POST['inscription'])){
      //trim évite les espaces, strtolower rend tout en minuscule, le htmlentities convertit les caractères spéciaux pour les entités HTML. Cela signifie qu'il va remplacer les caractères HTML comme <et> avec & lt; & gt ;. et Cela empêche les pirates d'exploiter le code en injectant du code HTML ou Javascript (Cross-site Scripting attacks) dans les formes.
    $login=htmlentities(trim($login));
    $prenom=htmlentities(trim($prenom));
    $nom=htmlentities(trim($nom));
    $email=htmlentities(strtolower(trim($email)));
    $password=htmlentities(trim($password));
    $confpassword=htmlentities(trim($confpassword));

    if (empty($login)) {
        $loginErr = "Veuillez rentrer un login.";
      }elseif (LE LOGIN EXISTE DEJA)
    if (empty($prenom)) {
        $prenomErr = "Veuillez rentrer un prénom.";
      }elseif (LE PRENOM EXISTE DEJA)
    if (empty($nom)) {
        $nomErr = "Veuillez rentrer un nom.";
      }elseif (LE NOM EXISTE DEJA)
    if (empty($email)) {
        $emailErr = "Veuillez rentrer un email valide.";
      }elseif (LEMAIL EST DEJA PRIS)
    if (empty($password)) {
        $passwordErr = "Veuillez rentrer un mot de passe.";
      } 
    if ($confpassword === $password) {
        $confpasswordErr = "Le mot de passe et sa confirmation ne sont pas les mêmes.";
      } 

    // if(filter_var($NAME, FILTER_VALIDATE_SMTHING) !== false) pour valider les choses
  }  
}

?>



<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription || TITRE DE MON SITE</title>
  <link rel="stylesheet" href="UC.css">
</head>
<body>
    <header>

    </header>

    <main>
    <form action="inscription.php" method="post">
        <div>
            <label for="name">Login :</label>
            <input type="text" id="login" name="user_login">
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
            <label for="mail">e-mail :</label>
            <input type="email" id="mail" name="user_mail">
        </div>
        <div>
            <label for="msg">Mot de passe :</label>
            <div>Le mdp doit comprendre au moins XXXX,XXXX et XXXXX (quand on clique sur le champs ceci apparait)</div>
            <input type="password" id="pass" name="password"
           minlength="8" required>

            <label for="msg">Confirmation du mot de passe :</label>
            <input type="password" id="pass2" name="password2"
           minlength="8" required>
        </div>

        <button type="submit" name="inscription">Sign in</button>
    </form>
        
    </main>

    <footer>
    
    </footer>
</body>
</html>