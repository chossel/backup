<?php 
    //class instantieren
    include("model.php");
    $Model = new Model();

    //_GET informatie meegeven aan functie
    $Model->orderReady($_GET['bestelling_id']);
?>
