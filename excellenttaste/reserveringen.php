<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Reserveringen</title>
  </head>
  <body>
    <?php 
        include("nav.html");
        include("model.php");
        $Model = new Model();
    ?>

    <div class="container" style="margin-top: 30px;">
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Datum</th>
                        <th scope="col">Tijd</th>
                        <th scope="col">Tafel</th>
                        <th scope="col">Klantnaam</th>
                        <th scope="col">Telefoonnummer</th>
                        <th scope="col">Aantal</th>
                        <th scope="col">Aanwezig</th>
                        <th scope="col">Bon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    //alles wat ge inner joined moet worden
                    $pdo = new PDO("mysql:host=localhost;dbname=excellenttaste", 'root', '');
                    $sth = $pdo->prepare("SELECT 

                                            reserveringen.ID, 
                                            reserveringen.Klant_ID, 
                                            reserveringen.datum, 
                                            reserveringen.Tijd, 
                                            reserveringen.Tafel, 
                                            klanten.Naam, 
                                            klanten.Telefoon, 
                                            reserveringen.Aantal

                                          FROM(reserveringen

                                          INNER JOIN klanten ON reserveringen.Klant_ID = klanten.ID);");
                                          
                    $sth->execute();

                    //alle data correct fetchen
                    while($row = $sth->fetch())
                    {
                        if($row['datum'] == date('Y-m-d'))
                        {
                            ?>
                            <tr>
                                <td><?php echo $row['ID']?></a></td>
                                <th scope="row"><?php echo $row['datum']?></th>
                                <td><?php echo $row['Tijd']?></td>
                                <td><?php echo $row['Tafel']?></td>
                                <td><?php echo $row['Naam']?></td>
                                <td><?php echo $row['Telefoon']?></td>
                                <td><?php echo $row['Aantal']?></td>
                                <td><a href="#" style="text-decoration: none;">++</a></td>
                                <td><a href="bestelling.php?klant_id=<?php echo $row['ID']?>" style="text-decoration: none;">xx</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>