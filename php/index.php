<?php
    //Added HTML structure
    echo '<!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="This page does not include content assisted by AI tools but will indicate if it does. Professor Herd\'s class articles and W3Schools were used for guidance.">
            <title>PHP Webpage</title>
            <link rel="stylesheet" href="../css/styles.css">
        </head>

        <body>

        <header>
            <h1>Welcome!</h1>
        </header>
        <nav>
            <a href="../index.html">Welcome</a> |
            <a href="../index.html#about">About Me</a> |
            <a href="php-info.php">PHP Info</a> |
            <a href="index.php">PHP Index</a> |
            <a href="array.php">PHP Arrays</a>
        </nav>

        <main>';

    //Welcome Message
    echo "<h1>Welcome to My Website</h1>";
    echo "<p>Hello! This is my first script using PHP that showcases some fundamentals like syntax, variables, and output.</p>";
	echo "<p>I am learning PHP through this programming course in order to fulfill a degree requirement.</p>";
    echo "<p>I want to become a web developer and I am excited to learn more about PHP!</p>";
    
    //PHP var with favorite G/PG rated quote
    //The quote is stored in a string variable, then echoed onto the page using a blockquote element
    $favoriteQuote = "Shoot for the moon. Even if you miss, you'll land among the stars.";
    $favoriteQuoteAuthor = " - Norman Vincent Peale";
    echo "<h2>Quote</h2>";
    echo "<blockquote>$favoriteQuote<br>
        $favoriteQuoteAuthor </blockquote>";

    //PHP vars for CodeStream Solutions address
    //The address is stored in several variables, then echoed onto the page using an address element
    $company = "CodeStream Solutions";
    $address = "3939 Valley View Ln";
    $city = "Farmers Branch";
    $state = "TX";
    $zip = 75244;
    echo "<h2>CodeStream Solutions Address</h2>";
    echo "<address>$company<br>
        $address<br>
        $city, $state $zip</address>";

    //Assign 2 numbers to x and y, perform following operations + - * / %
    /*The calculations for the x and y variable are echoed using concatenation
    The addition, subtraction, and multiplication operations are done within the paragraph
    The division and modulus operations are stored in variables*/
    $x = 10;
    $y = 5;
    //Stored division and modulus results in seperate variables
    $division = $x / $y; 
    $modulus = $x % $y; 
    echo "<h2>Calculations: 10 and 5</h2>";
    echo "<p>$x + $y = " . ($x + $y) . "</p>";
    echo "<p>$x - $y = " . ($x - $y) . "</p>";    
    echo "<p>$x * $y = " . ($x * $y) . "</p>";
    echo "<p>$x / $y = " . $division . "</p>";
    echo "<p>$x % $y = " . $modulus . "</p>";

    //Constant with my name, displayed
    define("MY_NAME", "Zamantha");
    echo "<h2>Additional Information</h2>";
    echo "<p>My name is " . MY_NAME . "</p>";

    //Use PHP superglobal and display current script filename
    echo "<p>The current script filename is: " . $_SERVER['SCRIPT_NAME'] . "</p>";
    
    echo '</main>
            <footer>
                <p>&copy; 2025 Zamantha Almanza</p>
            </footer>
        </body>
        </html>';
?>