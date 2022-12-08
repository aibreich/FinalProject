<?php
/**
 *Author: Marielle Harrell
 *Date: 12/5/2022
 *File: cart.php
 *Description:
 */
class Cart extends SausageView {


    public function display($cartItems) {
        $id = $cartItems[0][0];
        $sausageName = $cartItems[0][1];
        $price = $cartItems[0][2];
        $empty = 0;
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


                    <?php

                    $total = 0;

                    //add code here to create a new row for each sausage
                    foreach($cartItems as $cartItem){
                        $total = $total + $cartItem[2];

                        echo "<div class=tableItem>";
                        echo "<div class=iteminfo>", $cartItem[1] ,"</div>";
                        echo "<div class=iteminfo2> $", $cartItem[2] , "</div>";
//                        echo "<div class=iteminfo>", $cartItem[0] , "</div>";
                        echo "<input value='1'/>";
                        echo "</div>";

                    }
                     echo "<h2> Total: $" , $total , "</h2>";

                    //To choose an array item within an array, do array[0][0]
                    //echo $cartItems;
                    //                echo $cartId;
                    ?>




            </div>
            <br/>
                <a style="text-decoration: none" href="<?= BASE_URL?>/welcome/checkout"><div class="backButton">CHECKOUT</div></a>


            <a style="text-decoration: none" href='<?= BASE_URL ?>/welcome'><div class="backButton"><- Back to Home</div></a>
        </div>
        <?php
        parent::displayFooter();
    }

}
