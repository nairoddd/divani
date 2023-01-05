<?php

require_once './inc/init.php';
require_once './inc/function.php';

if(!isset($_GET['id']))
{
    header('location:boutique.php');
    exit();
}

if(isset($_GET['id']))
{
    $r= $pdo->query("SELECT * FROM products WHERE id_product = '$_GET[id]'"); 

    $p=$r->fetch(PDO::FETCH_ASSOC);
}  
// var_dump($p);
//! Affichage des caractéristiques
    $content .= '<h3 class="text-center">'.$p['name'].'</h3>';
    $content .= '<h4 class="text-center">Catégorie : '.$p['category'].'</h4>';
    $content .= '<h4 class="text-center">Référence : '.$p['reference'].'</h4>';
    $content .= '<div class="card-img"><img src="'.$p['picture'].'"></img></div>';
    $content .= '<h4 class="text-center">Description :</h4><p class="text-center">'.$p['description'].'</p>';
    $content .= '<h2 class="text-center">Prix : '.$p['price'].'€</h2>';
//! Si il y a du stock 
    if ($p['stock'] > 0)
    {
        $content .= '<form action="panier.php" method="POST">';
        $content .= '<input type="hidden" value="'.$p['id_product'].'" name="id_product">';
        $content .= "<div class=\"d-flex justify-content-center\">";
        
        $content .= '<div class="d-flex flex-column align-items-center"><label for=\"quantite\">Quantité  </label></div>';
        $content .= '<select name="quantite" id="quantite">';
        for ($i=1; $i<=$p['stock']; $i++)
        {
            $content .= '<option value="'.$i.'">'.$i.'</option>';
        }
        $content .= '</select>';
        $content .= '</div>';
        $content .= '<div class="d-flex justify-content-center my-2"><input class="btn btn-primary" type="submit" value="Ajouter au panier" name="ajout_panier"></div>';
    }
    else {
        $content .= '<div class="alert alert-danger" role="alert">Il n\'y en a plus en stock</div>';
    
    }
        $content .= '</form>';
    
    //! Lien permettant d'aller vers la catégorie
    $content .= '<div class="d-flex justify-content-center my-2"><a href="boutique.php?categorie='.$p['category'].'">Retourner vers la catégorie '.$p['category'].'</a></div>';

    
    //! Permet de renvoyer l'utilisateur à l'index car il n'y a pas de id_produit correspondant a ce qu'il a rentre dans l'url dans la bdd
    if($r->rowCount() <= 0){
        header('location:index.php');
        exit();
    }



?>


<!-- PARTIE AFFICHAGE -->
<?php require_once './inc/header.inc.php'; ?>

<section class="section">
    <div class="details_product">
        <div class="details_content">
            <?= $content ?>
        </div>
    </div>
</section>



<?php require_once './inc/footer.inc.php'; ?>