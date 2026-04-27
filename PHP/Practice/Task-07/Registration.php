<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            if(isset($_POST["Login"]))
            {
                if(isset($_POST["username"]) && isset($_POST["password"]))
                {
                    $username =$_POST["username"];
                    $password= $_POST["password"];
                    if($username=="admin" && $password=="password123")
                    {
                        $_SESSION["username"]=$username;
                        $_SESSION["loggedin"]=true;
                        $_SESSION["login_time"]=date("Y-m-d H:i:s");
                        header("Location: dashboard.php");
                        exit();
                    }
                    else
                    {
                        echo "Invalid username or password!";
                    }

                }
            }
        }
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <form method="post">
            <label for="username">USERNAME:</label>
            <input type="text" name="username" required> <br>
            <label for="password"> PASSWORD:</label>
            <input type="password" name="password" required><br>
            <button type="submit" name="login" value="Login">Login</button>
        </form>

    </body>
</html>