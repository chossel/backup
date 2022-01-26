<?php

    //class instantieren
    include("model.php");
    $Model = new Model();

    //Get gegevens meegeven aan functie
    $aantal = 1;
    $Model->addToCart($_GET['klant_id'], $_GET['menuitems_id'], $aantal);
?>