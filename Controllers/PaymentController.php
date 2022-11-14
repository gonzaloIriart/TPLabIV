<?php
    namespace Controllers;

    use DAO\PaymentDAO as PaymentDAO;
    use DAO\ImageDAO as ImageDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\Payment as Payment;

    class PaymentController
    {
      
        private $PaymentDAO;


        public function __construct()
        {
            $this->PaymentDAO = new PaymentDAO();
            $this->ImageDAO = new ImageDAO();
        }

        public function SetPaymentPaid($paymentImage, $paymentId ,$reserveId)
        {

          $message = $this->ImageDAO->Add($_FILES['paymentImage']);

          var_dump($message);
            if($message !="ok" && $message !=""){
                header("Location: ".FRONT_ROOT."Owner/PendingPaidReserves");
            }

        //   $this->PaymentDAO->UpdateReciptPaymentById($paymentId, $paymentImage);
        //   $this->ReserveDAO->UpdateReserveToReservedById($reserveId);



        } 

        public function ShowPengingPaymentOwnser($message = "")
        {
            require_once(VIEWS_PATH."pendingPaymentOwner.php");
        } 

    }
?>