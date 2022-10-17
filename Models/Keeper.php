<?php 
    namespace Models;

    class Keeper 
    {
        private $keeperId;
        private $sizeOfDog;
        private $reviews;
        private $dailyFee;
        private $reserves;
        private $availableDays;
        private $user;

        public function getKeeperId()
        {
            return $this->keeperId;
        }

        public function setKeeperId($keeperId)
        {
            $this->keeperId = $keeperId;
        }

        public function getSizeOfDog()
        {
            return $this->sizeOfDog;
        }

        public function setSizeOfDog($sizeOfDog)
        {
            $this->sizeOfDog = $sizeOfDog;
        }

        public function getReviews()
        {
            return $this->reviews;
        }
        
        public function setReviews($reviews)
        {
            $this->reviews = $reviews;

        }

        public function getDailyFee()
        {
            return $this->dailyFee;
        }

        public function setDailyFee($dailyFee)
        {
            $this->dailyFee = $dailyFee;

        }

        public function getReserves()
        {
            return $this->reserves;
        }

        public function setReserves($reserves)
        {
            $this->reserves = $reserves;

        }

        public function getAvailableDays()
        {
            return $this->availableDays;
        }

        public function setAvailableDays($availableDays)
        {
            $this->availableDays = $availableDays;
        }

        public function getUser()
        {
            return $this->user;
        }

        public function setUser($user)
        {
            $this->user = $user;
        }
    }
?>