<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\PetDAO as PetDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use Helpers\SessionHelper as SessionHelper;
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
            
            $pet = new Pet();
            $petList = $this->PetDAO->GetAll();
            if(count($petList) == 0)
            {
                $pet->setPetId(1);
            }
            else
            {
                $pet->setPetId(count($petList)+1);
            }
            $pet->setName($name);
            $pet->setOwnerId($user->getOwnerId);
            $pet->setPicture($picture);
            $pet->setVideo($video);
            $pet->setVaccinationSchedule($vaccinationSchedule);
            $this->PetDAO->Add($pet);

            require_once(VIEWS_PATH."home.php");
        }

        public function RegisterPetView($message = "")
        {
            require_once(VIEWS_PATH."owner/register-pet.php");
        } 
    }
?>