<?php

//Price calculator function to add discounts based on quantity
function priceCalc($price, $quantity) {
    //Numeric array for discounts - Discounts given based on how many albums ordered
    $discounts = [0, 0, 0.05, 0.1, 0.2, 0.25];
    $index = $quantity;
    if ($index > 5){
        $index = 5;
    };
    $total = $price - ($price * $discounts[$index]);

    return $total;
}

?>