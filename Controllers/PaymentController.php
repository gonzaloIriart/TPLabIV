<?php
    namespace Controllers;

    use DAO\PaymentDAO as PaymentDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\Payment as Payment;

    class PaymentController
    {
      
        private $PaymentDAO;


        public function __construct()
        {
            $this->PaymentDAO = new PaymentDAO();
        }

        public function SetPaymentPaid($paymentImage, $paymentId ,$reserveId ,$message = "")
        {
          var_dump($_POST);
        //   $this->PaymentDAO->UpdateReciptPaymentById($paymentId, $paymentImage);
        //   $this->ReserveDAO->UpdateReserveToReservedById($reserveId);



        } 

    }
?>