<?php
    $errors=[];
    $status=false;
    $name="";
    $email="";
    $pass="";
    $conpass="";
    if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            if(empty($_POST["name"]))
                {
                    $errors["name"]="Username is required";
                }
            else
                {
                    $name=$_POST["name"];
                    if(strlen($name)<5)
                        {
                            $errors["name"]="Username must be atleast 5 characters";
                        }
                   
                    
                }

            if(empty($_POST["email"]))
                {
                    $errors["email"]="email is required";
                }
            else
                {
                    $email=$_POST["email"];
                }

            if(empty($_POST["pass"]))
                {
                    $errors["pass"]="Password is required";
                }                
            else
                {
                    $pass=$_POST["pass"];

                    if(strlen($pass)<8)
                        {
                            $errors["pass"]="Password must be contain at least 8 characters";
                        }
                }
            if(empty($_POST["conpass"]))
                {
                    $errors["conpass"]="Confirm Password is required";
                }
            else
                {
                    $conpass=$_POST["conpass"];
                    if($pass!==$conpass)
                        {
                            $errors["conpass"]="Passwords do not match";
                        }
                }

            if(empty($errors))
                {
                    $status= true;
                }
        }
?>

<!DOCTYPE html>
 <html>
    <head>
        <style>
            h1
            {
                position: relative;
                text-align: center;
            }
            .form
            {
                position:relative;
                border: 2px solid black;
                text-align:center;
                margin: 20px;
                padding: 20px;
                

            }
            span
            {
                color:red;
            }
        </style>

    </head>
    <body>
        <h1>REGISTRATION FORM</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form">
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $name; ?>">
                <?php
                    if(isset($errors["name"]))
                        {
                            echo "<span>{$errors['name']}</span>";
                        }

                ?>
                <br><br>
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $email; ?>">
                <?php
                    if(isset($errors["email"]))
                        {
                            echo "<span>{$errors['email']}</span>";
                        }
                ?>
                <br><br>
                <label>Password:</label>
                <input type="password" name="pass" >
                <?php
                    if(isset($errors["pass"]))
                        {
                            echo "<span>{$errors['pass']}</span>";
                        }
                ?>
                <br><br>
                <label>Confirm Password:</label>
                <input type="password" name="conpass">
                <?php
                    if(isset($errors["conpass"]))
                        {
                            echo "<span>{$errors['conpass']}</span>";
                        }
                ?>
                <br><br>
                <input type="submit" value="Register"><br>
                <?php
                    if($status)
                        {
                            echo "<span>The registration is succesfull</span>";
                        }
                ?>
            </div>
          


        </form>
    </body>
 </html>