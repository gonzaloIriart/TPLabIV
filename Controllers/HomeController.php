<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Model\User as User;

    class HomeController
    {
        private $userDAO;
        private $sessionHelper;

        public function __construct()
        {
            $this->userDAO = new UserDAO;
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."index.php");
        } 
        
        public function Home($message = "")
        {
        } 

        public function Login($email, $password)
        {
            $user = $this->userDAO->GetUserByEmail($email);

            if(($user != null) && ($user->getPassword() == $password))
            {
                SessionHelper::hydrateUserSession($user);

                require_once(VIEWS_PATH."home.php");
            } else
                $this->Index("Usuario o password incorrectos.");

        }

        public function Logout()
        {
            require_once(VIEWS_PATH."logout.php");
        } 
        
        public function List($message = "")
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."beer-list.php");
        }  
    }
?>