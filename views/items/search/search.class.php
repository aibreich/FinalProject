<?php
/**
 *Author: Marielle Harrell
 *Date: 11/22/2022
 *File: search.class.php
 *Description:
 */

class Search extends SausageView
{
    public function display($terms, $items){
        //Display the header
        parent::displayHeader("One Stop Sausage Searching Items ");

        ?>
        <div id="main-header"> Search Results for <i><?= $terms ?></i></div>
        <span class="rcd-numbers">
            <?php
            echo ((!is_array($items)) ? "( 0 - 0 )" : "( 1 - " . count($items) . " )");
            ?>
        </span>
        <hr>

        <!-- display all records in a grid -->
        <div class="products">
            <?php
            if ($items === 0) {
                echo "No item was found.<br><br><br><br><br>";
            } else {
                //display movies in a grid; six movies per row
                foreach ($items as $item) {
                    $id = $item->getId();
                    $name = $item->getName();
                    $img = $item->getImage();
                    echo "<div class='productItem'>";
                    echo "<div class='productItemImage'>";
                    echo "<img src='",BASE_URL , $img . "' alt='". $item->getName()."'>";
                    echo "<div class='heatProduct'>", $item->getHeat(), "</div>";
                    echo "</div>";
                    echo "<h2>", $item->getName() ,"</h2>";
                    echo "<p>", $item->getDescription(), "</p>";
                    echo "<h4> $", $item->getPrice(),"</h4>";
                    echo "<div class='productItemButtons'>";
                    echo "<a href=",BASE_URL,"/welcome/details/$id>";
                    echo "<button class='productItemViewButton' >View Details</button>";
                    echo "</a>";
                    echo "<button class='productItemCartButton' id='$id' onclick='addToCart(id)'>Add to Cart</button>";
                    echo "</div>";
                    echo "</div>";

                }
            }
            ?>
        </div>

        <a style="text-decoration: none" href='<?= BASE_URL ?>/welcome'>
            <div class="searchPageBackButton">Back to Main Menu</div></a>

        <?php
        //Display the footer
        parent::displayFooter();

    }
}