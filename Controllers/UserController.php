<?php
    // Register user, manage user view
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\User as User;

    class UserController
    {
        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO;
        }

        public function Register($name, $email, $password) 
        {
            if($this->userDAO->GetUserByEmail($email))
            {
                $this->RegisterView("El email ya se encuentra en uso.");
            }
               
            $user = new User();
            $user->setName($name);
            $user->setEmail($email);
            $user->setPassword($password);
            $this->userDAO->Add($user);
            
            $user = $this->userDAO->GetUserByEmail($email);
            SessionHelper::hydrateUserSession($user);
            require_once(VIEWS_PATH."ownerHome.php");
            
        }

        public function RegisterView($message = "")
        {
            require_once(VIEWS_PATH."user/register.php");
        } 
    }

?>