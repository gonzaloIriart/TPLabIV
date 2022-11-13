<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\PetDAO as PetDAO;
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
            $this->ImageDAO = new ImageDAO();
        }

        public function RegisterPet($name, $size, $video, $description)
        {
            $message = $this->ImageDAO->Add($_FILES['picture']);
            $message = $this->ImageDAO->Add($_FILES['vaccinationScheduleImg']);
            $pet = new Pet();
            $pet->setName($name);
            $pet->setOwner($_SESSION["owner"]->getOwnerId());
            $pet->setSize($size);
            $pet->setPicture($_FILES['picture']['name']);
            $pet->setVideo($video);
            $pet->setVaccinationScheduleImg($_FILES['vaccinationScheduleImg']['name']);
            $pet->setDescription($description);
            if($message !="ok" && $message !=""){
                require_once(VIEWS_PATH."owner/register-pet.php");
            }
            else{
                $this->PetDAO->Add($pet);
                $this->ShowPets();
            }
        
          
        }

        public function ShowPets()
        {
            $pets =  $this->PetDAO->GetListByOwner($_SESSION["owner"]->getOwnerId());
            require_once(VIEWS_PATH."petList.php");
        }

        public function ShowPet($id)
        {
            $pet =  $this->PetDAO->GetById($id);
            require_once(VIEWS_PATH."petDetail.php");
        }



    }

    ?>