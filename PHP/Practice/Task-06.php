<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            if(isset($_POST["set_session"]))
                {
                    $_SESSION["username"]="Durjoy Saha";
                    $_SESSION["age"]=25;
                    echo "Session has been set";
                }
            else if(isset($_POST["delete_session"]))
                {
                    unset($_SESSION["username"]);
                   
                    echo "Session has been deleted";
                }
            else if(isset($_POST["destroy_session"]))
                {
                    session_unset();
                    session_destroy();
                    echo "Session has been destroyed";
                    header("Location: Task-06.php");
                    exit();
                }
        }
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
            <button type="submit" name="set_session">Set Session</button>
            <button type="submit" name="delete_session">Delete Session</button>
            <button type="submit" name="destroy_session">Destroy Session</button>
        </form>
    </body>
</html>

<?php
    if(isset($_SESSION["username"]))
        {
            echo "Username: " . $_SESSION["username"] . "<br>";
            echo "Age: " . $_SESSION["age"] . "<br>";
        }
    else
        {
            echo "No session data found!";
        }
    if(!empty($_SESSION))
        {
            echo "<pre> ";
            print_r($_SESSION);
            echo" </pre>";
        }
    else
        {
            echo "Session is empty!";
        }

    
?>