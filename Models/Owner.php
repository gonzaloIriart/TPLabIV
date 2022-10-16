<?php
    namespace Models;

    class Owner{
        private $ownerId;
        private $pets;
        private $user;

        public function getOwnerId()
        {
            return $this->ownerId;
        }

        public function setOwnerId($ownerId)
        {
            $this->ownerId = $ownerId;
        }

        public function getPets()
        {
            return $this->pets;
        }

        public function setPets($pets)
        {
            $this->pets = $pets;
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