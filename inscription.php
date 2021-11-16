<!-- LE FORMULAIRE D'INSCRIPTION POUR MON SITE:
Le formulaire doit contenir l’ensemble des champs présents dans la table
“utilisateurs” (sauf “id”) + une confirmation de mot de passe. Dès qu’un utilisateur remplit ce formulaire, les données sont insérées dans la base de
données et l’utilisateur est redirigé vers la page de connexion. -->

<?php
session_start();


if (!empty($_POST)){
    extract($_POST);

  if(isset($_POST['inscription'])){
    echo $_POST['user_login'];
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