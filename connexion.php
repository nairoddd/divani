<!--PARTIE TRAITEMENT -->
<?php 
    require_once './inc/init.php';
    require_once './inc/function.php';


if(isset($_GET['action']) && $_GET['action'] == 'deconnexion'){
    session_destroy();
    header('location:connexion.php');
}



if ($_POST) {

    if (!empty($_POST['email'])) { // Si le pseudo n'est pas vide

        //Je fais une req pour récupérer les infos du pseudo qui a été envoyé en POST
        // $req = $pdo->query("SELECT * FROM user WHERE pseudo = '$_POST[pseudo]'");
        $req = $pdo->query("SELECT * FROM users WHERE email = '$_POST[email]'");


        // Si le rowCount() >= 1 alors il y a un user qui a ce pseudo
        if ($req->rowCount() >= 1) {

            $user = $req->fetch(PDO::FETCH_ASSOC); // Je fetch pour récupérer les infos dans un tableau

            // je vérifie si le password envoyé en POST correspond au password que j'ai dans mon tableau $user qui contient toutes les infos du user
            if (password_verify($_POST['password'], $user['password'])) {

                // Je crée une session  pour stocker les infos de l'user, id_user, firstame, lastname,email,date-of-birth,password
                $_SESSION['user'] = array(
                    'id_user' => $user['id_user'],
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname'],
                    'email' => $user['email'],
                    'date_of_birth' => $user['date_of_birth'],
                    'password' => $user['password'],
                    'status' => $user['status']
                );



                header('location:index.php');
            } else {
                $content .= '<div style="color:red; text-align:center; margin: 20px;"  role="alert">Erreur sur le mot de passe</div>';
            }
        } else {
            $content .= '<div style="color:red; text-align:center; margin: 20px;"  role="alert">Erreur sur le mail</div>';
        }
    }
}

?>







<?php require_once './inc/header.inc.php'; ?>

<!--PARTIE AFFICHAGE -->

<div class="connexion-title">
    <span>ESPACE RÉSERVÉ </span>
    <p>Insérez vos identifiants pour accéder</p>
</div>

<div class="redirect-register">
    <a href="<?= URL ?>inscription.php">Vous n'avez pas de compte ?</a>
</div>
    <?= $content; ?>

    <form method="POST" action="" class="form-container">



        <label for="email" for="email" class="form-label">Email</label>
        <input type="text" class="form-input" id="email" name="email">

        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-input" id="password" name="password">

        <div class="bouton">
            <!-- <input type="submit" value="Login" class="form-submit">
         -->
         <button type="submit" class="form-submit">Se connecter</button>
        </div>

        <div class="link">
            <a href="forgot-password.php" class="forgot-password">Mot de passe oublié ?</a>
        </div>
    </form>
    

<?php require_once('./inc/footer.inc.php'); ?>