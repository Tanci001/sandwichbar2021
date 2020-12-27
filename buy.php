<?php
include_once("db_config.php");

//Az átküldött értékeket változókba olvassuk
$category = $_POST['category'];
$foodname = $_POST['foodname'];
$email = $_POST['email'];
$name = $_POST['name'];
$address = $_POST['address'];
$place = $_POST['place'];
$price = $_POST['price'];

//Megnézzük, hogy minden mező kivan-e töltve, amennyiben nincs, hibát jelez
if(empty($category) || empty($foodname) || empty($email) || empty($name) || empty($address) || empty($place) || empty($price)){
    echo 'Error! You must fill all fields!';

    $url = $_SERVER['HTTP_REFERER']; //Az előző oldalra dob vissza minket(back-1)
    echo '<meta http-equiv="refresh" content="3;URL=' . $url . '">';
    
} else {
    $SELECT = "SELECT name From orders";

    $INSERT = "INSERT Into orders (category, foodname, email, name, address, place, price) values(?, ?, ?, ?, ?, ?, ?)";

    $stmt = $connect->prepare($SELECT);

    //Feltöltjük az orders táblázatot a kapott adatokkal
    $rnum = $stmt->num_rows;
    if ($rnum==0) {
        $stmt->close();
        $stmt = $connect->prepare($INSERT);
        $stmt->bind_param("sssssss", $category, $foodname, $email, $name, $address, $place, $price);
        $stmt->execute();
        echo "Successful order!";
        header("refresh:3;url=index.php");
        exit();
    }

    $stmt->close();
    $connect->close();
}
?>