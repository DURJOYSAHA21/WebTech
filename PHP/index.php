<?php
// Correct answers array
$correct_answers = [
    "q1" => "b",
    "q2" => "a",
    "q3" => "c",
    "q4" => "d",
    "q5" => "b"
];

$score = 0;
$percentage = 0;
$feedback = "";

// Store user answers
$user_answers = [];

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    foreach ($correct_answers as $key => $value) {
        if (isset($_POST[$key])) {
            $user_answers[$key] = $_POST[$key];

            if ($_POST[$key] == $value) {
                $score++;
            }
        }
    }

    // Calculate percentage
    $percentage = ($score / count($correct_answers)) * 100;

    // Feedback using switch
    switch (true) {
        case ($percentage >= 80):
            $feedback = "Excellent";
            break;
        case ($percentage >= 60):
            $feedback = "Good";
            break;
        case ($percentage >= 40):
            $feedback = "Average";
            break;
        default:
            $feedback = "Poor";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Quiz</title>
</head>
<body>

<h2>Web Technologies Quiz</h2>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <!-- Question 1 -->
    <p>1. What does HTML stand for?</p>
    <input type="radio" name="q1" value="a"
        <?php if(isset($user_answers['q1']) && $user_answers['q1']=="a") echo "checked"; ?>> Hyper Trainer Marking Language<br>
    <input type="radio" name="q1" value="b"
        <?php if(isset($user_answers['q1']) && $user_answers['q1']=="b") echo "checked"; ?>> Hyper Text Markup Language<br>

    <!-- Question 2 -->
    <p>2. Which language is used for styling?</p>
    <input type="radio" name="q2" value="a"
        <?php if(isset($user_answers['q2']) && $user_answers['q2']=="a") echo "checked"; ?>> CSS<br>
    <input type="radio" name="q2" value="b"
        <?php if(isset($user_answers['q2']) && $user_answers['q2']=="b") echo "checked"; ?>> PHP<br>

    <!-- Question 3 -->
    <p>3. Which is a JavaScript framework?</p>
    <input type="radio" name="q3" value="a"
        <?php if(isset($user_answers['q3']) && $user_answers['q3']=="a") echo "checked"; ?>> Laravel<br>
    <input type="radio" name="q3" value="b"
        <?php if(isset($user_answers['q3']) && $user_answers['q3']=="b") echo "checked"; ?>> Django<br>
    <input type="radio" name="q3" value="c"
        <?php if(isset($user_answers['q3']) && $user_answers['q3']=="c") echo "checked"; ?>> React<br>

    <!-- Question 4 -->
    <p>4. Which method is used to send data securely?</p>
    <input type="radio" name="q4" value="c"
        <?php if(isset($user_answers['q4']) && $user_answers['q4']=="c") echo "checked"; ?>> GET<br>
    <input type="radio" name="q4" value="d"
        <?php if(isset($user_answers['q4']) && $user_answers['q4']=="d") echo "checked"; ?>> POST<br>

    <!-- Question 5 -->
    <p>5. PHP is a ____ language?</p>
    <input type="radio" name="q5" value="a"
        <?php if(isset($user_answers['q5']) && $user_answers['q5']=="a") echo "checked"; ?>> Client-side<br>
    <input type="radio" name="q5" value="b"
        <?php if(isset($user_answers['q5']) && $user_answers['q5']=="b") echo "checked"; ?>> Server-side<br>

    <br><br>
    <input type="submit" value="Submit">

</form>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>

    <h3>Result</h3>
    <p>Score: <?php echo $score; ?>/5</p>
    <p>Percentage: <?php echo $percentage; ?>%</p>
    <p>Feedback: <?php echo $feedback; ?></p>

<?php } ?>

</body>
</html>