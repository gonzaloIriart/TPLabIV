<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\User as User;
    use Models\Owner as Owner;

    class HomeController
    {
        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO;
            $this->ownerDAO = new OwnerDAO;
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."index.php");
        } 
        
        public function Home($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        } 

        public function Login($email, $password)
        {
            $user = $this->userDAO->GetUserByEmail($email);

            if(($user != null) && ($user->getPassword() == $password))
            {
                SessionHelper::hydrateUserSession($user);

                if($user->getRole() == 'o')
                {
                    $owner = new Owner();
                    $owner->setOwnerId($this->ownerDAO->getOwnerByUserId ($user->getUserId())->getOwnerId());
                    $owner->setPets($this->ownerDAO->getOwnerByUserId ($user->getUserId())->getPets());
                    $owner->setUser($user);
                    SessionHelper::hydrateOwnerSession($owner);
                    require_once(VIEWS_PATH."ownerHome.php");
                }
                else
                {
                    require_once(VIEWS_PATH."ownerHome.php");
                }
                

            } else
                $this->Index("Usuario o password incorrectos.");

        }

        public function Logout()
        {
            require_once(VIEWS_PATH."logout.php");
        } 
        
    
    }
?>