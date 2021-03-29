<?php

namespace Controllers;

use Models\UserModel;

class DashboardController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->handlers = [
            ''      => 'index',
            'login'  => 'login',
            'register'  => 'register',
            'logout' => 'logout'
        ];
    }

    private function _isLoggedIn()
    {
        $user_model = new UserModel();

        return (isset($_SESSION['logged_in']) && !!$user_model->exists('id', $_SESSION['user_id'])) ? true : false;
    }

    public function index()
    {
        if(!$this->_isLoggedIn()) return $this->redirect();

        $this->view->username = (new UserModel())->exists('id', $_SESSION['user_id'])->fullname;

        return $this->view->render('dashboard.php');
    }

    public function login()
    {
        $password = $_POST['password'] ?? '';
        $email = $_POST['email'] ?? '';

        $user_model = new UserModel();
        $user = $user_model->exists('email', $email);

        if(!$user) {
            $this->view->message = "User with this email does not exist";
            $this->view->status = "danger";

            return $this->view->render('home.php');
        }

        if(!password_verify($password, $user->password)){
            $this->view->message = "Wrong password";
            $this->view->status = "danger";

            return $this->view->render('home.php');
        }

        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user->id;
        
        $this->view->name = $user->fullname;
        
        $this->redirect('dashboard');
    }

    public function register()
    { 
        $valid = $this->_validateRegisterPostData();

        if(!$valid){
            $this->view->message = "Invalid details";
            $this->view->status = "danger";
            return $this->view->render('home.php');
        }

        $user_model = new UserModel();
        
        $data = [
            'fullname' => $_POST['fullname'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
        ];

        if($user_id = $user_model->create($data)){
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user_id;

            $this->redirect('dashboard');
        }

        $this->view->message = "Unable to signup";
        return $this->view->render('home.php');
    } 

    public function logout()
    {        
        $params = session_get_cookie_params();
        
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );

        session_destroy();

        $this->redirect();
    } 

    private function _validateRegisterPostData()
    {
        $user_model = new UserModel();

        $fullname = $_POST['fullname'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $has_empty_field = empty($fullname) || empty($email) || empty($password);
        return $has_empty_field || !!$user_model->exists('email', $_POST['email']) ? false : true;
    }
}