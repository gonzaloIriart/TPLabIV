<?php
    namespace Models;

    class Payment{
        private $paymentId;
        private $bankAccount;        
        private $owner;
        private $reserve;

        public function getPaymentId()
        {
            return $this->paymentId;
        }

        public function setPaymentId($paymentId)
        {
            $this->paymentId = $paymentId;
        }

        public function getBankAccount()
        {
            return $this->bankAccount;
        }

        public function setBankAccount($bankAccount)
        {
            $this->bankAccount = $bankAccount;
        }

        public function getOwner()
        {
            return $this->owner;
        }

        public function setOwner($owner)
        {
            $this->owner = $owner;
        }

        public function getReserve()
        {
            return $this->reserve;
        }

        public function setReserve($reserve)
        {
            $this->reserve = $reserve;
        }
    }
?>