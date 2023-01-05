<?php require_once 'init.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Divani</title>

    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="header">
        <div class="header_content">
            <div class="header_location">
                <span>France</span>
            </div>

            <div class="header_logo">
                <!-- <h1>DIVANI</h1> -->
                <img src="./img/divani_logo.png" alt="">
            </div>

            <ul class="login_registration">
            <?php if(userConnected()): ?>
                <li><a href="<?= URL ?>connexion.php?action=deconnexion">Déconnexion</a><i class='bx bxs-log-out'></i></li>
            <?php else: ?>
                <li><a href="<?= URL ?>connexion.php">Connexion</a><i class='bx bxs-log-in'></i></li>
                <li><a href="<?= URL ?>inscription.php">Inscription</a></li>
            <?php endif; ?>
            </ul>
            
        </div>

        <div class="navigation">
            <nav>
                <ul>
                <?php if(userIsAdmin()): ?>
                    <li><a href="<?= URL ?>admin/dashboard.php">Dashboard</a></li>
                <?php endif; ?>
                    <li><a href="<?= URL ?>index.php">Accueil</a></li>
                    <li><a href="<?= URL ?>boutique.php">Boutique</a></li>
                    <li><a href="<?= URL ?>contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

