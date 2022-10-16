<?php
    // Register user, manage user view
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Model\User as User;

    class HomeController
    {
        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO;
        }

        public function Register() 
        {
            
        }

        private function RegisterView($message = "")
        {
            require_once(VIEWS_PATH."user-register.php");
        } 
    }

?>