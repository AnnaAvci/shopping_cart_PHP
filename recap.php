<?php
    session_start();
    require "functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/recap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Récapitulatif</title>

</head>
<body>
    <?php

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

        foreach($_SESSION['products'] as $index => $product){
            echo 
                    "<tr>",
                        "<td>".$index."</td>",
                        "<td>".$product['name']."</td>",
                        "<td>".number_format($product['price'],2,",","&nbsp;")."&nbsp;€ </td>",
                        "<td>
                            <a href='traitement.php?action=downQtt&id=$index' class='btn btn-danger btn-sm'>
                                <i class='fa-solid fa-minus'></i>
                            </a>",
                            "<span class='qtt'>".$product['qtt']."</span>
                            <a href='traitement.php?action=upQtt&id=$index'class='btn btn-primary btn-sm'>
                                <i class='fa-solid fa-plus'></i>
                            </a>
                        </td>",
                        "<td>".number_format($product['total'],2,",","&nbsp;")."&nbsp;€ </td>",
                        "<td>
                            <a href='traitement.php?action=deleteProduct&id=$index'class='btn btn-danger'>
                                <i class='fa-solid fa-trash-can'></i>
                            </a>
                        </td>",
                    "</tr>";

            $totalGeneral += $product['total'];
        }

        echo 
                    "<tr>",
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

   <!--===  SCRIPT  ===-->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>