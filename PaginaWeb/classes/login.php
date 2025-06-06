<?php
class Login
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        // create/read session, absolutely necessary
        @session_start();

        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    private function dologinWithPostData()
    {
        // check login form contents
         if (empty($_POST['user_name'])) {
            $this->errors[] = "Usuario Vacio.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Contraseña Vacio.";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escape the POST stuff
                $user_name = $this->db_connection->real_escape_string($_POST['user_name']);
                $pass = $this->db_connection->real_escape_string($_POST['user_password']);
                $ipip = $this->db_connection->real_escape_string($_POST['ipip']);

                // database query, getting all the info of the selected user (allows login via email address in the
                // username field)
                $sql = "SELECT user_id, user_name, firstname, user_email, user_password_hash, id_personal
                        FROM users
                        WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_name . "';";
                $result_of_login_check = $this->db_connection->query($sql);

                // if this user exists
                if ($result_of_login_check->num_rows == 1) {

                    // get result row (as an object)
                    $result_row = $result_of_login_check->fetch_object();
                    
                    // using PHP 5.5's password_verify() function to check if the provided password fits
                    // the hash of that user's password
                    if (password_verify($pass, $result_row->user_password_hash)) {

                        // write user data into PHP SESSION (a file on your server)
                        $_SESSION['user_id'] = $result_row->user_id;
						$_SESSION['firstname'] = $result_row->firstname;
						$_SESSION['user_name'] = $result_row->user_name;
                        $_SESSION['user_email'] = $result_row->user_email;
                        $_SESSION['id_personal'] = $result_row->id_personal;
                        $_SESSION['user_login_status'] = 1;

                        $sql2 = "INSERT INTO sess(session_ip, user_id, fecha) VALUES ('".$ipip."', '".$result_row->user_id."', '".date('Y-m-d H:i:s')."')";
                        $res = $this->db_connection->query($sql2);
                    } else {
                        $this->errors[] = "PASSWORD INCORRECTO";
                    }
                } else {
                    $this->errors[] = "USUARIO NO EXISTE";
                }
            } else {
                $this->errors[] = mysqli_connect_error();
            }
        }
    }
    /**
     * perform the logout
     */
    public function doLogout()
    {
        // delete the session of the user
        $_SESSION = array();
                                if (ini_get("session.use_cookies")) {
                                $params = session_get_cookie_params();
                                 setcookie(session_name(), '', time() - 42000,
                                $params["path"], $params["domain"],
                               $params["secure"], $params["httponly"]
                                     );  }
        session_destroy();
        // return a little feeedback message
        $this->messages[] = "HA SIDO DESCONECTADO";

    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }
}