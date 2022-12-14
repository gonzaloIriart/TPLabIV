<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\EventDAO as EventDAO;
    use DAO\ReserveDAO as ReserveDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\User as User;
    use Models\Owner as Owner;
    use Models\Keeper as Keeper;

    class HomeController
    {
        private $userDAO;
        private $OwnerDAO;
        private $keeperDAO;
        private $eventDAO;
        private $reserveDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
            $this->OwnerDAO = new OwnerDAO();
            $this->keeperDAO = new KeeperDAO();
            $this->eventDAO = new EventDAO();
            $this->reserveDAO = new ReserveDAO;
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
                    $owner->setOwnerId($this->OwnerDAO->getOwnerByUserId($user->getUserId())->getOwnerId());
                    $owner->setPets($this->OwnerDAO->getOwnerByUserId ($user->getUserId())->getPets());
                    $owner->setUser($user);
                    SessionHelper::hydrateOwnerSession($owner);
                    require_once(VIEWS_PATH."ownerHome.php");
                }
                elseif($user->getRole() == 'k')
                {
                    $keeper = $this->keeperDAO->getKeeperByUserId($user->getUserId());
                    $keeper->setUser($user);
                    SessionHelper::hydrateKeeperSession($keeper);
                    $this->CalendarView();
                }
                

            } else
                $this->Index("Usuario o password incorrectos.");

        }

        public function Logout()
        {
            session_destroy();
            require_once(VIEWS_PATH."logout.php");
        } 

        public function CalendarView($message = ""){
            $keeper = $_SESSION["keeper"];
            $reserves = $this->reserveDAO->GetReservesAsJson($this->reserveDAO->GetAllReservesByKeeperId($keeper->getKeeperId()));
            $events = $this->eventDAO->GetEventsAsJson($this->eventDAO->GetByKeeperId($keeper->getKeeperId()), $keeper);

            require_once(VIEWS_PATH."keeper/home.php");
        }
    }
?>