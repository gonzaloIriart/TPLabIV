<?php
    namespace Models;

    class Reserve
    {
        private $reserveId;
        private $totalFee;
        private $advancePayment;
        private $pet;
        private $event;

        public function getReserveId()
        {
            return $this->reserveId;
        }

        public function setReserveId($reserveId)
        {
            $this->reserveId = $reserveId;
        }

        public function getTotalFee()
        {
            return $this->totalFee;
        }

        public function setTotalFee($totalFee)
        {
            $this->totalFee = $totalFee;
        }

        public function getAdvancePayment()
        {
            return $this->advancePayment;
        }

        public function setAdvancePayment($advancePayment)
        {
            $this->advancePayment = $advancePayment;
        }

        public function getPet()
        {
            return $this->pet;
        }

        public function setPet($pet)
        {
            $this->pet = $pet;
        }

        public function getEvent()
        {
            return $this->event;
        }

        public function setEvent($event)
        {
            $this->event = $event;
        }
    }
?>