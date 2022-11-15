<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\PetDAO as PetDAO;
    use DAO\PetDAOjson as PetDAOjson;
    use DAO\ImageDAO as ImageDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Helpers\JsonHelper as JsonHelper;
    use Models\User as User;
    use Models\Owner as Owner;
    use Models\Pet as Pet;

    class PetController
    {

        public function __construct()
        {
            $this->userDAO = new UserDAO;
            $this->OwnerDAO = new OwnerDAO;
            $this->PetDAO = new PetDAO();
            //$this->PetDAO = new PetDAOjson();
            $this->ImageDAO = new ImageDAO();
        }

        public function RegisterPet($name, $size, $video, $description)
        {
            SessionHelper::ValidateSession();
            $message = $this->ImageDAO->Add($_FILES['picture']);
            if($message !="ok" && $message !=""){
                $this->ShowPetRegister($message);
            }
            $message = $this->ImageDAO->Add($_FILES['vaccinationScheduleImg']);
            $pet = new Pet();
            $pet->setName($name);   
            $pet->setOwner($_SESSION["owner"]);
            $pet->setSize($size);
            $pet->setPicture($_FILES['picture']['name']);
            $pet->setVideo($video);
            $pet->setVaccinationScheduleImg($_FILES['vaccinationScheduleImg']['name']);
            $pet->setDescription($description);
            if($message !="ok" && $message !=""){
                $this->ShowPetRegister($message);
            }
            else{
                $this->PetDAO->Add($pet);
                $this->ShowPets();
            }
        
          
        }

        public function ShowPetRegister($message = null)
        {
            SessionHelper::ValidateSession();
            require_once(VIEWS_PATH."owner/register-pet.php");
        }

        public function ShowPets()
        {
            SessionHelper::ValidateSession();
            $pets =  $this->PetDAO->GetListByOwner($_SESSION["owner"]->getOwnerId());
            require_once(VIEWS_PATH."petList.php");
        }

        public function ShowPet($id)
        {
            SessionHelper::ValidateSession();
            $pet =  $this->PetDAO->GetById($id);
            require_once(VIEWS_PATH."petDetail.php");
        }



    }

    ?>