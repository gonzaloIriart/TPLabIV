<?php
    namespace Controllers;

    use DAO\PaymentDAO as PaymentDAO;
    use DAO\ReserveDAO as ReserveDAO;
    use DAO\ImageDAO as ImageDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\Payment as Payment;
    use Models\Reserve as Reserve;

    class PaymentController
    {
      
        private $PaymentDAO;


        public function __construct()
        {
            $this->PaymentDAO = new PaymentDAO();
            $this->ReserveDAO = new ReserveDAO();
            $this->ImageDAO = new ImageDAO();
        }

        public function SetPaymentPaid($paymentId ,$reserveId)
        {
            SessionHelper::ValidateSession();
          $message = $this->ImageDAO->Add($_FILES['paymentImage']);

          var_dump($message);
            if($message !="ok" && $message !=""){
                header("Location: ".FRONT_ROOT."Owner/PendingPaidReserves");
            }

           $this->PaymentDAO->UpdateReciptPaymentById($paymentId, $_FILES['paymentImage']['name']);
           $this->ReserveDAO->UpdateReserveToReservedById($reserveId);



        } 

        public function ShowPengingPaymentOwnser($message = "")
        {
            SessionHelper::ValidateSession();
            require_once(VIEWS_PATH."pendingPaymentOwner.php");
        } 

    }
?>