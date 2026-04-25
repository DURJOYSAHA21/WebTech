<?php
    $errors=[];
    $status=false;
    $id="";
    $name="";
    $email="";
    $pass="";
    $conpass="";
    $phone="";
    $department="";
    $semester="";
    $terms="";


    if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            if(empty($_POST["id"]))
                {
                    $errors["id"]="Student ID is required";
                }
            else
                {
                    $id=$_POST["id"];
                    if(!is_numeric($id))
                        {
                            $errors["id"]="Student ID must be a number";
                        }
                    else if($id<=0)
                        {
                            $errors["id"]="Student ID must be a positive number";
                        }
                    else if(strlen($id)<8)
                        {
                            $errors["id"]="Student ID must be atleast 8 digits";
                        }
                    else if(strlen($id)>8)
                        {
                            $errors["id"]="Student ID must be at most 8 digits";
                        }
                    

                }
            if(empty($_POST["name"]))
                {
                    $errors["name"]="Name is required";
                }
            else
                {
                    $name=$_POST["name"];
                    if(strlen($name)<5)
                        {
                            $errors["name"]="Name must be atleast 5 characters";
                        }
                    else if(strlen($name)>50)
                        {
                            $errors["name"]="Name must be at most 50 characters";
                        }
                    else if(!preg_match("/^[a-zA-Z ]*$/",$name))
                        {
                            $errors["name"]="Name can only contain letters and spaces";
                        }
                    
                }

            if(empty($_POST["email"]))
                {
                    $errors["email"]="Email is required";
                }
              
            else
                {
                    $email=$_POST["email"];
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                        {
                            $errors["email"]="Invalid email format";
                        }
                    else if(strlen($email)>100)
                        {
                            $errors["email"]="Email must be at most 100 characters";
                        }
                    else if(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",$email))
                        {
                            $errors["email"]="Email can only contain letters, numbers, and special characters";
                        }
                }

            if(empty($_POST["password"]))
                {
                    $errors["password"]="Password is required";
                }
            else
                {
                    $pass=$_POST["password"];
                    if(strlen($pass)<8)
                        {
                            $errors["password"]="Password must be at least 8 characters";
                        }
                    else if(strlen($pass)>20)
                        {
                            $errors["password"]="Password must be at most 20 characters";
                        }
                    else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/",$pass))
                        {
                            $errors["password"]="Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character";
                        }
                }

            if(empty($_POST["confirmpassword"]))
                {
                    $errors["confirmpassword"]="Confirm Password is required";
                }
            else
                {
                    $conpass=$_POST["confirmpassword"];
                    if($pass!==$conpass)
                        {
                            $errors["confirmpassword"]="Passwords do not match";
                        }
                    
                }

            if(empty($_POST["phone"]))
                {
                    $errors["phone"]="Phone is required";
                }
            else
                {
                    $phone=$_POST["phone"];
                    if(!is_numeric($phone))
                        {
                            $errors["phone"]="Phone must be a number";
                        }
                    else if(strlen($phone)<10)
                        {
                            $errors["phone"]="Phone must be at least 10 digits";
                        }
                    else if(strlen($phone)>15)
                        {
                            $errors["phone"]="Phone must be at most 15 digits";
                        }

                }

            if(empty($_POST["department"]))
                {
                    $errors["department"]="Department is required";
                }
            else
                {
                    $department=$_POST["department"];
                    $valid_departments=["Computer Science","Mathematics","Physics"];
                    if(!in_array($department,$valid_departments))
                        {
                            $errors["department"]="Invalid department selected";
                        }
                    
                }

            if(empty($_POST["semester"]))
                {
                    $errors["semester"]="Semester is required";
                }
            else
                {
                    $semester=$_POST["semester"];
                    if(!in_array($semester,["Fall","Spring","Summer"]))
                        {
                            $errors["semester"]="Invalid semester selected";
                        }
                    
                }

            if(empty($_POST["terms"]))
                {
                    $errors["terms"]="You must accept the terms and conditions";
                }
                else
                    {
                        $terms=$_POST["terms"];
                        if($terms!=="accepted")
                            {
                                $errors["terms"]="You must accept the terms and conditions";
                            }
                    }


            


        }

?>
<!DOCTYPE html>
<html> 
    <head>
        <title>Student Registration</title>
        <style>
            span{
                color:red;
            }
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
            


                input[type="submit"]
                {
                    padding: 10px 20px;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    cursor: pointer;
                }
        </style>
    </head>
    <body>
        <h1>Student Registration</h1>
        <div class="form">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
            <label>Student ID:</label>
            <input type="number" name="id" value="<?php echo $id; ?>">
            <?php 
                if(isset($errors["id"]))
                    {
                        echo"<span>{$errors["id"]}</span>";
                    }
            ?>
          
            <br> <br>
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $name; ?>">
            <?php 
                if(isset($errors["name"]))
                    {
                        echo"<span>{$errors["name"]}</span>";
                    }
            ?>
            <br> <br>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
            <?php 
                if(isset($errors["email"]))
                    {
                        echo"<span>{$errors["email"]}</span>";
                    }
            ?>
            <br> <br>
            <label>Password:</label>
            <input type="password" name="password">
            <?php 
                if(isset($errors["password"]))
                    {
                        echo"<span>{$errors["password"]}</span>";
                    }
            ?>
            <br> <br>
            <label>Confirm Password:</label>
            <input type="password" name="confirmpassword">
            <?php 
                if(isset($errors["confirmpassword"]))
                    {
                        echo"<span>{$errors["confirmpassword"]}</span>";
                    }
            ?>
            <br> <br>
            <label>Phone:</label>
            <input type="number" name="phone" value="<?php echo $phone; ?>">
            <?php 
                if(isset($errors["phone"]))
                    {
                        echo"<span>{$errors["phone"]}</span>";
                    }
            ?>
            <br> <br>
            <label>Department:</label>
            <select name="department" value="<?php echo $department; ?>">
                <option value="">Select Department</option>
                <option value="Computer Science" <?php if ($department == "Computer Science") echo "selected"; ?>>Computer Science</option>
                <option value="Mathematics" <?php if ($department == "Mathematics") echo "selected"; ?>>Mathematics</option>
                <option value="Physics" <?php if ($department == "Physics") echo "selected"; ?>>Physics</option>
            </select>
            <?php 
                if(isset($errors["department"]))
                    {
                        echo"<span>{$errors["department"]}</span>";
                    }
            ?>
            <br> <br>
            <label>Semester:</label>
            <input type="radio" name="semester" value="Fall" <?php if ($semester == "Fall") echo "checked"; ?>>
            <label>Fall</label>
            <input type="radio" name="semester" value="Spring" <?php if ($semester == "Spring") echo "checked"; ?>>
            <label>Spring</label>
            <input type="radio" name="semester" value="Summer" <?php if ($semester == "Summer") echo "checked"; ?>>
            <label>Summer</label>
            <?php 
                if(isset($errors["semester"]))
                    {
                        echo"<span>{$errors["semester"]}</span>";
                    }
            ?>
            <br> <br>
            <input type="checkbox" name="terms" value="accepted" <?php if ($terms == "accepted") echo "checked"; ?> >
            <label>I accept the terms and conditions</label>
            <input type="submit" value="Register">
        </form>

        </div>
        
    </body>
</html>
    