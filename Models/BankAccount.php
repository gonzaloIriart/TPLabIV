<?php
    namespace Models;

    class BankAccount{
        private $bankAccountId;
        private $alias;        
        private $cbu;
        private $bank;
        private $keeper;

        public function getBankAccountId()
        {
            return $this->bankAccountId;
        }

        public function setBankAccountId($bankAccountId)
        {
            $this->bankAccountId = $bankAccountId;
        }

        public function getAlias()
        {
            return $this->alias;
        }

        public function setAlias($alias)
        {
            $this->alias = $alias;
        }

        public function getCbu()
        {
            return $this->cbu;
        }

        public function setCbu($cbu)
        {
            $this->cbu = $cbu;
        }

        public function getBank()
        {
            return $this->bank;
        }

        public function setBank($bank)
        {
            $this->bank = $bank;
        }

        public function getKeeper()
        {
            return $this->keeper;
        }

        public function setKeeper($keeper)
        {
            $this->keeper = $keeper;
        }
    }
?>