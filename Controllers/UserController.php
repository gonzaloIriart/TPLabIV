<?php
    // Register user, manage user view
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\EventDAO as EventDAO;
    use DAO\ReserveDAO as ReserveDAO;
    use DAO\BankAccountDAO as BankAccountDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\BankAccount; 
    use Models\User as User;
    use Models\Owner as Owner;
    use Models\Keeper as Keeper;

    class UserController
    {
        private $userDAO;
        private $OwnerDAO;
        private $keeperDAO;
        private $eventDAO;
        private $reserveDAO;
        private $bankAccountDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO;
            $this->OwnerDAO = new OwnerDAO;
            $this->keeperDAO = new KeeperDAO;
            $this->eventDAO = new EventDAO;
            $this->reserveDAO = new ReserveDAO;
            $this->bankAccountDAO = new BankAccountDAO;
        }

        public function Register($name, $email, $password, $role, $sizeOfDog = null, $dailyFee = null, $alias = null, $cbu = null, $bank = null) 
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
                $keeper = $this->keeperDAO->getKeeperByUserId($user->getUserId());

                $bankAccount = new BankAccount();
                $bankAccount->setAlias($alias);
                $bankAccount->setCbu($cbu);
                $bankAccount->setBank($bank);
                $bankAccount->setKeeper($keeper);
                $this->bankAccountDAO->Add($bankAccount);
            }
            if($role == 'o')
            {
                $owner = new Owner();
                $owner->setUser($user);
                $this->OwnerDAO->Add($owner);

            }
            
            SessionHelper::hydrateUserSession($user);
            
            if($user->getRole() == 'o'){
         
                $owner = $this->OwnerDAO->getOwnerByUserId($user->getUserId());
                $owner->setUser($user);
                SessionHelper::hydrateOwnerSession($owner);
                require_once(VIEWS_PATH."ownerHome.php");
            }
            else if($user->getRole() == 'k'){
                $keeper = $this->keeperDAO->getKeeperByUserId($user->getUserId());
                SessionHelper::hydrateKeeperSession($keeper);
                $events = $this->GetEventsAsJson();
                $reserves = $this->GetReservesAsJson();
                require_once(VIEWS_PATH."keeper/home.php");
            }else {
                require_once(VIEWS_PATH."errorPage.php");
            }
            
        }

        public function RegisterView($message = "")
        {
            require_once(VIEWS_PATH."user/register.php");
        } 

        private function GetReservesAsJson(){
            $keeper = $_SESSION["keeper"];
            $reserves = $this->reserveDAO->GetReservesAsJson($this->reserveDAO->GetReservesByKeeperId($keeper->getKeeperId()));
            return $reserves;
        }

        private function GetEventsAsJson(){
            $keeper = $_SESSION["keeper"];
            $events = $this->eventDAO->GetEventsAsJson($this->eventDAO->GetByKeeperId($keeper->getKeeperId()), $keeper);
            return $events;
        }
    }

?>