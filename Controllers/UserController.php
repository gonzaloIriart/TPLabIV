<?php
    // Register user, manage user view
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\User as User;
    use Models\Owner as Owner;
    use Models\Keeper as Keeper;

    class UserController
    {
        private $userDAO;
        private $ownerDAO;
        private $keeperDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO;
            $this->ownerDAO = new OwnerDAO;
            $this->keeperDAO = new KeeperDAO;
        }

        public function Register($name, $email, $password, $role = 'o', $sizeOfDog = null, $dailyFee = null) 
        {
            if($this->userDAO->GetUserByEmail($email))
            {
                $this->RegisterView("El email ya se encuentra en uso.");
            }
               
            $user = new User();
            $user->setName($name);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setRole($role);
            $this->userDAO->Add($user);
            $user = $this->userDAO->GetUserByEmail($email);

            if($role == 'k'){
                $keeper = new Keeper();
                $keeper->setSizeOfDog($sizeOfDog);
                $keeper->setDailyFee($dailyFee); 
                $keeper->setUser($user);

                $this->keeperDAO->Add($keeper);
            }
            
            SessionHelper::hydrateUserSession($user);
            
            if($user->getRole() == 'o'){
                $owner=$this->ownerDAO->getOwnerByUserId($user->getUserId());
                SessionHelper::hydrateOwnerSession($owner);
                require_once(VIEWS_PATH."ownerHome.php");
            }
            else if($user->getRole() == 'k'){
                $keeper = $this->keeperDAO->getKeeperByUserId($user->getUserId());
                SessionHelper::hydrateKeeperSession($keeper);
                require_once(VIEWS_PATH."keeperHome.php");
            }else {
                require_once(VIEWS_PATH."errorPage.php");
            }
            
        }

        public function RegisterView($message = "")
        {
            require_once(VIEWS_PATH."user/register.php");
        } 
    }

?>