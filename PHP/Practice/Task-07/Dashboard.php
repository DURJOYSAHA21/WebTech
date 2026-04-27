<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["Loggedin"] !== true)
        {
            header("Location: Registration.php");
            exit();
        }
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <h2>Welcome to the Dashboard</h2>
        <p>Hello <?php echo $_SESSION["username"]; ?></p>
        <p>You logged in at: <?php echo $_SESSION["login_time"]; ?></p>
        <button><a href="Logout.php">Logout</a></button>
        <br><br>

        <h3>Session Data:</h3>
        <pre>
            <?php
                if(!empty($_SESSION))
                {
                    print_r($_SESSION);
                }
                else
                {
                    echo "Session is empty!";
                }
            ?>
            
        </pre>
    </body>
</html>