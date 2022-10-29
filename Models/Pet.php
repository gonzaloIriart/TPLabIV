<?php
    namespace Models;

    class Pet
    {
        private $petId;
        private $owner;
        private $name;
        private $size;
        private $video;
        private $picture;
        private $vaccinationScheduleImg;
        private $description;



        /**
         * Get the value of petId
         */ 
        public function getPetId()
        {
                return $this->petId;
        }

        /**
         * Set the value of petId
         *
         * @return  self
         */ 
        public function setPetId($petId)
        {
                $this->petId = $petId;

                return $this;
        }

        /**
         * Get the value of owner
         */ 
        public function getOwner()
        {
                return $this->owner;
        }

        /**
         * Set the value of owner
         *
         * @return  self
         */ 
        public function setOwner($owner)
        {
                $this->owner = $owner;

                return $this;
        }

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
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of size
         */ 
        public function getSize()
        {
                return $this->size;
        }

        /**
         * Set the value of size
         *
         * @return  self
         */ 
        public function setSize($size)
        {
                $this->size = $size;

                return $this;
        }



        /**
         * Get the value of video
         */ 
        public function getVideo()
        {
                return $this->video;
        }

        /**
         * Set the value of video
         *
         * @return  self
         */ 
        public function setVideo($video)
        {
                $this->video = $video;

                return $this;
        }

        /**
         * Get the value of picture
         */ 
        public function getPicture()
        {
                return $this->picture;
        }

        /**
         * Set the value of picture
         *
         * @return  self
         */ 
        public function setPicture($picture)
        {
                $this->picture = $picture;

                return $this;
        }

        /**
         * Get the value of vaccinationScheduleImg
         */ 
        public function getVaccinationScheduleImg()
        {
                return $this->vaccinationScheduleImg;
        }

        /**
         * Set the value of vaccinationScheduleImg
         *
         * @return  self
         */ 
        public function setVaccinationScheduleImg($vaccinationScheduleImg)
        {
                $this->vaccinationScheduleImg = $vaccinationScheduleImg;

                return $this;
        }

         /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDecription($description)
        {
                $this->description = $description;

                return $this;
        }

        
    }
?>