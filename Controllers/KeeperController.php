<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\EventDAO as EventDAO;
    use DAO\PetDAO as PetDAO;
    use DAO\ReviewDAO as ReviewDAO;
    use DAO\ReserveDAO as ReserveDAO;
    use DAO\PaymentDAO as PaymentDAO;
    use DAO\BankAccountDAO as BankAccountDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\Keeper as Keeper;
    use Models\Event as Event;
    use Models\Payment;
    use Models\Review;

    class KeeperController
    {
        private $userDAO;
        private $eventDAO;
        private $keeperDAO;
        private $ownerDAO;
        private $reserveDAO;
        private $paymentDAO;
        private $petDAO;
        private $bankAccountDAO;
        private $reviewDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO;
            $this->keeperDAO = new KeeperDAO;
            $this->ownerDAO = new OwnerDAO;
            $this->eventDAO = new EventDAO;
            $this->petDAO = new PetDAO;
            $this->reserveDAO = new ReserveDAO;
            $this->bankAccountDAO = new BankAccountDAO;
            $this->paymentDAO = new PaymentDAO;
            $this->reviewDAO = new ReviewDAO;
        }

        public function AddUnavailableEvent($status, $startDate, $endDate){
            SessionHelper::ValidateSession();
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
            $this->CalendarView();
        }

        public function DeleteEvent($eventId){
            SessionHelper::ValidateSession();
            $this->eventDAO->DeleteEvent($eventId);
            $this->CalendarView();
        }

        public function DeleteReserve($reserveId){
            SessionHelper::ValidateSession();
            $this->reserveDAO->DeleteReserve($reserveId);
            $reserves = $this->reserveDAO->GetReservesByKeeperId( $_SESSION["keeper"]->getKeeperId());

            require_once(VIEWS_PATH."keeper/pendingReserves.php");
        }

        public function UpdateEventState($reserveId, $state){
            SessionHelper::ValidateSession();
            $reserve = $this->reserveDAO->GetById($reserveId);
            $this->eventDAO->UpdateEventState($reserve->getEvent()->getEventId(), $state);
            if($state == "pendingPay"){ 
                $this->CreatePayment($reserve);
            }
            $reserves = $this->reserveDAO->GetReservesByKeeperId( $_SESSION["keeper"]->getKeeperId());

            require_once(VIEWS_PATH."keeper/pendingReserves.php");
        }

        public function ShowPendingReserves(){
            SessionHelper::ValidateSession();
            $reserves = $this->reserveDAO->GetReservesByKeeperId( $_SESSION["keeper"]->getKeeperId());
            require_once(VIEWS_PATH."keeper/pendingReserves.php");
        }

        public function HomeView(){
            SessionHelper::ValidateSession();
            $this->CalendarView();
        }

        public function DeleteReserveFromCalendar($reserveId){
            SessionHelper::ValidateSession();
            $this->reserveDAO->DeleteReserve($reserveId);
            $this->CalendarView();
        }

        public function AcceptReserve($reserveId){
            SessionHelper::ValidateSession();
            $reserve = $this->reserveDAO->GetById($reserveId);
            $this->eventDAO->UpdateEventState($reserve->getEvent()->getEventId(), "pendingPay");
            $this->CreatePayment($reserve);
            $this->CalendarView();
        }

        private function formatDate($strDate){
            SessionHelper::ValidateSession();
            return date("Y-m-d", strtotime($strDate));
        }

        public function ShowAvailableKeepers ($dates = null, $petId = null)
        {
            SessionHelper::ValidateSession();
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
            SessionHelper::ValidateSession();

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
               $keeper1->setReviewsList($this->reviewDAO->GetAllByKeeperId($keeper1->getKeeperId()));
               $keeper1->setStarsAverage($this->reviewDAO->GetStarAverageByKeeperId($keeper1->getKeeperId()));
            }

            return $keepers;
        }

        public function CalendarView($message = ""){
            SessionHelper::ValidateSession();
            $keeper = $_SESSION["keeper"];
            $reserves = $this->reserveDAO->GetReservesAsJson($this->reserveDAO->GetReservesByKeeperId($keeper->getKeeperId()));
            $events = $this->eventDAO->GetEventsAsJson($this->eventDAO->GetByKeeperId($keeper->getKeeperId()), $keeper);

            require_once(VIEWS_PATH."keeper/home.php");
        }

        private function CreatePayment($reserve){     
            SessionHelper::ValidateSession();       
            $payment = new Payment();
            $payment->setOwner($this->ownerDAO->GetById($reserve->getPet()->getOwner()->getOwnerId()));
            $payment->setReserve($reserve);
            $payment->setBankAccount($this->bankAccountDAO->GetByKeeperId($_SESSION["keeper"]->getKeeperId()));
            var_dump($_SESSION["keeper"]->getKeeperId());
            $this->paymentDAO->Add($payment);
        }
    }



?>

