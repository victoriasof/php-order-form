<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

whatIsHappening();

//your products with their price.
$food = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$drinks = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];

$products = $food;
//if (isset($_GET['drinks'])) {
    //$products = $drinks;
//}


if($_GET['food']==1){
    $products = $food;
}
else if($_GET['food']==0){
    $products = $drinks;
}


$totalValue = 0;

//Make sure that the street, streetnumber, city and zipcode is a required field.


$emailErr = "";
$streetErr = "";
$streetnumberErr = "";
$cityErr = "";
$zipcodeErr = "";

$orderSent = "";

$email = "";
$street = "";
$streetnumber = "";
$city = "";
$zipcode = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["email"])){
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        }
        else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";

            }
            $_SESSION["email"] = $email;
        }
    }


    if(isset($_POST["street"])){
        if (empty($_POST["street"])) {
            $streetErr = "Street is required";
        } else {
            $street = test_input($_POST["street"]);
        }
        $_SESSION["street"] = $street;
    }

    if(isset($_POST["streetnumber"])){

        if (empty($_POST["streetnumber"])) {
            $streetnumberErr = "Street number is required";
        }
        else {
            $streetnumber = test_input($_POST["streetnumber"]);
        }

        if(!is_numeric($_POST["streetnumber"])) {
            $streetnumberErr = "Please enter number";
        }

        $_SESSION["streetnumber"] = $streetnumber;
    }


    if(isset($_POST["city"])){

        if (empty($_POST["city"])) {
            $cityErr = "City is required";
        } else {
            $city = test_input($_POST["city"]);
        }

        $_SESSION["city"] = $city;
    }


    if(isset($_POST["zipcode"])){

        if (empty($_POST["zipcode"])) {
            $zipcodeErr = "Zipcode is required";
        } else {
            $zipcode = test_input($_POST["zipcode"]);
        }

        if(!is_numeric($_POST["zipcode"])) {
            $zipcodeErr = "Please enter number";
        }

        $_SESSION["zipcode"] = $zipcode;
    }


}



else {
    $orderSent="your order has been sent";



}


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


//Calculate the delivery time

$delyTime = 0;
$now = new DateTime();

if(isset($_POST['express_delivery'])){
    $now->add(new DateInterval('PT45M'));
}
else{
    $now->add(new DateInterval('PT2H'));
}
$delyTime = $now->format('H:i d-m-Y');

require 'form-view.php';


// Total revenue counter

$orderValue = 0;
if (isset($_POST['products'])){
    foreach($_POST['products'] as $i => $product){
        $orderValue += $product;
    }
}
var_dump($orderValue);

if (!empty($_POST['express_delivery'])){
    $orderValue += $_POST['express_delivery'];
}


if (isset($_COOKIE['orders'])){

    $totalValue = $_COOKIE['orders'];
}
else {

    $totalValue = "0";
    $cookie_name = 'orders';
    $cookie_value = $totalValue;
    setcookie($cookie_name, $cookie_value);

}

//$_SESSION["streetnumber"] = $streetnumber;