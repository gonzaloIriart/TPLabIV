<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\PetDAO as PetDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\User as User;
    use Models\Owner as Owner;
    use Models\Pet as Pet;

    class OwnerController
    {
        private $OwnerDAO;
        private $UserDAO;
        private $PetDAO;

        public function __construct()
        {
            $this->UserDAO = new UserDAO();
            $this->OwnerDAO = new OwnerDAO();
            $this->PetDAO = new PetDAO();
        }

        public function RegisterPet($name, $size, $picture, $video, $vaccinationSchedule)
        {
            $user = SessionHelper::getLoginUser();

            if(!$this->UserDAO->isOwner($user)){
                $owner = new Owner();
                $owner->setOwnerId($user->getUserId());
                $owner->setUser($user);
                $user = $this->UserDAO->AddRol($user, "owner");
                $this->OwnerDAO->Add($owner);
            }
            $owner = $this->OwnerDAO->getById($user->getUserId());
            
            $pet = new Pet();
            $pet->setName($name);
            $pet->setSize($size);
            $pet->setPicture($picture);
            $pet->setVideo($video);
            $pet->setVaccinationSchedule($vaccinationSchedule);
            $pet->setOwner($owner);
        }
    }
?>