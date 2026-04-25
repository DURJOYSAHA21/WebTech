<?php
$txt1 = "Learn PHP";
$txt2 = "W3Schools.com";

// Using echo with HTML
echo "<h2>$txt1</h2>";
echo "<p>Study PHP at $txt2</p>";

// Concatenation with echo (using . dot)
echo '<h2>' . $txt1 . '</h2>';
echo '<p>Study PHP at ' . $txt2 . '</p>';


    // String	"Hello"	Text data
    // Integer	42	Whole numbers
    // Float	3.14	Decimal numbers
    // Boolean	true / false	True or False values
    // Array	[1, 2, 3]	Multiple values in one variable
    // Object	new Car()	Instance of a class
    // NULL	null	Variable with no value

$x = 5985;
var_dump($x);     // int(5985)

$y = 10.365;
var_dump($y);     // float(10.365)

$flag = true;
var_dump($flag);  // bool(true)

$name = "Luffy";
var_dump($name);  // string(5) "Luffy

// Method 1: array() function
$crew = array("Luffy", "Zoro", "Nami");

// Method 2: Short syntax (PHP 5.4+)
$fruits = ["Apple", "Banana", "Orange"];

// Access by index (starts at 0!)
echo $crew[0];   // Luffy
echo $crew[1];   // Zoro
echo $crew[2];   // Nami

// Inspect array
var_dump($crew);
var_dump($fruits);
echo "<br>";

//ASSOCIATIVE ARRAYS
$car =array(
    "brand" => "Ford",
    "model" => "Mustang",
    "year" =>1964
);

echo $car["brand"];
foreach ($car as $key => $value)
    {
        echo "$key : $value <br>";
    }
var_dump($car);

//PHP has 8 comparison operators:
// ==  Equal
// === Identical (equal and same type)
// !=  Not equal
// !== Not identical
// <   Less than
// >   Greater than
// <=  Less than or equal
// >=  Greater than or equal


$a = 20;
$b = 30;

if ($a > $b) {
    echo "a is bigger than b";
} elseif ($a == $b) {
    echo "a is equal to b";
} else {
    echo "a is smaller than b";  // This runs!
}

$favcolor = "red";

switch ($favcolor) {
    case "red":
        echo "Your favorite color is red!";
        break;   // IMPORTANT: stops fall-through!
    case "green":
        echo "Your favorite color is green!";
        break;
    case "blue":
        echo "Your favorite color is blue!";
        break;
    default:   // runs if no case matches
        echo "Color not found!";
}

$x=1;
while ($x<=5)
    {
        echo "The number is $x <br>";
        $x++;
    }
$y=1;
do
{
    echo "the numebe is $y <br>";
    $y++;

}
while($y<=5);

// Indexed array
$color = ["red", "green", "blue", "yellow"];
foreach ($color as $value) {
    echo "$value <br>";
}

// Associative array (key => value)
$age = ["Luffy"=>"19", "Zoro"=>"21", "Nami"=>"20"];
foreach ($age as $name => $years) {
    echo "$name = $years<br>";
}


function addnum(int $a, int $b)
{
    return $a+$b;
}

// echo addnum(5, 10);  
// strlen($str)	Get length of a string
// strtoupper($str)	Convert to UPPERCASE
// strtolower($str)	Convert to lowercase
// str_replace(old, new, str)	Replace text in a string
// array_push($arr, $val)	Add item to array
// count($arr)	Count array elements
// date("Y-m-d")	Get current date
// round($num)	Round a number
 
class fruit
{
    public $name;
    public $color;

    function set_name($name)
    {
        $this->name =$name;
    }
    function get_name()
    {
        return $this->name;
    }
    function set_color($color)
    {
        $this->color =$color;
    }
    function get_color()
    {
        return $this->color;
    }

}

$apple =new fruit();
$apple-> set_name("Apple");
echo $apple->get_name();
$apple->set_color("Red");
echo $apple->get_color();
echo "<br>";
var_dump($apple);

echo "<br>";

class Employee
{
    private $id;
    private $name;
    private $salary;

    public function __construct($id, $name, $salary)
    {
        $this ->id =$id;
        $this ->name =$name;
        $this ->salary =$salary;

    }

    public function getid()
    {
        return $this->id;
    }
    public function setname($name)
    {
        $this->name =$name;
    }
    public function getname()
    {
        return $this->name;
    }
    public function setsalary($salary)
    {
        $this->salary =$salary;
    }
    public function getsalary()
    {
        return $this->salary;
    }

    public function display()
    {
        echo "ID: $this->id <br>";
        echo "Name: $this->name <br>";
        echo "Salary: $this->salary <br>";
    }
}

$emp1 =new Employee(1, "Luffy", 5000);
$emp1->display();
$emp1->setname("Chopper");
$emp1->display();
?>