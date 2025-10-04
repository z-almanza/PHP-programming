<?php
    //Including functions.php to help calculate discounted total and added page title 
    include 'functions.php';
    $pageTitle = 'Invoice Submitted';

    $shipping = 2.99;
    $downloadPrice = 9.99;
    $cdPrice = 12.99;
    $heading = "Cost by Quantity";
    $pageContent = ""; //New pageContent variable to store all shown HTML components

    //Store name in variable
    $name = $_POST['name'];
    $pageContent .= "<h2>Thank you for your order, $name!</h2>";

    //Store selected format, album, and quantity in variables
    $media = $_POST['format'];
    $album = $_POST['album'];
    $quantity = $_POST['quantity'];

    //Display selected album title, format, and quantity
    $pageContent .= "<p>You selected " . $quantity . " " . $media . "(s) for the album $album</p>";

    //Loops to calculate total price
    $total = 0;
    if ($media == 'CD') {
        //for loop for calculating CD media price
        for ($i = 1; $i <= $quantity; $i++) {
            $total += $cdPrice;
        }
        //Sending $total and $quantity to function priceCalc to calculate any discounts added
        $total = priceCalc($total, $quantity);
        //Add shipping for CDs
        $total += $shipping; 
        $pageContent .= "<p>$heading: $$cdPrice per $media</p>";
        $pageContent .= "<p>Additional shipping cost for CDs: $$shipping</p>";
    } elseif ($media == 'Download') {
        //while loop for calculating Download media price
        $i = 1;
        while ($i <= $quantity) {
            $total += $downloadPrice;
            $i++;
        }
        //Sending $total and $quantity to function priceCalc to calculate any discounts added
        $total = priceCalc($total, $quantity);
        $pageContent .= "<p>$heading: $$downloadPrice per $media</p>";
    } 
    //Total price with formatting
    $pageContent .= "<p>Total cost: $" . number_format($total, 2) . "</p>";

    //Included template.php to display content
    include 'template.php';
?>