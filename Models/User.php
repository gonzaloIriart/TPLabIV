<?php
    namespace Models;

    class User 
    {
        private $userId;
        private $name;
        private $email;
        private $password;
        private $role;

        #region getters & setters
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

        public function getRole()
        {
                return $this->role;
        }

        public function setRole($role)
        {
            $this->role = $role;
        }

        public function getName()
        {
            return $this->name;
        }
        
        public function setName($name)
        {
            $this->name = $name;                
        }
        #endregion
    }
?>