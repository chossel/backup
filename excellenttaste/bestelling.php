<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Bestellingen</title>
  </head>
  <body>
    <?php 
        // Include de navigatie bar, logo en maakt een nieuwe instantie 
        include("nav.html");
        include("model.php");
        $Model = new Model();
    ?>
    <div class="container" style="margin-top: 30px;">
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Naam</th>
                        <th scope="col">Prijs</th>
                        <th scope="col">Aantal</th>
                        <th scope="col">Totaal Prijs</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    //inner join van alle gegevens die ik nodig heb om de bestelling te zien
                    $bonTotaalPrijs = 0;
                    $pdo = new PDO("mysql:host=localhost;dbname=excellenttaste", 'root', '');

                    //sql query preparen en executen
                    $sth = $pdo->prepare("SELECT
                                              reserveringen.ID,
                                              bestelling.Aantal,
                                              bestelling.Menuitem_ID,
                                              menuitems.Naam,
                                              menuitems.prijs,
                                              menuitems.ID
                                          FROM
                                              bestelling
                                          INNER JOIN reserveringen ON bestelling.Reservering_ID = reserveringen.ID
                                          INNER JOIN menuitems ON bestelling.Menuitem_ID = menuitems.ID
                                          WHERE
                                              bestelling.Reservering_ID = " . $_GET['klant_id']);
                    $sth->execute();

                    //elke rij in de tabel fetchen
                    while($row = $sth->fetch())
                    {
                        //totaal prijs uitrekenen per bestelling
                        $totaalPrijs = ($row['prijs'] * $row['Aantal']);
                        
                        //totaal prijs van heel de bon
                        $bonTotaalPrijs += $totaalPrijs;

                        ?>
                        <tr>
                            <th scope="row"><?php echo $row['Naam']?></th>
                            <td><?php echo $row['prijs']?></td>
                            <td><?php echo $row['Aantal']?></td>
                            <td><?php echo $totaalPrijs?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    
                    <!-- Prijs van bon onderaan zetten -->
                    <tr>
                        <td><b>Totaal prijs: €<?php echo $bonTotaalPrijs ?></b></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>