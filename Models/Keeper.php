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
        private $starsAverage;
        private $reviewsList;
 

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

        /**
         * Get the value of reviewsList
         */ 
        public function getReviewsList()
        {
                return $this->reviewsList;
        }

        /**
         * Set the value of reviewsList
         *
         * @return  self
         */ 
        public function setReviewsList($reviewsList)
        {
                $this->reviewsList = $reviewsList;

                return $this;
        }

        /**
         * Get the value of starsAverage
         */ 
        public function getStarsAverage()
        {
                return $this->starsAverage;
        }

        /**
         * Set the value of starsAverage
         *
         * @return  self
         */ 
        public function setStarsAverage($starsAverage)
        {
                $this->starsAverage = $starsAverage;

                return $this;
        }
    }
?>