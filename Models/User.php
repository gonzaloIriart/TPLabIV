<?php
    namespace Models;

    class User 
    {
        private $userId;
        private $name;
        private $email;
        private $password;
        private $role;
        private $secretQuestion;
        private $answer;

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

        /**
         * Get the value of secretQuestion
         */ 
        public function getSecretQuestion()
        {
                return $this->secretQuestion;
        }

        /**
         * Set the value of secretQuestion
         *
         * @return  self
         */ 
        public function setSecretQuestion($secretQuestion)
        {
                $this->secretQuestion = $secretQuestion;

                return $this;
        }

        /**
         * Get the value of answer
         */ 
        public function getAnswer()
        {
                return $this->answer;
        }

        /**
         * Set the value of answer
         *
         * @return  self
         */ 
        public function setAnswer($answer)
        {
                $this->answer = $answer;

                return $this;
        }
    }
?>