<?php
include_once("db_config.php");
$sql = "SELECT * FROM products;";
$res = mysqli_query($connect, $sql);
$rescheck = mysqli_num_rows($res);



include "header.php";
?>
<section class="main-cover main-cover-cart">
        <div class="page-wrapper">
            <div class="block-title block-title--white">Cart</div>
        </div>
</section>

<section class="cart block">
    <div class="page-wrapper">
        <div class="cart__container">
            <form action="buy.php" method="POST">
                <?php
                //Itt töltjük ki a hiányzó adatokat a rendelés befejezéséhez(lakcím, email cím stb.)
                if (isset($_GET['id'])) {
                    $sid=$_GET['id'];
                $sql= "SELECT * FROM products WHERE id='$sid';";
                $result=mysqli_query($connect,$sql);
                $queryres = mysqli_num_rows($result);
                    if($queryres > 0){
                        //Az itt bevitt adatokat továbbítjuk a buy.php-nak, ahol ellenőrízni fogja, hogy minden "rendben" van-e
                        while($row=mysqli_fetch_assoc($result)){
                            echo"<div id=\"mand\">*These fields are required!</div>";
                            echo "
                                <label>Foodname:</label><input readonly name=\"foodname\" type=\"text\" value=\"".$row['name']."\">
                                <label>E-mail:*</label><input id=\"email\" name=\"email\" type=\"text\">
                                <label>Name:*</label><input id=\"name\" name=\"name\" type=\"text\">
                                <label>Address:*</label><input id=\"address\" name=\"address\" type=\"text\">
                                <label>City, country:*</label><input id=\"place\" name=\"place\" type=\"text\">
                                <label>Price:</label><input readonly name=\"price\" type=\"text\" value=\"".$row['price']."\">
                                <button type=\"submit\" class=\"cart__button\">BUY</button>
                            ";
                        }
                    }
                }
                ?>
            </form>
            <?php
            if (isset($_GET['id'])) {
                $sid=$_GET['id'];
            $sql= "SELECT * FROM products WHERE id='$sid';";
            $result=mysqli_query($connect,$sql);
            $queryres = mysqli_num_rows($result);
                if($queryres > 0){
                    while($row=mysqli_fetch_assoc($result)){
                        echo "<img src=\"".$row['photo']."\" class=\"cart__picture\">";
                    }
                }
            }
            ?>
        </div>
        
    </div>
</section>
<script type="text/javascript" src="js/cart.js"></script>
<?php include "footer.php"?>