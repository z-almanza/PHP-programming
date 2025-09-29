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
        <fieldset>
            <legend>Purchase Information</legend>
            <form method = "post" action = "handle-form.php"> <!--Double check form action-->     
                <!--Accepts user's name as text input-->
                <p>
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" required>
                </p>

                <!--Dropdown list of albums generated from associative array-->
                <p>
                <label for="album" class="form-label">Select Album:</label>
                <select id="album" name="album" class="form-select">
                    <?php
                        $albums = array(
                            "Album1" => "The Most Hated",
                            "Album2" => "Chronologic",
                            "Album3" => "Art Angels",
                            "Album4" => "Spirit Phone",
                            "Album5" => "GINGER"
                        );
                        foreach($albums as $key => $value) {
                            echo "<option value='$value'>$value</option>";
                        }
                    ?>
                </select>
                </p>

                <!--Accepts quantity as text input-->
                <p>
                <label for="quantity" class="form-label">Quantity</label>
                <input type="text" id="quantity" name="quantity" placeholder="Use a numerical value." required>
                </p>

                <!--Radio buttons for format selection-->
                <p>Select Format:</p>
                <input class="form-check-input" type="radio" id="cd" name="format" value="CD" required>
                <label for="cd" class="form-label">CD</label>
                <input class="form-check-input" type="radio" id="download" name="format" value="Download" required>
                <label for="download" class="form-label">Download</label>
                

                <!--Submit button to send data to handle-form.php-->
                <p>
                <input type="submit" value="Submit">
                </p>
            </form>
        </fieldset> 

    </main>
    
    <footer>
        <p>&copy; 2025 Zamantha Almanza</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </div>
    </body>
</html>