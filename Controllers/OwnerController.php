<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\PetDAO as PetDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\PaymentDAO as PaymentDAO;
    use DAO\ReserveDAO as ReserveDAO;
    use DAO\BankAccountDAO as BankAccountDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\Owner as Owner;
    use Models\Pet as Pet;
    use Models\Payment as Payment;
    use Models\BankAccount as BankAccount;
    use Models\Reserve as Reserve;

    class OwnerController
    {
        private $OwnerDAO;
        private $UserDAO;
        private $PetDAO;
        private $PaymentDAO;
        private $BankAccountDAO;
        private $ReserveDAO;

        public function __construct()
        {
            $this->UserDAO = new UserDAO();
            $this->OwnerDAO = new OwnerDAO();
            $this->PetDAO = new PetDAO();
            $this->PaymentDAO = new PaymentDAO();
            $this->BankAccountDAO = new BankAccountDAO();
            $this->ReserveDAO = new ReserveDAO();
        }

        public function PendingPaidReserves($message = "")
        {
            $payments = $this->PaymentDAO->GetPendingPayByOwnerId($_SESSION["owner"]->getOwnerId());
            var_dump($payments);
            if(empty($payments)){
                //decile que no hay nada que pagar
            }
            var_dump($payments);
            // else{
            //     foreach($payments, $paymentItem){
            //         $paymentItem->setBankAccount($this->BankAccountDAO->GetById($paymentItem->getBankAccount()));
            //         $paymentItem->setOwner($this->OwnerDAO->GetById($paymentItem->getOwner()));
            //         $paymentItem->setReserve($this->ReserveDAO->GetById($paymentItem->getReserve()));
            //     }
            // }
          

        } 

        public function RegisterPetView($message = "")
        {
            require_once(VIEWS_PATH."owner/register-pet.php");
        } 
        public function ShowHomeView($message = "")
        {
            require_once(VIEWS_PATH."ownerHome.php");
        } 
        public function HomeView($message = "")
        {
            require_once(VIEWS_PATH."ownerHome.php");
        } 
    }
?>