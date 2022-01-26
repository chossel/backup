<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Koks Pagina.</title>
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
                        <th scope="col">aantal</th>
                        <th scope="col">Gereed</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    //inner join maken voor de namen van de producten
                    $pdo = new PDO("mysql:host=localhost;dbname=excellenttaste", 'root', '');
                    
                    //sql query preparen
                    $sth = $pdo->prepare("SELECT 

                                            bestelling.ID, 
                                            menuitems.Naam, 
                                            bestelling.Menuitem_ID, 
                                            bestelling.Geserveerd,
                                            bestelling.Aantal,
                                            menuitems.Code

                                            FROM ( bestelling 

                                            INNER JOIN menuitems ON bestelling.Menuitem_ID = menuitems.ID);");
                    $sth->execute();

                    //data correct in colom zetten
                    while($row = $sth->fetch())
                    {
                        //check of hij niet al gereed is en of het eten is
                        if($row['Geserveerd'] == 0 && $row['Code'] == "WE" OR $row['Geserveerd'] == 0 && $row['Code'] == "KE")
                        {
                            ?>
                            <tr>
                                <td scope="row"><?php echo $row['Naam']?></td>
                                <td><?php echo $row['Aantal']?></td>
                                <td><a href="gereed.php?bestelling_id=<?php echo $row['ID']?>" style="text-decoration: none;">klaar!</a></td>
                            </tr>
                            <?php    
                        }

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