<?php
/**
 *Author: Marielle Harrell
 *Date: 12/5/2022
 *File: cart.php
 *Description:
 */
class Cart extends SausageView {

    public function display($cartItems) {
        parent::displayHeader("this is the cart page");
        ?>
        <div class="loginContainer">
            <div class="greyBar"> Check Out</div>
            <div class="tableNames">
                <div class="tableName2">Product</div>
                <div class="tableName">Price</div>
                <div class="tableName">Quantity</div>
            </div>

            <div class="tableItems">
                <div class="tableItem">
                    <div class="iteminfo">Item name</div>
                    <div class="iteminfo"> $0.00</div>
                    <div class="iteminfo"> 1 </div>
                </div>
                <div class="tableItem">
                    <div class="iteminfo">Item name</div>
                    <div class="iteminfo"> $0.00</div>
                    <div class="iteminfo"> 1 </div>
                </div>

<!--                --><?php
//                //add code here to create a new row for each sausage
//                foreach($cartItems as $cartItem){
//                    $id = $cartItem->getId();
//                    $img = $cartItem->getImage();
//                    $name = $cartItem->getName();
//                    $price = $cartItem->getPrice();
//                    echo "<div class='productItemImage'>";
//                    echo "<img src='",BASE_URL , $img . "' alt='". $name."'>";
//                    echo "</div>";
//                    echo "<h2>", $name ,"</h2>";
//                    echo "<h4> $", $price, " </h4>";
//                    echo "<div class='productItemButtons'>";
//                    echo "<a href=",BASE_URL,"/welcome/details/$id>";
//                    echo "</div>";
//                }
//                ?>
            </div>
            <br/>
            <a style="text-decoration: none" href='<?= BASE_URL ?>/welcome'><div class="backButton" onclick="checkout()">CHECKOUT</div></a>
            <a style="text-decoration: none" href='<?= BASE_URL ?>/welcome'><div class="backButton"><- Back to Home</div></a>
        </div>
        <?php
        parent::displayFooter();
    }

}
