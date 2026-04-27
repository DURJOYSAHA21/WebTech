<?php
    session_start();
    if(!isset($_SESSION["step1"]) || !isset($_SESSION["step2"]))
        {
            header("Location: step1.php");
            exit();
        }
    if(isset($_POST["confirm"]))
        {
            $_SESSION['registration_complete'] = true;
            $_SESSION['registration_data'] = array(
            'personal' => $_SESSION['step1'],
            'account' => $_SESSION['step2'],
            'preferences' => $_POST["news"]
            );

            header("Location: success.php");
            exit();
        }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <style>
            .container
            {
                width: 50vw;
                margin: 50px auto;
                padding:20px;
                border: 1px solid #ccc;
                
            }
            .container label
            {
                display: block;
                font-weight: bold;
                margin-bottom: 10px;
            }
            .container input, .container select
            {
                width:100%;
                padding:8px;
                border: 1px solid #ddd;
                border-radius:4px;

            }
            .progress
            {
                background-color: #f0f0f0;
                height: 20px;
                border-radius: 10px;
                margin-bottom: 20px;
            }
            .progressbar
            {
                background-color: #007bff;;
                height: 20px;
                border-radius: 10px;
                width: 100%;
            }
            .btnprev, .btnnext
            {
                background: #007bff;
                color: white;
                padding: 10px 20px;
                border-radius: 10px;
                margin: 10px 0px;
            }
            .terms
            {
                display:inline-flex;
                flex-direction: row;
                
            }
            .personal
            {
                background:  #f8f9fa;
                padding: 15px;
                border-radius: 5px;
                margin-bottom: 20px;
            }
            .account
            {
                background:  #f8f9fa;
                padding: 15px;
                border-radius: 5px;
                margin-bottom: 20px;
            }

            

        </style>


    </head>
    <body>
        <div class="container">
            <h2> Registration - Step 3 of 3</h2>
            <div class="progress">
                <div class="progressbar">
                </div>
            </div>
            <h3>Review Your Information</h3>
            <div class="review">
                <div class="personal">
                    <h4>Personal Information</h4>
                    <?php
                        $first= $_SESSION["step1"]["First_name"];
                        $last =$_SESSION["step1"]["Last_name"];
                        $email=$_SESSION["step1"]["email"];
                        $phone=$_SESSION["step1"]["phone"];
                        echo "<p><strong>Name:</strong> $first $last</p>
                              <p><strong>Email:</strong> $email </p>
                              <p><strong>Phone:</strong> $phone </p>";
                    ?>
                    
                </div>
                <div class="account">
                    <h4>Account Information</h4>
                    <?php
                        $username= $_SESSION["step2"]["username"];
                        $question =$_SESSION["step2"]["question"];

                        echo "
                              <p><strong>Username:</strong> $username </p>
                              <p><strong>Question:</strong> $question </p>";
                    ?>
                      
                </div>
                <div class="final">
                    <select name="news" required>
                        <option value="yes">Yes, subscribe me to newsletter</option>
                        <option value="no">No, Thank you</option>
                    </select>
                </div>
                <form method="post">
        <input type="checkbox" name="terms" class="terms" required>
                <label for="terms" class="terms">I agree to the Terms and Conditions</label>

                    <a href="step2.php"><button type="button" class="btnprev"><-- Previous</button></a>
                    <button type="submit" name="confirm" class="btnnext">Complete Registration</button>

                </form>

        

            </div>
        </div>
    </body>
</html>