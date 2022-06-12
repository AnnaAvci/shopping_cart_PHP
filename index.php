
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="./assets/css/index.css">
    </head>
    <body>
        <main>
            <h1 class="text-center">Ajouter un produit</h1>

            <?php
                if(empty($_SESSION['products'])){
                    echo "<p class='text-center'>0 produits enregistrés</p>";
                } else { 
                    $_SESSION['products']->getTotalProducts();
                }
            ?>

            <!--=======  FORM  ======-->
            <form action="traitement.php?action=add" method="post">
                <p>
                    <label>
                        Nom du produit: <br> 
                        <input type="text" name="name">
                    </label>
                </p>

                <p>
                    <label>
                        Prix du produit: <br> 
                        <input type="number" step="any" name="price">
                    </label>
                </p>

                <p>
                    <label>
                    Quantité désirée: <br> 
                        <input type="number" name="qtt" value="1">
                    </label>
                </p>

                <p>
                    <label>
                    Description: <br> 
                        <input type="textarea" name="description" id="description">
                    </label>
                </p>

                <p>
                    <input type="submit" name="submit" value="Ajouter le produit" class='btn'>
                </p>
                
                <p>
                    <a href="recap.php" target="_blank" class='btn'>Voir le récaputilatif</a>
                </p>
            </form>
        </main>

        <!--=======  SCRIPT  ======-->
        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
            crossorigin="anonymous"
        >
        </script>
    </body>
</html>