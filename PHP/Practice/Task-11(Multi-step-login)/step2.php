<?php
    session_start();
    if(!isset($_SESSION["step1"]))
        {
            header("Location: step1.php");
            exit();
        }
    if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $_SESSION['step2']=array(
                "username"=> $_POST["username"],
                "password"=> $_POST["password"],
                "question"=> $_POST["question"],
                "answer"=> $_POST["answer"]

            );
            header("Location:step3.php");
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
                padding: 30px;
                border: 1px solid #ccc;
            }
            .form
            {
                margin-bottom:15px;
            }
            .form label
            {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;

            }
            .form input,.form select
            {
                width:100%;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 4px;
                margin-bottom: 5px;
                
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
                width: 66.66%;
            }
            .btnprev, .btnnext
            {
                background: #007bff;
                color: white;
                padding: 10px 20px;
                border-radius: 10px;
                margin: 10px 0px;
            }
            
            

        </style>
    </head>
    <body>
        <div class="container">
           <h2>Registration - Step 2 of 3</h2>
            <div class="progress">
                <div class="progressbar">

                </div>
            </div>
            <h3>Account Information</h3>
            <form method="post">
                <div class="form">
                    <label name="username">Username:</label>
                    <input type="text" name="username" required>
                    <label name="password">Password:</label>
                    <input type="password" name="password" required>
                    <label name="security">Security Answer:</label>
                    <select name="question" required>
                        <option value="">Select a question</option>
                        <option value="mother">What is your mother name?</option>
                        <option value="pet">What is your pet name?</option>
                        <option value="city">What is your birth city?</option>
                    </select>
                    <label name="answer">Security Answer: </label>
                    <input type="text" name="answer" required>
                    <a href="step1.php"><button type="button" class="btnprev"><-- Previous</button></a>
                    <button type="submit" class="btnnext"> Next Step -></button>

                </div>


            </form>
        </div>
        
    </body>
</html>