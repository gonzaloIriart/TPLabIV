<?php
    namespace Models;

    class Pet
    {
        private $petId;
        private $owner;
        private $reserve;
        private $name;
        private $size;
        private $video;
        private $picture;
        private $vaccinationSchedule;

        public function getPetId()
        {
            return $this->petId;
        }

        public function setPetId($petId)
        {
            $this->petId = $petId;
        }

        public function getOwner()
        {
            return $this->owner;
        }

        public function setOwner($owner)
        {
            $this->owner = $owner;
        }

        public function getReserve()
        {
            return $this->reserve;
        }

        public function setReserve($reserve)
        {
            $this->reserve = $reserve;
        }

        public function getName()
        {
            return $this->name;
        }

        public function setName($name)
        {
            $this->name = $name;
        }

        public function getSize()
        {
            return $this->size;
        }

        public function setSize($size)
        {
            $this->size = $size;
        }

        public function getVideo()
        {
            return $this->video;
        }

        public function setVideo($video)
        {
            $this->video = $video;
        }

        public function getPicture()
        {
            return $this->picture;
        }

        public function setPicture($picture)
        {
            $this->picture = $picture;
        }

        public function getVaccinationSchedule()
        {
            return $this->vaccinationSchedule;
        }

        public function setVaccinationSchedule($vaccinationSchedule)
        {
            $this->vaccinationSchedule = $vaccinationSchedule;
        }
    }
?>