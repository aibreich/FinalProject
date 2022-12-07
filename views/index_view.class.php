<?php
/**
 * Author: Aiden Eichenour
 * date: 11/14/22
 * File: index_view.class.php
 * Description:
 */

class SausageView {

    //this method displays the page header
    static public function displayHeader($page_title) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title> <?php echo $page_title ?> </title>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
            <link rel='shortcut icon' href='<?= BASE_URL ?>/www/img/favicon.ico' type='image/x-icon' />
            <link type='text/css' rel='stylesheet' href='<?= BASE_URL ?>/www/css/app_style.css' />
            <link href="../www/css/app_style.css" />
            <script>
                //create the JavaScript variable for the base url
                var base_url = "<?= BASE_URL ?>";

            </script>
        </head>
        <body>
        <div id="top"></div>
        <div id="wrapper">
        <div id="banner" class="projheader">
            <div id="left">
                    <span style='color: #000; font-size: 36pt; font-weight: bold; vertical-align: top'>
                                    One Stop Sausage
                                </span>
                <div style='color: #000; font-size: 14pt; font-weight: bold'>Check out our list of Sausages</div>
            </div>
            <div id="right">
                <a href='<?= BASE_URL ?>/welcome/login'><button class="loginInButton"> Login In</button></a>
                <a href='<?= BASE_URL ?>/welcome/cart'><button class="loginInButton"> Cart</button></a>

            </div>
            <div href="<?= BASE_URL ?>/index.php" style="text-decoration: none" title="One Stop Sausage">

            </div>

        </div>
        <?php
    }//end of displayHeader function

    //this method displays the page footer
    public static function displayFooter() {
        ?>
        <br><br><br>
        <div id="push"></div>
        </div>
        <div id="footer" class="foot"><br>&copy 2022 One Stop Sausage. All Rights Reserved.</div>
        <script type="text/javascript" src="<?= BASE_URL ?>/www/js/ajax_autosuggestion.js"></script>
        <script type="text/javascript" src="<?= BASE_URL ?>/www/js/cart.js"></script>
        </body>
        </html>
        <?php
    } //end of displayFooter function
}
?>

