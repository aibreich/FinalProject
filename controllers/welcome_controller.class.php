<?php
/**
 * Author: Aiden Eichenour
 * date: 11/14/22
 * File: welcome_controller.class.php
 * Description: this is the user controller class which defines the 8 actions
 */
class WelcomeController {

//    static private $cartArray;
    public $item_model;
    public $id;
    public $empty;

    //default constructor
    public function __construct() {
        session_start();
        //create an instance of the MovieModel class
        $this->item_model = SausageModel::getSausageModel();
//        self::$cartArray = array();
        if(!isset($_SESSION['cartArray'])) {
            $_SESSION['cartArray'] = [];
        }

    }

    //index
    public function index() {
        $view = new WelcomeIndex();
        $model = new SausageModel();
        $sausages = $model->getSausages();
        $view->display($sausages);
    }

     //cart page
    public function cart() {
        //Query
        $id = isset($_GET["id"]) ? $_GET["id"] : null;
        $_SESSION['cartArray'][] = $this->item_model->searchID($id);
//        self::$cartArray[] = $this->item_model->searchID($id);
        //display
        $view = new Cart();
        $view->display($_SESSION['cartArray']);
    }

    //checkout
    public function checkout() {
        $_SESSION['cartArray'] = [];
        $view = new Checkout();
        $view->display();
    }
    
    //create
    public function createAccount() {
        //display
        $view = new Create();
        $view->display();
    }

    //login
    public function login(){
        //display
        $view = new Login();
        $view->display();
    }
    
    //create a user account by calling the addUser method of a userModel object
    public function register() {
        //call the addUser method of the UserModel object
        $result = $this->item_model->add_user();

        //display result
        $view = new Register();
        $view->display($result);
    }

    //verify username and password by calling the verifyUser method defined in the model.
    //It then calls the display method defined in a view class and pass true or false.
    public function verify() {
        //call the verifyUser method of the UserModel object
        $result = $this->item_model->verify_user();

        //display result
        $view = new Verify();
        $view->display($result);
    }

    //log out a user by calling the logout method defined in the model and then
    //display a confirmation message
    public function logout() {
        $this->item_model->logout();
        $view = new Logout();
        $view->display();
    }

    //details
    public function details($id){
        //retrieve details of the item
        $item = $this->item_model->view_item($id);
        if(!$item){
            //display an error message
            $message = "there was a problem displaying the movie id = $id.";
            $this->error($message);
            return;
        }
        //display
        $view = new Details();
        $view->display($item);
    }

    //search sausages
    public function search() {
        //retrieve query terms from search form

        $query_terms = isset($_GET["query-terms"]) ? trim($_GET["query-terms"]) : "" ;


        //if search term is empty, list all sausages
        if ($query_terms == " ") {
            $this->index();
        }

        //search the database for matching sausages
        $items = $this->item_model->search_items($query_terms);

        if ($items === false) {
            //handle error
            $message = "An error has occurred.";
            $this->error($message);
            return;
        }
        //display matched sausages
        $search = new Search();
        $search->display($query_terms, $items);
    }
    //autosuggestion
    public function suggest($terms) {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $items = $this->item_model->search_items($query_terms);

        //retrieve all sausage names and store them in an array
        $titles = array();
        if ($items) {
            foreach ($items as $item) {
                $titles[] = $item->getName();
            }
        }

        echo json_encode($titles);
    }


    //handle an error
    public function error($message) {
        //create an object of the error class
        $error = new SausageError();

        //display the error message
        $error->display($message);
    }
}
