<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <h1>My PHP Page</h1>
        <form method="post" action="<?php echo htmlspecialchars ($_SERVER["PHP_SELF"]); ?>">
            Name: <input type="text" name="name"><br>
            <input type="submit" value="Submit">
        </form>
       

    </body>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"] =="POST")
    {
        $name=$_POST["name"];
        echo "Welcome $name!";
    }
?>