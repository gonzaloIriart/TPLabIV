<?php
    namespace Models;

    class User 
    {
        private $userId;
        private $name;
        private $email;
        private $password;
        private $roles;

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

        public function getRoles()
        {
                return $this->roles;
        }

        public function setRoles($roles)
        {
            $this->roles = $roles;
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