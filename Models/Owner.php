<?php
    namespace Models;

    class Owner{
        private $ownerId;
        private $pets;
        private $userId;
        private $user;

        /**
         * Get the value of ownerId
         */ 
        public function getOwnerId()
        {
                return $this->ownerId;
        }

        /**
         * Set the value of ownerId
         *
         * @return  self
         */ 
        public function setOwnerId($ownerId)
        {
                $this->ownerId = $ownerId;

                return $this;
        }

        /**
         * Get the value of pets
         */ 
        public function getPets()
        {
                return $this->pets;
        }

        /**
         * Set the value of pets
         *
         * @return  self
         */ 
        public function setPets($pets)
        {
                $this->pets = $pets;

                return $this;
        }

        /**
         * Get the value of userId
         */ 
        public function getUserId()
        {
                return $this->userId;
        }

        /**
         * Set the value of userId
         *
         * @return  self
         */ 
        public function setUserId($userId)
        {
                $this->userId = $userId;

                return $this;
        }

        /**
         * Get the value of user
         */ 
        public function getUser()
        {
                return $this->user;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }
    }


?>