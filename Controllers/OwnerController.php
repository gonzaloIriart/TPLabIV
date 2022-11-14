<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\PetDAO as PetDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\PaymentDAO as PaymentDAO;
    use DAO\ReserveDAO as ReserveDAO;
    use DAO\BankAccountDAO as BankAccountDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\EventDAO as EventDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\Owner as Owner;
    use Models\Pet as Pet;
    use Models\Payment as Payment;
    use Models\BankAccount as BankAccount;
    use Models\Reserve as Reserve;
    use Keeper\Keeper as Keeper;
    use Keeper\Event as Event;

    class OwnerController
    {
        private $OwnerDAO;
        private $UserDAO;
        private $PetDAO;
        private $PaymentDAO;
        private $BankAccountDAO;
        private $ReserveDAO;
        private $KeeperDAO;
        private $EventDAO;

        public function __construct()
        {
            $this->UserDAO = new UserDAO();
            $this->OwnerDAO = new OwnerDAO();
            $this->PetDAO = new PetDAO();
            $this->PaymentDAO = new PaymentDAO();
            $this->BankAccountDAO = new BankAccountDAO();
            $this->ReserveDAO = new ReserveDAO();
            $this->KeeperDAO = new KeeperDAO();
            $this->EventDAO = new EventDAO();
        }

        public function PendingPaidReserves($message = "")
        {
            SessionHelper::ValidateSession();
            $payments = $this->PaymentDAO->GetPendingPayByOwnerId($_SESSION["owner"]->getOwnerId());


            if(empty($payments)){
                require_once(VIEWS_PATH."pendingPaymentOwner.php");
            }
            else{
                foreach($payments as $key => $paymentItem){

                    $paymentItem->setBankAccount($this->BankAccountDAO->GetById($paymentItem->getBankAccount()));
                    $paymentItem->getBankAccount()->setKeeper($this->KeeperDAO->GetById($paymentItem->getBankAccount()->getKeeper()));
                    $paymentItem->getBankAccount()->getKeeper()->setUser($this->UserDAO->GetUserById($paymentItem->getBankAccount()->getKeeper()->getUser()));
                    $paymentItem->setOwner($this->OwnerDAO->GetById($paymentItem->getOwner()));
                    $paymentItem->setReserve($this->ReserveDAO->GetById($paymentItem->getReserve()));
                    $paymentItem->getReserve()->setEvent($this->EventDAO->GetById($paymentItem->getReserve()->getEvent()->getEventId()));
                    $paymentItem->getReserve()->setPet($this->PetDAO->GetById($paymentItem->getReserve()->getPet()->getPetId()));
    
                  
                }
                require_once(VIEWS_PATH."pendingPaymentOwner.php");

            }
          

        } 
        public function WriteReviews($message = "")
        {
            SessionHelper::ValidateSession();
            $pendingReviews = $this->ReserveDAO->GetReservesPendingReview($_SESSION["owner"]->getOwnerId());
            require_once(VIEWS_PATH."WriteReviews.php");
        } 
        public function RegisterPetView($message = "")
        {
            SessionHelper::ValidateSession();
            require_once(VIEWS_PATH."owner/register-pet.php");
        } 
        public function ShowHomeView($message = "")
        {
            SessionHelper::ValidateSession();
            require_once(VIEWS_PATH."ownerHome.php");
        } 
        public function HomeView($message = "")
        {
            SessionHelper::ValidateSession();
            require_once(VIEWS_PATH."ownerHome.php");
        } 
    }
?>