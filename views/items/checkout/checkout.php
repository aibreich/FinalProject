<?php
/**
 * Author: Aiden Eichenour
 * date: 12/8/22
 * File: checkout.php
 * Description:
 */

class Checkout extends SausageView{
    public function display(){
        parent::displayHeader("You've checked out.");

        echo "<h1>Thank you for shopping with us!</h1>";
        echo "<a style='text-decoration: none' href='" . BASE_URL ."/welcome'><div class=backButton><- Back to Home</div></a>";

        parent::displayFooter();
    }
}