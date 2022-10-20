<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\PetDAO as PetDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\User as User;
    use Models\Owner as Owner;
    use Models\Pet as Pet;

    class PetController
    {

        public function __construct()
        {
            $this->userDAO = new UserDAO;
            $this->ownerDAO = new OwnerDAO;
            $this->PetDAO = new PetDAO();
        }

        public function RegisterPet($name, $size, $picture, $video, $vaccinationSchedule)
        {
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
            $pet->setOwner($_SESSION["owner"]->getOwnerId);
            $pet->setPicture($picture);
            $pet->setVideo($video);
            $pet->setVaccinationScheduleImg($vaccinationSchedule);
            $this->PetDAO->Add($pet);

            // require_once(VIEWS_PATH."home.php");
        }


    }

    ?>