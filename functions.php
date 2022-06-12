<?php

function getTotalProducts() {
   if(isset($_SESSION['products'])){
    $wholeQtt=0;
    foreach($_SESSION['products'] as $product){
        $wholeQtt+=$product['qtt'];
   } 
   return "<div class='totalProducts'><span class='whiteText'>".$wholeQtt. " produits enregistrés </span></div>";
    } else {
        return "<div class='totalProducts'> 0 prosuits enregistrés </div>";
    }
    
}


