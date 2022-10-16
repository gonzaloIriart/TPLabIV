<?php
    namespace Models;

    class User 
    {
        private $userId;
        private $name;
        private $email;
        private $password;
        private $keeperId;
        private $ownerId;

        public function getUserId()
        {
            return $this->userId;
        }

        public function setUserId($userId)
        {
            $this->userId = $userId;
        }
        
        public function getEmail()
        {
            return $this->email;
        }
        
        public function setEmail($email)
        {
            $this->email = $email;
        }
        public function getPassword()
        {
            return $this->password;
        }
        
        public function setPassword($password)
        {
            $this->password = $password;

        }

        public function getKeeperId()
        {
                return $this->keeperId;
        }

        public function setKeeperId($keeperId)
        {
                $this->keeperId = $keeperId;
        }

        public function getOwnerId()
        {
                return $this->ownerId;
        }

        public function setOwnerId($ownerId)
        {
                $this->ownerId = $ownerId;
        }
    }
?>