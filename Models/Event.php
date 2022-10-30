<?php 
    namespace Models;

    class Event
    {
        private $eventId;
        private $keeper;
        private $startDate;
        private $endDate;
        private $status; // disponible - reservado - pendiente - no disponible - cancelado - terminado

        public function getEventId()
        {
            return $this->eventId;
        }

        public function setEventId($eventId)
        {
            $this->eventId = $eventId;
        }

        public function getKeeper()
        {
            return $this->keeper;
        }

        public function setKeeper($keeper)
        {
            $this->keeper = $keeper;
        }

        public function getStartDate()
        {
            return $this->startDate;
        }

        public function setStartDate($startDate)
        {
            $this->startDate = $startDate;
        }

        public function getEndDate()
        {
            return $this->endDate;
        }

        public function setEndDate($endDate)
        {
            $this->endDate = $endDate;
        }

        public function getStatus()
        {
            return $this->status;
        }

        public function setStatus($status)
        {
            $this->status = $status;
        }
    }


?>