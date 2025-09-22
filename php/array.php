<?php
    //HTML structure
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

    //Arrays Content
    //Creating an associative array of 5 album titles and random album ratings
    $albums = [
        "The Most Hated" => 1,
        "Chronologic" => 8,
        "Art Angels" => 6,
        "Spirit Phone" => 7,
        "GINGER" => 9
    ];

    //Adding Abbey Road to list of albums
    $albums["Abbey Road"] = 10;

    //Assigning Favorite Albums heading to pageContent variable and start of unordered list
    $pageContent = "<h2>Favorite Albums</h2>";
    $pageContent .= "<ul>";
    //Sorting albums array by title (key)
    ksort($albums); 

    //Using a foreach loop to display album titles sorted by title in an HTML list
    foreach ($albums as $title => $rating) {
        $pageContent .= "<li>$title has a rating of $rating stars</li>";
    }
    $pageContent .= "</ul>";


    //Creating arrays for multidimensional array
    $theBeatles = ["A Hard Day's Night" => 1964,
                    "Help!" => 1965,
                    "Rubber Soul" => 1965,
                    "Abbey Road" => 1969
                ];

    $ledZeppelin = ["Led Zeppelin IV" => 1971];

    $rollingStones = ["Let It Bleed" => 1969,
                        "Sticky Fingers" => 1971
                    ];

    $theWho = ["Tommy" => 1969,
                "Quadrophenia" => 1973,
                "The Who by Numbers" => 1975
                ];  

    //Creating a multidimensional array
    $bands = [
        "The Beatles" => $theBeatles,
        "Led Zeppelin" => $ledZeppelin,
        "The Rolling Stones" => $rollingStones,
        "The Who" => $theWho
    ];

    //Displaying Tommy by the Who's release date using concatenation
    $pageContent .= "<p>The Who's \"Tommy\" was released in " . $bands["The Who"]["Tommy"] . "</p>";

    //Looping through full array and adding artist and album list to pageContent
    $pageContent .= "<h2>Artists</h2>";
    //Loops through every band in bands array
    foreach ($bands as $artist => $albums) {
        $pageContent .= "<h3>$artist</h3>";
        $pageContent .= "<ul>";
        //Loops through every album and adds to list
        foreach ($albums as $album => $year) {
            $pageContent .= "<li>$album was released in $year</li>";
        }
        $pageContent .= "</ul>";
    }

    //Looping and appending all albums and release years for the Who
    $pageContent .= "<h2>The Who albums and release years</h2>";
    $pageContent .= "<ul>";
    //Looping through only the Who's albums
    foreach ($bands["The Who"] as $album => $year) {
        $pageContent .= "<li>$album was released in $year</li>";
    }
    $pageContent .= "</ul>";

    //Looping through array and listing all albums released after 1970
    $pageContent .= "<h2>Albums released after 1970</h2>";
    $pageContent .= "<ul>";
    //Loops through every band in bands array
    foreach ($bands as $artist => $albums) {
        //Loops thropugh every album
        foreach ($albums as $album => $year) {
            //Only allows albums greater than 1970 to be added to list
            if ($year > 1970) {
                $pageContent .= "<li>$album by $artist was released in $year</li>";
            }
        }
    }
    $pageContent .= "</ul>";

    //Displaying all of pageContent
    echo $pageContent;

    echo '</main>
        <footer>
            <p>&copy; 2025 Zamantha Almanza</p>
        </footer>
    </body>
    </html>';
?>