<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\EventDAO as EventDAO;
    use DAO\PetDAO as PetDAO;
    use DAO\ReserveDAO as ReserveDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\Keeper as Keeper;
    use Models\Event as Event;

    class KeeperController
    {
        private $userDAO;
        private $keeperDAO;
        private $eventDAO;
        private $reserveDAO;
        private $petDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO;
            $this->keeperDAO = new KeeperDAO;
            $this->eventDAO = new EventDAO;
            $this->petDAO = new PetDAO;
            $this->reserveDAO = new ReserveDAO;
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
            $events = $this->GetEventsAsJson();
            $reserves = $this->GetReservesAsJson();

            require_once(VIEWS_PATH."keeper/home.php");
        }

        public function DeleteEvent($eventId){
            $this->eventDAO->DeleteEvent($eventId);
            $events = $this->GetEventsAsJson();
            $reserves = $this->GetReservesAsJson();

            require_once(VIEWS_PATH."keeper/home.php");
        }

        public function DeleteReserve($reserveId){
            $this->reserveDAO->DeleteReserve($reserveId);
            $reserves = $this->reserveDAO->GetReservesByKeeperId( $_SESSION["keeper"]->getKeeperId());

            require_once(VIEWS_PATH."keeper/pendingReserves.php");
        }

        public function UpdateEventState($reserveId, $state){
            $this->eventDAO->UpdateEventState($reserveId, $state);
            $reserves = $this->reserveDAO->GetReservesByKeeperId( $_SESSION["keeper"]->getKeeperId());

            require_once(VIEWS_PATH."keeper/pendingReserves.php");
        }

        public function ShowPendingReserves(){
            $reserves = $this->reserveDAO->GetReservesByKeeperId( $_SESSION["keeper"]->getKeeperId());
            echo($_SESSION["keeper"]->getKeeperId());
            require_once(VIEWS_PATH."keeper/pendingReserves.php");
        }

        public function HomeView(){
            $events = $this->GetEventsAsJson();
            $reserves = $this->GetReservesAsJson();

            require_once(VIEWS_PATH."keeper/home.php");
        }

        public function DeleteReserveFromCalendar($reserveId){
            $this->reserveDAO->DeleteReserve($reserveId);
            $events = $this->GetEventsAsJson();
            $reserves = $this->GetReservesAsJson();

            require_once(VIEWS_PATH."keeper/home.php");
        }

        public function AcceptReserve($reserveId){
            $this->eventDAO->UpdateEventState($reserveId, "reserved");
            $events = $this->GetEventsAsJson();
            $reserves = $this->GetReservesAsJson();

            require_once(VIEWS_PATH."keeper/home.php");
        }

        private function formatDate($strDate){
            return date("Y-m-d", strtotime($strDate));
        }

        public function ShowAvailableKeepers ($dates = null, $petId = null)
        {
            $availableKeepers = array();
            if($dates ?? false && $dogSize ?? false){
                $pet =  $this->petDAO->GetById(intval($petId));
                $dates = str_replace("/","-",explode(" - ", $dates),$i);
                $notAvailableKeepers = $this->keeperDAO->getKeeperNotAvailableByDate($dates);
                $availableKeepers = $this->GetAvailableKeepers($notAvailableKeepers,$pet->getSize() );
                $toDate = strtotime($dates["1"]);
                $fromDate = strtotime($dates["0"]);
                $dayDiff = ($toDate-$fromDate)/(60*60*24)+1;
            }

            $petList = $this->petDAO->GetListByOwner($_SESSION["owner"]->getOwnerId());
            require_once(VIEWS_PATH."filterKeeper.php");
        }
        
        private function GetAvailableKeepers($notAvailableKeepers, $dogSize){

            $keepers = $this->keeperDAO->GetAll();
            foreach($keepers as $keeper1){
                if($dogSize != $keeper1->getSizeOfDog()){
                    unset($keepers[array_search($keeper1, $keepers)]);
                }
                else{
                    foreach($notAvailableKeepers as $keeper2){
                        if(($keeper1->getKeeperId() == $keeper2->getKeeperId())){
                            unset($keepers[array_search($keeper1, $keepers)]);
                            break;
                        }
                    }
                }
               
            }

            return $keepers;
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

