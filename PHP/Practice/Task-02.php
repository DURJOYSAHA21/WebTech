<html>
    <head>

    </head>
    <body>
        <h1>My PHP Page</h1>
        <form action="Task-02.php" method="post">
            Name: <input type="text" name="name"><br>
            Email: <input type="email" name="email"><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>

<?php

   echo "Welcome $_POST[name] <br>";
   echo "Your email is ".  $_POST["email"] . "<br>";

?>
