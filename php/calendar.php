<?php
//function to return which greeting to use
function getTheTimeOfDay ($tod) {
    if ($tod >= 6 && $tod < 12) {
        $timeOfDay = "morning";
    } 
    elseif ($tod >=12 && $tod < 18) {
        $timeOfDay = "afternoon";
    } 
    elseif ($tod >=18 && $tod < 21) {
        $timeOfDay = "evening";
    }
    else {
        $timeOfDay = "night";
    }
    return $timeOfDay;
}

//function to return month
function getSemester($month) {
    if ($month >= 0 && $month <= 5){
        $semester = "spring";
    }
    elseif ($month > 5 && $month < 8){
        $semester = "summer";
    }
    else {
        $semester = "fall";
    }
    return $semester;
}

//function to get how many days until next favorite holiday
function getHolidayAnnouncement($favHoliday, $day) {
    if ($favHoliday == $day) {
        $holidayAnnouncement = "Merry Christmas!";
    }
    elseif ($favHoliday > $day) {
        $holidayAnnouncement = "There are " . ($favHoliday - $day) . " days until Christmas.";
    }
    else {
        $endOfYear = date('z', strtotime("December 31"));
        $nextYear = date('z', strtotime("December 25 +1 year"));
        $diff = ($endOfYear - $day) + $nextYear;
        $holidayAnnouncement = "There are $diff days until next year's Christmas";
    }
    return $holidayAnnouncement;
}

//If new date selected, different information shows
if (isset($_POST['submit'])) {
    date_default_timezone_set('America/Chicago');
    $date = strtotime($_POST['date']);
    $time = strtotime($_POST['time']);
    $selectedDate = date('l, F j, Y', $date);
    $selectedTime = date('g:i A', $time);
    $dateVal = date('Y-m-d', $date);
    $timeVal = date('H:i', $time);
    $timeOfDay = getTheTimeOfDay(date('H', $time));
    $semester = getSemester(date('m', $date));
    $favHoliday = date('z', strtotime("December 25"));
    $dateSelected = date('z', $date);
    $holidayAnnouncement = getHolidayAnnouncement($favHoliday, $dateSelected);
    if ($holidayAnnouncement === "Merry Christmas!") {
        $holidayImage = "images/christmas.jpg";
    }
    else {
        $holidayImage = "images/notChristmas.jpg";
    }
	
    $pageContent = <<<HERE
    <h2>Welcome! The date is $selectedDate. The time is $selectedTime.</h2>

    <p>It is $timeOfDay.</p>
    <img src="images/$timeOfDay.jpg" alt="image of $timeOfDay time"><br><br>

    <p>It is the $semester semester.</p>
    <img src="images/$semester.jpg" alt="image of $semester season"><br><br>

    <p>$holidayAnnouncement</p>
    <img src="$holidayImage" alt="Christmas themed picture"><br><br>

    <form method="post">
        <label class="form-label" for="time" name="time" >Choose a different time:</label>
        <input id="time" type="time" name="time" value="$timeVal"><br>

        <label class="form-label" for="date" name="date" >Choose a diffferent date:</label>
        <input id="date" type="date" name="date" value="$dateVal"><br>

        <input class="button" type="submit" name="submit" value="Show Selected">
        <input class="button" type="submit" name="reset" value="Show Now">
    </form>
HERE;

}
else {
    date_default_timezone_set('America/Chicago');
    $currentDate = date('l, F j, Y');
    $currentTime = date('g:i A');
    $dateVal = date('Y-m-d');
    $timeVal = date('H:i');
    $hour = date('H');
    $month = date('n');
    $timeOfDay = getTheTimeOfDay($hour);
    $semester = getSemester($month);
    $favHoliday = date('z', strtotime("December 25"));
    $today = date('z');
    $holidayAnnouncement = getHolidayAnnouncement($favHoliday, $today);
    if ($holidayAnnouncement === "Merry Christmas!") {
        $holidayImage = "images/christmas.jpg";
    }
    else {
        $holidayImage = "images/notChristmas.jpg";
    }
	

    $pageContent = <<<HERE
    <h2>Welcome! The current date is $currentDate. The time is $currentTime.</h2>
	
    <p>It is $timeOfDay time.</p>
    <img src="images/$timeOfDay.jpg" alt="image of $timeOfDay time"><br><br>

    <p>It is the $semester semester.</p>
    <img src="images/$semester.jpg" alt="image of $semester season"><br><br>

    <p>$holidayAnnouncement</p>
    <img src="$holidayImage" alt="Christmas themed picture"><br><br>

    <form method="post">
        <label class="form-label" for="time" name="time" >Choose a different time:</label>
        <input id="time" type="time" name="time" value="$timeVal"><br>

        <label class="form-label" for="date" name="date" >Choose a diffferent date:</label>
        <input id="date" type="date" name="date" value="$dateVal"><br>

        <input class="button" type="submit" name="submit" value="Show Selected">
        <input class="button" type="submit" name="reset" value="Show Now">
    </form>
HERE;
}

$pageTitle = "Calendar";
include 'template.php';
?>