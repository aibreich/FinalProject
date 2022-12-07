<?php
/**
 * Author: Aiden Eichenour
 * date: 11/14/22
 * File: sausage.class.php
 * Description:
 */
class SausageModel
{
    //private attributes
    private $db; //database object
    private $dbConnection; //database connection
    static private $_instance = NULL;
    private $tblSausage;
    private $tblUser;

    //making the constructor
    public function  __construct()
    {
        $this->db = Database::getInstance();
        $this->dbConnection = $this->db->getConnection();
        $this->tblSausage = $this->db->getSausageTable();
        $this->tblUser = $this->db->getUserTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    /*
  * this method retrieves all toys from the database and
  * returns an array of Toy objects if successful or false if failed.
  */
    public function getSausages() {
        //SQL select statement
        $sql = "SELECT * FROM " . $this->db->getSausageTable();

        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            //array to store all sausage items
            $sausages = array();

            //loop through all rows
            while ($query_row = $query->fetch_assoc()) {
                $sausage = new Sausage(
                    $query_row["sausage_id"],
                    $query_row["sausage_name"],
                    $query_row["price"],
                    $query_row["stock_quantity"],
                    $query_row["sausage_description"],
                    $query_row["sausage_heat"],
                    $query_row["image_filepath"]
                );

                //push the sausages into the array
                $sausages[] = $sausage;
            }
            //return all the sausages
            return $sausages;
        }
        //else return false
        return false;
    }

    //static method to ensure there is just one SausageManager instance
    public static function getSausageModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new SausageModel();
        }
        return self::$_instance;
    }

    //getting the item details for the details page. getting the data from database
    public function view_item($id) {
        //the select ssql statement--getting table
        $sql = "SELECT * FROM " . $this->db->getSausageTable() . " WHERE sausage_id = $id";

        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();

            //create an item object --building from constructor on sausage.class.php
            $item = new Sausage($obj->sausage_id, $obj->sausage_name, $obj->price, $obj->stock_quantity, $obj->sausage_description, $obj->sausage_heat, $obj->image_filepath);

            //set the id for the item
            $item->setId($id);

            //returning the data of that item
            return $item;
        }

        //else return false
        return false;
    }
    
    //Search the database for the item to add to the cart
    public function searchID($id){
        //Select statement for the search
        $sql = "SELECT sausage_id, sausage_name, price FROM " . $this->tblSausage . " WHERE ".$this->tblSausage.".sausage_id =" . $id;

        //Execute the query
        $query = $this->dbConnection->query($sql);

        //Return false if the search failed
        if(!query){
            return false;
        }

        //If the search succeeded but no items were found
        if ($query->num_rows == 0){
            return 0;
        }

        //If the search succeeded
        if ($query->num_rows > 0){
            $obj = $query->fetch_object();
            $item = [$obj->sausage_id, $obj->sausage_name, $obj->price];
            return $item;
        }
    }

    //search the database for items that match words in titles. Return an array of movies if succeed; false otherwise.
    public function search_items($terms) {
        $terms = explode(" ", $terms); //explode multiple terms into an array
        //select statement for AND search
        $sql = "SELECT * FROM " . $this->tblSausage . " WHERE 1";

        foreach ($terms as $term) {
            $sql .= " AND " . $this->tblSausage.".sausage_name LIKE '%" . $term . "%'";
        }

        //execute the query
        $query = $this->dbConnection->query($sql);

        // the search failed, return false.
        if (!$query) {
            return false;
        }
        //search succeeded, but no movie was found.
        if ($query->num_rows == 0) {
            return 0;
        }
        //search succeeded, and found at least 1 movie found.
        //create an array to store all the returned movies
        $items = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            //create an item object --building from constructor on sausage.class.php
            $item = new Sausage($obj->sausage_id, $obj->sausage_name, $obj->price, $obj->stock_quantity, $obj->sausage_description, $obj->sausage_heat, $obj->image_filepath);

            //set the id for the movie
            $item->setId($obj->sausage_id);

            //add the movie into the array
            $items[] = $item;
        }
        return $items;
    }
    //add a user into the "users" table in the database
    public function add_user() {
        //retrieve user inputs from the registration form
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
        $lastname = filter_input(INPUT_POST, "lname", FILTER_SANITIZE_STRING);
        $firstname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_EMAIL);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_EMAIL);
        $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_EMAIL);
        $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_EMAIL);
        $zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_EMAIL);
        $card_number = filter_input(INPUT_POST, 'card_number', FILTER_SANITIZE_EMAIL);
        $card_cvc = filter_input(INPUT_POST, 'card_cvc', FILTER_SANITIZE_EMAIL);




        try {
            //Handle data missing exceptions. All fields are required.
            if (empty($username) || empty($password) || empty($lastname) || empty($firstname) || empty($email)) {
                throw new DataMissingException("Values were missing in one or more fields. All fields must be filled.");
            }

            //Handle data length exceptions. The min length of a password is 5.
            if (strlen($password) < 5) {
                throw new DataLengthException("Your password was invalid. The mininum length of a password is 5.");
            }

            //Handle email format exceptions.
            if (!Utilities::checkemail($email)) {
                throw new EmailFormatException("Your email format was invalid. The general format of an email address is user@example.com.");
            }
            //hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            //construct an INSERT query
            $sql = "INSERT INTO " . $this->db->getUserTable() . " VALUES(NULL, '0', '$firstname $lastname', '$username', '$hashed_password', '$address', '$city', '$state', '$country', '$zipcode', '$card_number', '$card_cvc')";

            //Execute the query. Throw a database exceptions if the query failed.
            if ($this->dbConnection->query($sql) === FALSE) {
                throw new DatabaseException("We are sorry, but we can't create your account at this moment. Please try again later.");
            }

            return "Your account has been successfully created.";
        } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (DataLengthException $e) {
            return $e->getMessage();
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (EmailFormatException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    //verify username and password against a database record
    public function verify_user() {
        //retrieve username and password
        $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

        try {
            //Handle data missing exception. All fields are required.
            if (empty($username) || empty($password)) {
                throw new DataMissingException("Values were missing in one or more fields. All fields must be filled.");
            }

            //sql statement to filter the users table data with a username
            $sql = "SELECT user_password FROM " . $this->db->getUserTable() . " WHERE user_username='$username'";

            //execute the query
            $query = $this->dbConnection->query($sql);

            if (!$query) {
                throw new DatabaseException("We are sorry, but we cannot create your account at this moment. Please try again later.");
            }
            //verify password; if password is valid, set a temporary cookie
            if ($query->num_rows > 0) {
                $result_row = $query->fetch_assoc();
                $hash = $result_row['user_password'];
                if (password_verify($password, $hash)) {
                    setcookie("user", $username);
                    return "You have successfully logged in.";
                } else {
                    throw new DatabaseException("Your username and/or password were invalid. Please try again.");
                }
            } else {
                throw new DatabaseException("Your username and/or password were invalid. Please try again.");
            }
        } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    //logout user: destroy session data
    public function logout() {
        //destroy session data
        setcookie("user", '', -10);
        return true;
    }
}
