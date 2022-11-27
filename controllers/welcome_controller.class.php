<?php
/**
 * Author: Aiden Eichenour
 * date: 11/14/22
 * File: welcome_controller.class.php
 * Description: this is the user controller class which defines the 8 actions
 */
class WelcomeController {

    public $item_model;

    //default constructor
    public function __construct() {
        //create an instance of the MovieModel class
        $this->item_model = SausageModel::getSausageModel();
    }

    //index
    public function index() {
        $view = new WelcomeIndex();
        $model = new SausageModel();
        $sausages = $model->getSausages();
        $view->display($sausages);
    }

    //login
    public function login(){
        //display
        $view = new Login();
        $view->display();
    }

    //search
    public function search(){
        //display
        $view = new Search();
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


    //handle an error
    public function error($message) {
        //create an object of the error class
        $error = new SausageError();

        //display the error message
        $error->display($message);
    }
}
