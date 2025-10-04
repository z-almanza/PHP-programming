<?php
//Adding form components to $pageContent
$pageContent = <<<HERE
<fieldset>
    <legend>Purchase Information</legend>
    <form method = "post" action = "handle-invoice.php"> <!--Double check form action-->     
        <!--Accepts user's name as text input-->
        <p>
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" required>
        </p>

        <!--Dropdown list of albums generated from associative array-->
        <p>
        <label for="album" class="form-label">Select Album:</label>
        <select id="album" name="album" class="form-select">
HERE;
      
//Associative array with artists and album names
$albums = array(
    "Polyphia" => "The Most Hated",
    "Caravan Palace" => "Chronologic",
    "Grimes" => "Art Angels",
    "Lemon Demon" => "Spirit Phone",
    "BROCKHAMPTON" => "GINGER",
    "Hail the Sun" => "Wake",
    "Coheed and Cambria" => "Good Apollo",
    "PinkPantheress" => "FancyThat",
    "MCR" => "Three Cheers",
    "100 gecs" => "10,000 gecs",
    "Arctic Monkeys" => "AM",
);
foreach($albums as $key => $value) {
    $pageContent .= "<option value='$value'>$key - $value</option>";
}            

//Form continued
$pageContent .= <<<HERE
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
HERE;

//Added title and inputing $pageContent into template
$pageTitle = "Invoice";
include 'template.php';
?>