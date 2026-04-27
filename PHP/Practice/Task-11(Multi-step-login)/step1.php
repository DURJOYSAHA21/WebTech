<?php
  session_start();
  if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $_SESSION["step1"]=array(
            "First_name"=> $_POST["first_name"],
            "Last_name"=> $_POST["last_name"],
            "email"=> $_POST["email"],
            "phone"=> $_POST["phone"]

        );
        header("Location: step2.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            .container
            {
                width: 50vw;
                height: 50vh;
                border: 1px solid #ccc;
                margin:50px auto;
                padding:20px;
            }
            .formgroup label
            {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;

            }
            .formgroup input
            {
            
                width: 100%;
                padding: 8px;
                margin: 5px 0;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
            .btn
            {
                background:#007bff; 
                color: white;
                padding: 10px 20px;
                margin:10px 0px;
                cursor: pointer;
            }
            .progress
            {
                background-color: #f0f0f0;
                height: 20px;
                border-radius: 10px;
                margin-bottom: 20px;
                

            }
            .progessbar
            {
                background-color: #007bff; 
                height:100%;
                border-radius: 10px;
                width: 33.33%;

            }
         
        </style>

    </head>
    <body>
        <div class="container">
            <h2>Registration -Step 1 of 3</h2>
        
        <div class="progress">
            <div class="progessbar"></div>
        </div>
        <h3>Personanl Information</h3>
        <form method="post">
            <div class="formgroup">
                <label name="first_name">First Name:</label>
                <input type="text" name="first_name" required>
                <label name="last_name">Last Name:</label>
                <input type="text" name="last_name" required>
                <label name="email">Email: </label>
                <input type="email" name="email" required>
                <label name="phone">Phone:</label>
                <input type="tel" name="phone" required>
                <input type="submit" value="Next Step ->" class="btn">
            </div>
        </div>

        </form>
    </body>
</html>