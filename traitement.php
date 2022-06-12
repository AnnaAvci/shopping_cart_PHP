<?php
session_start();


// Limiter  l'accès  à  traitement.php  par  les  seules  requêtes  HTTP provenant de la soumission du formulaire.
//La condition sera vraie seulement si la requête POST transmet une clé "submit" au serveur.
//Sinon header("Location:index.php") effectue une redirection.
// Il n'y a pas de  "else"  à  la  condition  puisque  dans  tous  les  cas  (formulaire  soumis  ou  non),  nous souhaitons revenir au formulaire après traitement. 
    
switch($_GET["action"]) {

    case "add": 
        if(isset($_POST['submit'])){ 
            // filter_input() = effectuer validation/nettoyage des données transmises par le formulaire en employant divers filtres   
                $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_STRING);
            //FILTER_FLAG_ALLOW_FRACTION = permettre l'utilisation du caractère "," ou "." pour la décimale.
                $price = filter_input(INPUT_POST,"price",FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            //FILTER_VALIDATE_INT ne  validera  la  quantité  que  si  c'est  un nombre entier différent de zéro
                $qtt = filter_input(INPUT_POST,"qtt",FILTER_VALIDATE_INT);
            
            //  vérifier  si  chaque  variable contient une valeur jugée positive par PHP (tout sauf  false ou  null  ou  0)=> pourquoi  la  condition  ne  compare  les  variables  à  rien  de précis.
                if($name && $price && $qtt){
            // Construire pour chaque produit un tableau associatif $product pour stocker les données dans le tableau $_SESSION
                    $product = [
                        "name" => $name,
                        "price" => $price,
                        "qtt" => $qtt,
                        "total" => $price*$qtt
                    ];
            //enregistrer le produit en session 
            //On indique la clé "products" de ce tableau.
            //Si cette clé n'existait pas auparavant (ex: l'utilisateur ajoute son tout premier produit), PHP la créera au sein de $_SESSION.
                    $_SESSION['products'][] = $product;
                }
            }
        break;

        case "clear" : 
            unset($_SESSION["products"]);
            header("Location:recap.php");
            die();
        break;

        case "deleteProduct" :
            // vérifier si le paramètre "id" est défini dans l'URL et vérifier si le produit existe en session
            if(isset($_GET["id"])&&isset($_SESSION["products"][$_GET["id"]])){
              unset($_SESSION["products"][$_GET["id"]]);
              // redirection
              header("Location: recap.php");
              die();
              }
            
        break;
        
        case "upQtt":
        // vérifier si le paramètre "id" est défini dans l'URL et vérifier si le produit existe en session
        if(isset($_GET["id"])&&isset($_SESSION["products"][$_GET["id"]])){ //id=$index in recap.php
            //incrémenter la quantité courante du produit passé en paramètre
          $_SESSION["products"][$_GET["id"]]["qtt"]++;
          // augmenter le prix total par le montant du prix d'un produit
          $_SESSION["products"][$_GET["id"]]["total"]+= $_SESSION["products"][$_GET["id"]]["price"];
        //   redirection
          header("Location: recap.php");
          die();
        }
        break;

        case "downQtt":
            if(isset($_GET["id"])&&isset($_SESSION["products"][$_GET["id"]])){
              //diminuer la quantité courante du produit passé en paramètre
              $_SESSION["products"][$_GET["id"]]["qtt"]--;
              // diminuer le prix total par le montant du prix d'un produit
             $_SESSION["products"][$_GET["id"]]["total"]-= $_SESSION["products"][$_GET["id"]]["price"];
             
            if($_SESSION["products"][$_GET["id"]]["qtt"] == 0){
                unset($_SESSION["products"][$_GET["id"]]);
            }    

             //   redirection 
             header("Location: recap.php");
             die();
         }
             
        break;


       
}

//envoie un nouvel entête HTTP (les entêtes d'une réponse) au client. Avec le type d'appel "Location:", cette réponse est envoyée au client avec le status code 302, qui indique une redirection. 
//L'appel de la fonction header() n'arrête pas l'exécution du script courant.
//Il faut alors veiller à ce que header() soit la dernière instruction du fichier ou appeler la fonction exit()  (ou  die())  tout  de  suite  après.
header("Location:index.php");
