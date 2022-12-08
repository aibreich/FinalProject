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
                    <?php

                    //add code here to create a new row for each sausage
                    foreach($cartItems as $cartItem){



                        echo "<div class=`iteminfo`>", $cartItem[1] ,"</div>";
                        echo "<div class=`iteminfo`> $", $cartItem[2] , "</div>";
                                    echo "<div class=`iteminfo`> ", $cartItem[0] , "</div>";


                    }
                    //To choose an array item within an array, do array[0][0]
                    //echo $cartItems;
                    //                echo $cartId;
                    ?>
                </div>



            </div>
            <br/>
            <a style="text-decoration: none" href='<?= BASE_URL ?>/welcome'><div class="backButton" onclick="checkout()">CHECKOUT</div></a>
            <a style="text-decoration: none" href='<?= BASE_URL ?>/welcome'><div class="backButton"><- Back to Home</div></a>
        </div>
        <?php
        parent::displayFooter();
    }

}
