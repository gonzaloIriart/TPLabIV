<?php 
    namespace Models;

    class UserRol
    {
        private $userRolId;
        private $user;
        private $rol; // owner, keeper

        public function getUserRolId()
        {
            return $this->userRolId;
        }
        public function setUserRolId($userRolId)
        {
            $this->userRolId = $userRolId;
        }

        public function getUser()
        {
            return $this->user;
        }
        
        public function setUser($user)
        {
            $this->user = $user;
        }
        
        public function getRol()
        {
            return $this->rol;
        }
        
        public function setRol($rol)
        {
            $this->rol = $rol;
        }
    }
?>