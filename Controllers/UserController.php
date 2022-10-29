<?php
    // Register user, manage user view
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\OwnerDAOsql as OwnerDAOsql;
    use DAO\KeeperDAO as KeeperDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\User as User;
    use Models\Owner as Owner;
    use Models\Keeper as Keeper;

    class UserController
    {
        private $userDAO;
        private $OwnerDAOsql;
        private $keeperDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO;
            $this->OwnerDAOsql = new OwnerDAOsql;
            $this->keeperDAO = new KeeperDAO;
        }

        public function Register($name, $email, $password, $role, $sizeOfDog = null, $dailyFee = null) 
        {
            if (!($role == 'o' || $role == 'k'))
            {
                $role = 'o';
            }

            if($this->userDAO->GetUserByEmail($email)->getUserId() != null)
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
            if($role == 'o')
            {
                $owner = new Owner();
                $owner->setUser($user);
                $this->OwnerDAOsql->Add($owner);

            }
            
            SessionHelper::hydrateUserSession($user);
            
            if($user->getRole() == 'o'){
         
                $owner = $this->OwnerDAOsql->getOwnerByUserId($user->getUserId());
                $owner->setUser($user);
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