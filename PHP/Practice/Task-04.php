<?php
  $cookie_name ="user";
  $cookie_value ="Durjoy Saha";
  setcookie($cookie_name, $cookie_value, time() +(10), "/");
 

?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <h2>Cookie Creation</h2>
        <?php
        if(!isset($_COOKIE[$cookie_name]))
            {
                echo "Cookie named $cookie_name is not set!";
            }
        else
            {
                echo "Cookie $cookie_name is set <br>";
                echo "Cookie value is $cookie_value ";
            }
        ?>
    </body>

</html>
