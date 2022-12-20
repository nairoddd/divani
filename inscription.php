<?php


require_once './inc/init.php';
require_once './inc/function.php';


$erreur = '';



if(!empty($_POST)){


    foreach($_POST as $key =>$valeur){
        $_POST[$key] = htmlspecialchars(addslashes($valeur));
    }
    
    if(strlen($_POST['firstname']) < 2 || strlen($_POST['firstname']) > 20){
        $erreur .= '<div style="color:red; text-align:center; margin: 20px;"  role="alert">Le prénom doit comporter entre 2 et 20 caractères</div>';
    }
    if(strlen($_POST['lastname']) < 2 || strlen($_POST['lastname']) > 20){
        $erreur .= '<div style="color:red; text-align:center; margin: 20px;"  role="alert">Le nom doit comporter entre 2 et 20 caractères</div>';
    }
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $erreur .= '<div style="color:red; text-align:center; margin: 20px;"  role="alert">L\'email n\'est pas valide</div>';
    }
        // more than 18 years old are enable to register
    if(!empty($_POST['date_of_birth']) && (date('Y') - date('Y', strtotime($_POST['date_of_birth']))) < 16){
        $erreur .= '<div style="color:red; text-align:center; margin: 20px;"  role="alert">Vous devez avoir plus de 16 ans pour vous inscrire</div>';
}

    if(empty($_POST['date_of_birth'])){
        $erreur .= '<div style="color:red; text-align:center; margin: 20px;"  role="alert">La date de naissance n\'est pas valide</div>';
    }
    if(strlen($_POST['password']) < 4 || strlen($_POST['password']) > 20){
        $erreur .= '<div style="color:red; text-align:center; margin: 20px;"  role="alert">Le mot de passe doit comporter entre 4 et 20 caractères</div>';
    }
    if($_POST['password'] != $_POST['password_confirm']){
        $erreur .= '<div style="color:red; text-align:center; margin: 20px;"  role="alert">Les mots de passe ne correspondent pas</div>';
    }
  if (!isset($_POST['cgu'])){
        $erreur .= '<div style="color:red; text-align:center; margin: 20px;"  role="alert">Vous devez accepter les conditions générales d\'utilisation</div>';
    }

$_POST['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);

    if(empty($erreur)){
        $resultat = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $resultat->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $resultat->execute();
        if($resultat->rowCount() > 0){
            $erreur .= '<div style="color:red; text-align:center; margin: 20px;"  role="alert">L\'email est déjà utilisé</div>';
        } else {
           $result = $pdo->prepare("INSERT INTO users (firstname, lastname, email, date_of_birth, password) VALUES (:firstname, :lastname, :email, :date_of_birth, :password)");
               $result->bindParam(':firstname', $_POST['firstname'], PDO::PARAM_STR);
                $result->bindParam(':lastname', $_POST['lastname'], PDO::PARAM_STR);
                $result->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
                $result->bindParam(':date_of_birth', $_POST['date_of_birth'], PDO::PARAM_STR);
                $result->bindParam(':password', $_POST['password'], PDO::PARAM_STR);
            
                $result->execute();
                if($result->rowCount() > 0){
                    $erreur .= '<div style="color:green; text-align:center; margin: 20px;"  role="alert">Vous êtes inscrit</div>';
                } else {
                    $erreur .= '<div style="color:red; text-align:center; margin: 20px;"  role="alert">Erreur lors de l\'inscription</div>';
                }
                
        }
    }
    
}








?>

<?php require_once './inc/header.inc.php'; ?>


<div class="connexion-title">
    <span>INSCRIPTION </span>
    <p>Créez un compte pour accéder à votre espace réservé</p>
</div>

<div class="redirect-register">
    <a href="<?= URL ?>connexion.php">Si vous avez déjà créé un compte, cliquez ici pour accéder</a>
</div>
   <div class="form-container">
   <form method="post" action="">
        <label class="form-label" for="firstname">Prénom</label>
        <input class="form-input" type="text" name="firstname" id="firstname" value="<?php echo $_POST['firstname'] ?? '' ?>">
        <label class="form-label" for="lastname">Nom</label>
        <input class="form-input" type="text" name="lastname" id="lastname" value="<?php echo $_POST['lastname'] ?? '' ?>">
        <label class="form-label" for="email">Email</label>
        <input class="form-input" type="text" name="email" id="email" value="<?php echo $_POST['email'] ?? '' ?>">
        <label class="form-label" for="date_of_birth">Date de naissance</label>
        <input class="form-input" type="date" name="date_of_birth" id="date_of_birth" value="<?php echo $_POST['date_of_birth'] ?? '' ?>">
        <label class="form-label" for="password">Mot de passe</label>
        <input class="form-input" type="password" name="password" id="password">
        <label class="form-label" for="password_confirm">Confirmer le mot de passe</label>
        <input class="form-input" type="password" name="password_confirm" id="password_confirm" value="<?php echo $_POST['password_confirm'] ?? '' ?>">
        <label class="form-label" for="cgu">J'accepte les conditions d'utilisation (conformément aux arts. 13 et 14 du Règlement UE 2016/679)</label>
        <input type="checkbox" name="cgu" id="cgu" value="1"><br>
        <div class="bouton">
            <button type="submit" class="form-submit">Se connecter</button>
        </div>
    </form>
   </div>
    <?php echo $erreur ?>
    
</body>
</html>

<?php require_once './inc/footer.inc.php'; ?>