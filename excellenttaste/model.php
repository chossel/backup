<?php

class Model
{
    public $conn;
    private $username = "root";
    private $password;

    //voert connectie hele tijd uit aan ieder begin van een functie
    function __construct()
    {
        try 
        {
            $this->conn = new PDO("mysql:host=localhost;dbname=excellenttaste", $this->username, $this->password);
            return $this->conn;
        } catch (Exception $e) 
        {
            echo "connectie niet gelukt" . $e->getMessage();
        }
    }

    //met een knop en wat door gegevens data een bestelling aanmaken
    function addToCart($reserverings_ID, $menuitem_ID, $aantal)
    {
        try 
        {
            $query = "INSERT INTO `bestelling` (`ID`, `Reservering_ID`, `Menuitem_ID`, `Aantal`) VALUES (NULL, '$reserverings_ID', '$menuitem_ID', '$aantal');";
            $sth = $this->conn->prepare($query);
            $sth->execute();
    
            //alert boven in het scherm dat hij toegevoegd
            echo "<script>alert('bestelling toegevoegd');</script>";
            echo "<script>window.location.href = 'bestelling.php?klant_id=" . $reserverings_ID . "';</script>";
        } catch (Exception $e) 
        {
            //alert boven in het scherm dat hij niet toegevoegd
            echo "<script>alert('bestelling niet toegevoegd');</script>" . $e->getMessage();
            echo "<script>window.location.href = 'bestelling.php?klant_id=" . $reserverings_ID . "';</script>";
        }
    }

    //functie voor de kok/barman om order op gereed te zetten
    function orderReady($bestelling_ID)
    {
        try 
        {
            $query = "UPDATE `bestelling` SET `Geserveerd` = '1' WHERE `bestelling`.`ID` = '$bestelling_ID';";
            $sth = $this->conn->prepare($query);
            $sth->execute();

            //alert boven in het scherm dat hij op klaar staat
            echo "<script>alert('Bestelling staat klaar!');</script>";
            echo "<script>window.location.href = 'kok.php';</script>";
        } catch (Exception $e) 
        {
            //alert boven in het scherm dat het niet is gelukt
            echo "<script>alert('Niet gelukt bestelling klaar te zetten maar is wel klaar');</script>" . $e->getMessage();
            echo "<script>window.location.href = 'kok.php';</script>";
        }
    }

}

?>