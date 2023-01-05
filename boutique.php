<?php

require_once './inc/init.php';
require_once './inc/function.php';

$r = $pdo->query("SELECT DISTINCT category FROM products");

    $content .= '<ul class="list_category">';
    
    $content .= '<li><a href="boutique.php">Tous les produits</a></li>';
    while($data = $r->fetch(PDO::FETCH_ASSOC))
    {
        $content .= '<li><a href="boutique.php?category='.$data['category'].'">'.$data['category'].'</a></li>';
    }

    $content .= '</ul>';

if(isset($_GET['category']))
{

    $r= $pdo->query("SELECT * FROM products WHERE category = '$_GET[category]'");

    while($p=$r->fetch(PDO::FETCH_ASSOC))
    {
        $content2 .= '<div class="card">';
        $content2 .= '<div class="card-img"><img src="'.$p['picture'].'" alt="image produit"></div>';
        $content2 .= '<div class="card-title">'.$p['name'].'</div>';
        $content2 .= '<div class="card-price">'.$p['price'].'€</div>';
        $content2 .= '<div class="card-btn"><a href="fiche_produit.php?id='.$p['id_product'].'">Détails</a></div>';
        $content2 .= '</div>';
    }

} else{

    $req = $pdo->query("SELECT * FROM products");

    while($tab=$req->fetch(PDO::FETCH_ASSOC))
    {
        $content2 .= '<div class="card">';
        $content2 .= '<div class="card-img"><img src="'.$tab['picture'].'" alt="image produit"></div>';
        $content2 .= '<div class="card-title">'.$tab['name'].'</div>';
        $content2 .= '<div class="card-price">'.$tab['price'].'€</div>';
        $content2 .= '<div class="card-btn"><a href="fiche_produit.php?id='.$tab['id_product'].'">Détails</a></div>';
        $content2 .= '</div>';
    }
}



?>

<!-- PARTIE AFFICHAGE -->
<?php require_once './inc/header.inc.php'; ?>




<section class="section">
    <div class="category">
        <h4>Catégories</h4>
        <div>
            <?= $content; ?>
        </div>
    </div>

    <div class="articles">
        <?= $content2; ?>
    </div>
</section>



<?php require_once './inc/footer.inc.php'; ?>