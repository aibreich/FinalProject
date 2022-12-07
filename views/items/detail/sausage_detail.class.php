<?php
/**
 * Author: Aiden Eichenour
 * date: 11/15/22
 * File: sausage_detail.class.php
 * Description:
 */


class Details extends SausageView
{
    public function display($sausage){
        //Display the header
        parent::displayHeader("One Stop Sausage Details Page ");

        //retrieve item details by calling get methods
        $id = $sausage->getId();
        $sausageName = $sausage->getName();
        $description = $sausage->getDescription();
        $price = $sausage->getPrice();
        $heat = $sausage->getHeat();
        $stock = $sausage->getStock();
        $image = $sausage->getImage();

        //echo "<images src='"$image"'>";
//        echo " ID: ",$id;
//        echo " <br/> Name: ",$sausageName;
//        echo " <br/> Description: ",$description;
//        echo " <br/> Price: $",$price;
//        echo " <br/> Heat: ",$heat;
//        echo " <br/> Stock: ",$stock;

        ?>
        <div class="detailPageContainer">
            <div class="detailPageLeft">
                <div class="detailPageProductImage">
                    <?php
                    $img = $sausage->getImage();
                    echo "<img src='",BASE_URL , $img . "' alt='". $sausage->getName()."'>";
                    ?>
                </div>
            </div>
            <div class="detailPageRight">
                <?php
                //adding details
                echo "<h2 class='detailPageItemName'>", $sausageName ,"</h2>";
                echo "<h1 class='detailPageItemPrice'> $", $price , "</h1>";
                echo "<h6 class='detailPageItemHeat'> Heat Index:<span>", $heat , "</span></h6>";
                echo "<h6 class='detailPageItemStock'> Stock: <span>", $stock , "</span></h6>";
                echo "<p>", $description, "</p>";
                echo "<form method='get' action='".BASE_URL."/welcome/cart'><button class='detailPageCartButton' name='id' value='$id'>Add to Cart</button></form>";

                ?>
                <a style="text-decoration: none" href='<?= BASE_URL ?>/welcome'>
                    <div class="detailPageBackButton">Back to Main Menu</div></a>
            </div>

        </div>

        <?php
        //Display the footer
        parent::displayFooter();

    }
}
