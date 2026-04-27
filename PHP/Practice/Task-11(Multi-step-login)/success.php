<?php
    session_start();
    if(!isset($_SESSION['registration_complete']))
        {
            header("Location: step1.php");
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
                margin:50px auto;
                padding: 30px;
                text-align: center;
                border: 1px solid #28a745; 
                border-radius: 10px; 
                background: #d4edda; 


            }
            .userdata
            {
                 background: white;
                  padding: 20px; 
                  border-radius: 5px; 
                  margin-top: 20px; 
                  text-align: left; 
            }
            .btn
             {
                 background: #007bff; 
                 color: white; 
                 padding: 10px 20px; 
                 border: none; 
                 border-radius:4px; 
                 cursor: pointer;
                 text-decoration: none; 
                 display: inline-block; 
            }

        </style>
    </head>
    <body>
        <div class="container">
            <h1>🎉 Registration Successful!</h1>
            <p>Thank you for registering with us. Your account has been created successfully.</p>

            <div class="userdata">
               <h3>Registration Summary:</h3>
               <pre><?php print_r($_SESSION['registration_data']); ?></pre>
            </div>
        </div>
        <a href="login.php" class="btn">Login to Your Account</a>
        <?php
        // Clean up session after successful registration
        unset($_SESSION['step1']);
        unset($_SESSION['step2']);
        unset($_SESSION['registration_complete']);
        unset($_SESSION['registration_data']);
        ?>
    </body>
</html>