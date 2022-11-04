<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\PetDAO as PetDAO;
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
        }

        public function RegisterPet($name, $size, $picture, $video, $vaccinationSchedule, $description)
        {
            $pet = new Pet();
            $pet->setName($name);
            $pet->setOwner($_SESSION["owner"]->getOwnerId());
            $pet->setSize($size);
            $pet->setPicture($picture);
            $pet->setVideo($video);
            $pet->setVaccinationScheduleImg($vaccinationSchedule);
            $pet->setDescription($description);
            $this->PetDAO->Add($pet);
            $this->ShowPets();

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