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


        public function RegisterPetView($message = "")
        {
            require_once(VIEWS_PATH."owner/register-pet.php");
        } 
    }
?>