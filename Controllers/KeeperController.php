<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\EventDAO as EventDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\Keeper as Keeper;
    use Models\Event as Event;

    class KeeperController
    {
        private $userDAO;
        private $keeperDAO;
        private $eventDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO;
            $this->keeperDAO = new KeeperDAO;
            $this->eventDAO = new EventDAO;
        }

        public function AddUnavailableEvent($status, $startDate, $endDate){
            $keeper = $_SESSION["keeper"];
            if(isset($_SESSION["keeper"]))
            {
                $event = new Event();
                $event->setStatus($status);
                $event->setStartDate($this->formatDate($startDate));
                $event->setEndDate($this->formatDate($endDate));
                $event->setKeeper($_SESSION["keeper"]);

                $this->eventDAO->Add($event);    
            }
            $events = $this->eventDAO->GetEventsAsJson($this->eventDAO->GetByKeeperId($keeper->getKeeperId()), $keeper);
            require_once(VIEWS_PATH."keeper/home.php");
        }

        public function GetEventsByKeeperId($keeperId){

        }

        public function DeleteEvent($eventId){

        }

        public function HomeView(){
            $keeper = $_SESSION["keeper"];
            $events = $this->eventDAO->GetEventsAsJson($this->eventDAO->GetByKeeperId($keeper->getKeeperId()), $keeper);
            require_once(VIEWS_PATH."keeper/home.php");
        }

        private function formatDate($strDate){
            return date("Y-m-d", strtotime($strDate));
        }

        public function ShowAvailableKeepers ($dates, $dogSize)
        {
            var_dump($dates);
            //$availableKeepers = aca deberiamos llamar al dao, para que llame al store que traiga los no disponibles y sacarselos a la lista que devuelva el getall
            $availableKeepers = "estos son los keeper disponibles";
            require_once(VIEWS_PATH."ownerHome.php");
            
        } 
    }

?>