<?php
?>

<?php
class WelcomeIndex extends SausageView {

    public function display($sausages) {

        //display page header
        parent::displayHeader("One Stop Sausage Home ");
        ?>
        <div id="searchbar" class="searchBar">
            <form method="get" action="<?= BASE_URL ?>/welcome/search">
                <input type="text" name="query-terms" id="searchtextbox" class="searchBox" placeholder="Search items..." autocomplete="off" onkeyup="handleKeyUp(event)">
                <input type="submit" class="searchButton" value="Go" />
            </form>
            <!-- div block to display auto suggestion items -->
            <div id="suggestionDiv"></div>
        </div>

          <div class="products">
<!--                <div class="productItem">-->
<!--                <div class="productItemImage">-->
<!--                    <div class="heatProduct">Heat: 1</div>-->
<!--                </div>-->
<!--                <h2> Title </h2>-->
<!--                <p> This will be the description of the sausage</p>-->
<!--                <h4> $0.00 </h4>-->
<!--                <div class="productItemButtons">-->
<!--                    <a href='--><?//= BASE_URL ?><!--/welcome/details'>-->
<!--                        <div class="productItemViewButton">View Details</div>-->
<!--                    </a>-->
<!--                    <div class="productItemCartButton">Add to Cart</div>-->
<!--                </div>-->
<!--                </div>-->

            <?php
            //add code here to create a new row for each sausage
            foreach($sausages as $sausage){
                $id = $sausage->getId();
                $img = $sausage->getImage();
                $name = $sausage->getName();
                $description = $sausage->getDescription();
                $price = $sausage->getPrice();
                $heat = $sausage->getHeat();
                echo "<div class='productItem'>";
                echo "<div class='productItemImage'>";
                echo "<img src='",BASE_URL , $img . "' alt='". $name."'>";
                echo "<div class='heatProduct'>", $heat, "</div>";
                echo "</div>";
                echo "<h2>", $name ,"</h2>";
                echo "<p>", $description, "</p>";
                echo "<h4> $", $price, " </h4>";
                echo "<div class='productItemButtons'>";
                echo "<a href=",BASE_URL,"/welcome/details/$id>";
                echo "<button class='productItemViewButton' >View Details</button>";
                echo "</a>";
                echo "<form class='productItemCartButtonF'  method='get' action='".BASE_URL."/welcome/cart?id=$id'>
                            <button class='productItemCartButton' name='id' value='$id' type='submit'>Add to Cart</button></form>";
                echo "</div>";
                echo "</div>";
            }
            ?>
            </div>

        <?php
        //display page footer
        parent::displayFooter();
    }

}
