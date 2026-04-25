<?php

$correct_answers = [
    "bd" => "b",
    "india" => "a",
    "pakistan" => "a",
    "srilanka" => "a",
    "nepal" => "a"
];

$score = 0;
$percentage = 0;
$feedback = "";


$user_answers = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    foreach ($correct_answers as $key => $value) {
        if (isset($_POST[$key])) {
            $user_answers[$key] = $_POST[$key];
    
            if ($_POST[$key] == $value) {
                $score++;
            }
        }
    }

    $percentage = ($score / count($correct_answers)) * 100;

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
        <title>Task</title>
    </head>
    <body>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label>what is the capital of Bangladesh?</label><br>
            <input type="radio" name="bd" value="a" <?php if (isset($user_answers['bd']) && $user_answers['bd'] == 'a') echo "checked"; ?>> Dhaka<br>
            <input type="radio" name="bd" value="b" <?php if (isset($user_answers['bd']) && $user_answers['bd'] == 'b') echo "checked"; ?>> Chittagong<br>
            <input type="radio" name="bd" value="c" <?php if (isset($user_answers['bd']) && $user_answers['bd'] == 'c') echo "checked"; ?>> Sylhet<br>
            <input type="radio" name="bd" value="d" <?php if (isset($user_answers['bd']) && $user_answers['bd'] == 'd') echo "checked"; ?>> Khulna<br>
           
            <label>what is the capital of India?</label><br>
            <input type="radio" name="india" value="a" <?php if (isset($user_answers['india']) && $user_answers['india'] == 'a') echo "checked"; ?> > Delhi<br>
            <input type="radio" name="india" value="b" <?php if (isset($user_answers['india']) && $user_answers['india'] == 'b') echo "checked"; ?>> Mumbai<br>
            <input type="radio" name="india" value="c" <?php if (isset($user_answers['india']) && $user_answers['india'] == 'c') echo "checked"; ?>> Kolkata<br>
            <input type="radio" name="india" value="d" <?php if (isset($user_answers['india']) && $user_answers['india'] == 'd') echo "checked"; ?>> Chennai<br>
           
            <label>what is the capital of Pakistan?</label><br>
            <input type="radio" name="pakistan" value="a" <?php if (isset($user_answers['pakistan']) && $user_answers['pakistan'] == 'a') echo "checked"; ?>> Islamabad<br>
            <input type="radio" name="pakistan" value="b" <?php if (isset($user_answers['pakistan']) && $user_answers['pakistan'] == 'b') echo "checked"; ?>> Karachi<br>
            <input type="radio" name="pakistan" value="c" <?php if (isset($user_answers['pakistan']) && $user_answers['pakistan'] == 'c') echo "checked"; ?>> Lahore<br> 
            <input type="radio" name="pakistan" value="d" <?php if (isset($user_answers['pakistan']) && $user_answers['pakistan'] == 'd') echo "checked"; ?>> Peshawar<br>
           
            <label>what is the capital of Sri Lanka?</label><br>
            <input type="radio" name="srilanka" value="a" <?php if (isset($user_answers['srilanka']) && $user_answers['srilanka'] == 'a') echo "checked"; ?>> Colombo<br>
            <input type="radio" name="srilanka" value="b" <?php if (isset($user_answers['srilanka']) && $user_answers['srilanka'] == 'b') echo "checked"; ?>> Kandy<br>
            <input type="radio" name="srilanka" value="c" <?php if (isset($user_answers['srilanka']) && $user_answers['srilanka'] == 'c') echo "checked"; ?>> Galle<br>
            <input type="radio" name="srilanka" value="d" <?php if (isset($user_answers['srilanka']) && $user_answers['srilanka'] == 'd') echo "checked"; ?>> Jaffna<br>
           
            <label>what is the capital of Nepal?</label><br>
            <input type="radio" name="nepal" value="a" <?php if (isset($user_answers['nepal']) && $user_answers['nepal'] == 'a') echo "checked"; ?>> Kathmandu<br>
            <input type="radio" name="nepal" value="b" <?php if (isset($user_answers['nepal']) && $user_answers['nepal'] == 'b') echo "checked"; ?>> Pokhara<br>
            <input type="radio" name="nepal" value="c" <?php if (isset($user_answers['nepal']) && $user_answers['nepal'] == 'c') echo "checked"; ?>> Biratnagar<br>
            <input type="radio" name="nepal" value="d" <?php if (isset($user_answers['nepal']) && $user_answers['nepal'] == 'd') echo "checked"; ?>> Lalitpur<br>

            <input type="submit" value="Submit">

        </form>
        <h3>Your Score: <?php echo $score; ?>/<?php echo count($correct_answers); ?></h3>
        <h3>Percentage: <?php echo number_format($percentage, 2); ?>
            %</h3>
        <h3>Feedback: <?php echo $feedback; ?></h3>

            


   </body>
</html>
        