<?php
// appeler la fonction session_start() en début de fichier = récupérer la session correspondante à l'utilisateur
session_start();
require "functions.php";
?>
<!-- page pour afficher de manière organisée et exhaustive la liste des produits présents en session -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="recap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Récapitulatif</title>

</head>
<body>
    <?php
    // Vérifier: si la clé "products" du tableau de session $_SESSION n'existe pas : !isset(), ou cette clé existe mais ne contient aucune donnée : empty()
    if(!isset($_SESSION['products'])|| empty($_SESSION['products'])){
        echo "<p>Aucun produit en session...</p>";
    } else {
       echo 
       "<div id='recapTable'>",
       "<table>",
            "<thead>",
                "<tr>",
                    "<th>#</th>",
                    "<th>Nom</th>",
                    "<th>Prix</th>",
                    "<th>Quantité</th>",
                    "<th>Total</th>",
                "</tr>",
            "</thead>",
        "<tbody>";
    $totalGeneral = 0;
    // var_dump($_SESSION['products']);
// affichage uniforme de tous les produits dans la session
    foreach($_SESSION['products'] as $index=>$product){
        echo "<tr>",
                "<td>".$index."</td>",
                "<td>".$product['name']."</td>",
                "<td>".number_format($product['price'],2,",","&nbsp;")."&nbsp;€ </td>",
                "<td><a href='traitement.php?action=downQtt&id=$index' class='btn btn-danger btn-sm'><i class='fa-solid fa-minus'></i></a>",
                "<span class='qtt'>".$product['qtt']."</span><a href='traitement.php?action=upQtt&id=$index'class='btn btn-primary btn-sm'><i class='fa-solid fa-plus'></i></a></td>",
// number_format() précise variable à modifier,nombre de décimales souhaité,caractère séparateur décimal,caractère séparateur de milliers
                "<td>".number_format($product['total'],2,",","&nbsp;")."&nbsp;€ </td>",
                "<td><a href='traitement.php?action=deleteProduct&id=$index'class='btn btn-danger'><i class='fa-solid fa-trash-can'></i></a></td>",
            "</tr>";
        $totalGeneral+=$product['total'];

    }
    echo "<tr>",
    //cellule fusionnée de 4 cellules (colspan=4) pour   l'intitulé,   et   une   cellule   affichant   le   contenu   formaté   de   $totalGeneral   avec number_format().
            "<td colspan=4>Total général: </td>",
            "<td><strong>".number_format($totalGeneral,2,",","&nbsp;")."&nbsp;€</strong></td>
            </tr>",
        "</tbody>",
        "</table>", 
        "</div>";     
    }

    echo getTotalProducts();
   
   ?>

   <button class="btn btn-danger lastBtn"><a href="traitement.php?action=clear">Vider le panier</a></button>
   <button class="btn btn-primary lastBtn"><a href='index.php'>Retourner à l'accueil</a></button>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>