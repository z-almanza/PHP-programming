<?php
//Setting variables to null
$name = NULL;
$email = NULL;
$instrument = NULL;
$animal1 = $animal2 = NULL;
$activity = NULL;

//Setting errors and lists to null
$nameError = NULL;
$emailError = NULL;
$instrumentError = NULL;
$instrumentList = NULL;
$animalError = NULL;
$animalList = NULL;
$activityError = NULL;
$activityList = NULL;

$valid = false;

//Arrays for holding values and foreach functions to create sticky form
$instrumentArray = array('Guitar', 'Drums', 'Bass', 'Tambourine', 'Keyboard');
foreach ($instrumentArray as $instrumentName) {
    $instrumentChecked[$instrumentName] = NULL;
}

$animalArray = array('Dog','Cat','Chicken','Duck', 'Lizard');
foreach ($animalArray as $animalIndex => $animalName) {
    $animalChecked[$animalName] = NULL;
} 

$activityArray = array('Gaming', 'Crochet', 'Walking', 'Baking', 'Coding');
foreach ($activityArray as $activityName) {
    $activityChecked[$activityName] = NULL;
} 

//Submission validation 
if (isset($_POST['submit'])) {
	$valid = true; //True until proven false

	//Name Validation
    //htmlspecialchars() for sanitation
	$name = htmlspecialchars($_POST['name']);
    //Checking if name string empty
	if (empty($name)) {
		$nameError = "<span class='text-danger'>Enter name</span>";
		$valid = false;
	}
    else {
        //Lose excess whitespace and uppercase every individual word
        $name = trim($name);
        $name = ucwords($name);
    }

    //Email Validation
    //htmlspecialchars() for sanitation
    $email = htmlspecialchars($_POST['email']);
    //Checking if email string empty
    if (empty($email)) {
        $emailError = "<span class='text-danger'>Enter email</span>";
        $valid = false;
    }
    else {
        $email = (trim($email));
        //Validating email format using preg_match()
        if(!preg_match('/[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}/', $email)){
            $emailError = "<span class='text-danger'>Enter valid email</span>";
            $valid = false;
        }
    }

    //Instrument Validation
    //Checking if instrument selection exists
    if (empty($_POST['instrument'])){
        $instrumentError = "<span class='text-danger'>Select Instrument</span>";
        $valid = false;
    }
    else {
        $instrument = $_POST['instrument'];
        //Marking instrument as selected for sticky form
        if (in_array($instrument, $instrumentArray)) {
            $instrumentChecked[$instrument] = 'checked';
        }
    }

    //Animal Validation
    //Checking if animal selection exists
    if (isset($_POST['animal'])) {
        //Count to keep track of how many animals were selected
        $animalCount = COUNT($_POST['animal']);
        //Each animal selected goes into array
        foreach ($_POST['animal'] as $index => $animal) {
            $selectedAnimal[] = $animal;
            //Marking animals selected for sticky form
            if (in_array($animal, $animalArray)) {
                $animalChecked[$index] = "checked";
            }
        }
        //Saving animals based on how many selected
        if ($animalCount === 2) {
            $animal1 = $selectedAnimal[0];
            $animal2 = $selectedAnimal[1];
        }
        else if ($animalCount === 1) {
            $animal1 = $selectedAnimal[0];
            $animal2 = NULL;
        }
        else {
            $animalError = "<span class='text-danger'>Select up to 2 animals</span>";
            $valid = false;
        }
    }
    else {
        $animalError = "<span class='text-danger'>Select at least 1 animal</span>";
        $valid = false;
    }

    //Activity Validation
    //Checking if activity exists
    if (empty($_POST['activity'])) {
        $activityError = "<span class='text-danger'>Select Activity</span>";
        $valid = false;
    }
    else {
        //Saving activity for sticky form
        $activity = $_POST['activity'];
        if (in_array($activity, $activityArray)) {
            $activityChecked[$activity] = 'selected';
        }
    }
}

//Checking Validation
if ($valid) {
	$pageContent = <<<HERE
    <h2>Welcome, $name!</h2>
    <p>Your email is $email</p>
    <p>Your favorite instrument is $instrument</p>
HERE;
    if ($animal2 !== NULL){
        $pageContent .= "<p>Your favorite animals are $animal1 and $animal2</p>";
    }
    else {
        $pageContent .= "<p>Your favorite animal is $animal1</p>";
    }

    $pageContent .= <<<HERE
    <p>Your favorite activity is $activity</p>
HERE;

if(isset($_POST['submit'])){
    $pageContent .= "<pre>";
    $pageContent .= print_r($_POST, TRUE);
    $pageContent .= "</pre>";
}    
}
else {
    $pageContent = <<<HERE
<fieldset>
    <legend> Form Submission </legend>
    <form method="post" action="form-validation.php">
            <!--Accepts user's name as text input-->
            <label class="form-label" for="name">Name</label>
            <input type="text" name="name" id="name" value="$name"> $nameError <br>

            <!--Accepts user's email as text input-->
            <label class="form-label" for="email">Email</label>
            <input type="text" name="email" id="email" value="$email"> $emailError <br> <br>

            <!--Radio buttons to select one favorite musical instrument-->
            <label class="form-label" for="instrument" class="form-label">Select Favorite Instrument:</label> <br>
HERE;
    //foreach loop to create radio list of instruments
    foreach ($instrumentArray as $instrumentName) {
        $instrumentList .= <<<HERE
        <input class="form-check-input" type="radio" name="instrument" id="$instrumentName" value="$instrumentName" $instrumentChecked[$instrumentName]>
        <label class="form-label" for="$instrumentName">$instrumentName</label> \n
HERE;
    }
    $pageContent .= <<<HERE
        $instrumentList $instrumentError <br> <br>

            <!--Checkbox to select up to 2 favorite animals-->
            <label class="form-label" for="animal" class="form-label">Select up to 2 Favorite Animals:</label> <br>
HERE;
    //foreach loop to create checkbox list of animals
    foreach ($animalArray as $animalIndex => $animalName) {
        $animalList .= <<<HERE
        <input class="form-check-input" type="checkbox" name="animal[$animalIndex]" id="$animalIndex" value="$animalName" $animalChecked[$animalIndex]>
        <label class="form-label form-check-label" for="$animalIndex">$animalName</label> \n
HERE;
    }
    $pageContent .= <<<HERE
        $animalList $animalError <br> <br>

            <!--Dropdown to select one favorite activity-->
            <label class="form-label" for="activity" class="form-label">Select Favorite Activity:</label> <br>
HERE;
    //foreach loop to create option dropdown of activities
    $activityList = <<<HERE
    <select class="form-control form-select" name="activity" id="activity">
HERE;
    foreach($activityArray as $activityName) {
        $activityList .= <<<HERE
        <option value="$activityName" $activityChecked[$activityName]>$activityName</option>
HERE;
        
    }
    $activityList .= "</select>";
    $pageContent .= <<<HERE
        $activityList $activityError <br>

            <input class="form-control" type="submit" name="submit" value="Submit">
    </form>
</fieldset>
HERE;
}

$pageTitle = "Form Validation";
include 'template.php';
?>