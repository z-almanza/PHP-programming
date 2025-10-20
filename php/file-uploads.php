<?php
//Setting variables to null
$firstName = NULL;
$lastName = NULL;
$fullName = NULL;
$firstLetter = NULL;
$username = NULL;
$email = NULL;
$password = NULL;
$passwordVer = NULL;
$filetype = NULL;
$filename = NULL;
$data_entry = NULL;
$profilePic = NULL;
$newfile = NULL;
$membershipStatus = NULL;
$poem = NULL;
$poemText = NULL;
$imageName = NULL;

//Setting errors to null
$firstNameError = NULL;
$lastNameError = NULL;
$emailError = NULL;
$passwordError = NULL;
$passwordVerError = NULL;
$imageError = NULL;
$membershipError = NULL;
$poemError = NULL;

$valid = false;

if (isset($_POST['submit'])) {
    $valid = true;

    //First Name Validation
    //htmlspecialchars() for sanitation
	$firstName = htmlspecialchars($_POST['firstName']);
    //Checking if first name string empty
	if (empty($firstName)) {
		$firstNameError = "<span class='text-danger'>Enter first name</span>";
		$valid = false;
	}
    else {
        //Lose excess whitespace and uppercase every individual word
        $firstName = trim($firstName);
        $firstName = ucwords($firstName);
    }

    //Last Name Validation
    //htmlspecialchars() for sanitation
	$lastName = htmlspecialchars($_POST['lastName']);
    //Checking if last name string empty
	if (empty($lastName)) {
		$lastNameError = "<span class='text-danger'>Enter last name</span>";
		$valid = false;
	}
    else {
        //Lose excess whitespace and uppercase every individual word
        $lastName = trim($lastName);
        $lastName = ucwords($lastName);
    }

    //Generating username
    if (!empty($firstName) && !empty($lastName)) {
        $fullName = $firstName . " " . $lastName;
        $firstLetter = strtolower(substr($firstName, 0, 1));
        $username = $firstLetter . $lastName;
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

    //Password Validation
    //htmlspecialchars() for sanitation
	$password = htmlspecialchars($_POST['password']);
    //Checking if password string empty
	if (empty($password)) {
		$passwordError = "<span class='text-danger'>Enter password</span>";
		$valid = false;
	}
    else {
        //Lose excess whitespace
        $lastName = trim($lastName);
    }

    //Password Verification Validation
    //htmlspecialchars() for sanitation
	$passwordVer = htmlspecialchars($_POST['passwordVer']);
    //Checking if password string empty
	if (empty($password)) {
		$passwordVerError = "<span class='text-danger'>Enter password again</span>";
		$valid = false;
	}
    else if (trim($passwordVer) !== $password){
        //Checking if passwords match
        $passwordVerError = "<span class='text-danger'>Passwords do not match</span>";
        $valid = false;
    }
    else {
        $passwordVer = trim($passwordVer);
    }

    //File Validation 
    $filetype = pathinfo($_FILES['profilePic']['name'], PATHINFO_EXTENSION);
    //Checking that file is image and less than or equal to 300KB
    if ((($filetype === "jpg") or ($filetype === "png")) and $_FILES['profilePic']['size'] <= 300000) {
        if ($_FILES["profilePic"]["error"] > 0) {
            $imageError = $_FILES['profilePic']['error'];
            $valid = false;
        }
        else {
            //Image exists within KB limit - checking if not duplicate to then upload to images directory
            if (file_exists("images/" . $_FILES['profilePic']['name'])){
                $imageError = "<span class='text-danger'>File already exists</span>";
            }
            else {
                move_uploaded_file($_FILES['profilePic']['tmp_name'], "images/" . $_FILES['profilePic']['name']);
            }
        }
    }
    else {
        $imageError = "<span class='text-danger'>Invalid File</span>";
        $valid = false;
    }

    //User data appended to membership.txt
    $filename = "membership.txt";
    $data_entry = $firstName . "," . $lastName . "," . $email . "," . $username . "," . $password . "\n";
    $fp = fopen($filename, "a") or die ("Could not open file");
    if (fwrite($fp, $data_entry) > 0) {
        $membershipStatus = "Successful";
    }
    else {
        $membershipError = "<span class='text-danger'>Could not log membership information</span>";
        $valid = false;
    }
    $fp = fclose($fp);

    $poem = "poem.txt";
    $fp = fopen($poem, "r") or die ("Could not open file");
    if (!feof($fp)) {
        $poemText = fgets($fp);
    }
    else {
        $poemError = "<span class='text-danger'>Could not open poem.txt</span>";
    }
    $fp = fclose($fp);
}

if ($valid) {
    //Display summary including user data and uploaded image
    $imageName = $_FILES['profilePic']['name'];
    $pageContent = <<<HERE
        <h1>Welcome, $fullName</h1>
        <p>Your membership status is $membershipStatus</p>
        <p>Email: $email</p>
        <p>Username: $username</p>
        <p>Your Profile Picture:</p>
        <img src="images/$imageName" alt="profile picture" width="500" height="auto">
HERE;

    $pageContent .= <<<HERE
        <p>Here is the poem in poem.txt</p>
        <p>$poemText</p>
HERE;
}
else {
    $pageContent = <<<HERE
<fieldset>
    <legend> File Handling and Uploads </legend>
    <form method="post" action="file-uploads.php" enctype="multipart/form-data">
        <!--Accepts user's first name as text input-->
        <label class="form-label" for="firstName">First Name</label>
        <input type="text" name="firstName" id="firstName" value="$firstName"> $firstNameError <br>

        <!--Accepts user's last name as text input-->
        <label class="form-label" for="lastName">Last Name</label>
        <input type="text" name="lastName" id="lastName" value="$lastName"> $lastNameError <br>

        <!--Accepts user's email as text input-->
        <label class="form-label" for="email">Email</label>
        <input type="text" name="email" id="email" value="$email"> $emailError <br>

        <!--Accepts user's password as text input-->
        <label class="form-label" for="password">Password</label>
        <input type="text" name="password" id="password"> $passwordError <br>

        <!--Accepts user's password again as text input-->
        <label class="form-label" for="passwordVer">Verify Password</label>
        <input type="text" name="passwordVer" id="passwordVer"> $passwordVerError <br>

                <!--UPLOAD-->
        <label class="form-label" for="file">Submit a profile picture below. JPG or PNG files Only.</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="300000">
        <label class="form-label" for="profilePic">File to Upload:</label> $imageError
        <input type="file" name="profilePic" id="profilePic" class="form-control">

        $membershipError
        <input class="form-control" type="submit" name="submit" value="Submit">
    </form>
</fieldset>
HERE;
}

$pageTitle = "File Handling & Uploads";
include 'template.php';
?>