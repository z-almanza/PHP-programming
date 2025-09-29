<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="This page does not include content assisted by AI tools but will indicate if it does. Professor Herd\'s class articles and W3Schools were used for guidance.">
        <title>PHP Webpage</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/styles.css">
    </head>

    <body>
    <div class="container">

    <header>
        <h1>My PHP Webpage</h1>
    </header>
    <nav>
        <a href="../index.html">Welcome</a> |
        <a href="../index.html#about">About Me</a> |
        <a href="php-info.php">PHP Info</a> |
        <a href="index.php">PHP Index</a> |
        <a href="array.php">PHP Arrays</a> |
        <a href="form.php">PHP Form</a> 
    </nav>

    <main>

    <?php //Start of PHP
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
            // Add shipping for CDs
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
            $pageContent .= "<p>$heading: $$downloadPrice per $media</p>";
        } 
        //Total price with formatting
        $pageContent .= "<p>Total cost: $" . number_format($total, 2) . "</p>";
        
        echo $pageContent;
    ?>

    </main>
    
    <footer>
        <p>&copy; 2025 Zamantha Almanza</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </div>
    </body>
</html>