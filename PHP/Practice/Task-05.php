<?php
    if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            if(isset($_POST["set_cookie"]))
                {
                    setcookie("name",$_POST["name"],time()+(86400*2),"/");
                    echo "Cookie has been set";
                }
            else if(isset($_POST["delete_cookie"]))
                {
                    setcookie("name", "", time()-3600, "/");
                    echo "Cookie has been deleted";
                }
            else if(isset($_POST["set_multiple_cookie"]))
                {
                    setcookie("name",$_POST["name"],time()+(86400*2),"/");
                    setcookie("age","25",time()+(86400*2),"/");
                    echo "Multiple cookies have been set";
                }
            
        }


?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            name: <input type="text" name="name" <br>
            <button type="submit" name="set_cookie">Set Cookie</button>
            <button type="submit" name="delete_cookie">Delete Cookie</button>
            <button type="submit" name="set_multiple_cookie">Set Multiple Cookie</button>
        </form>

    </body>
</html>

<?php
    if(!empty($_COOKIE))
        {
            foreach($_COOKIE as $key=> $value)
                {
                    echo "$key : $value <br>";
                }
        }
    else
        {
            echo "No cookies found!";
        }
?>