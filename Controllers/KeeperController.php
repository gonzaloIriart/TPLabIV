<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\Keeper as Keeper;

    class KeeperController
    {
        private $userDAO;
        private $keeperDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO;
            $this->keeperDAO = new KeeperDAO;
        }

        public function Register($dailyFee, $sizeOfDog) 
        {
            $keeper = new Keeper();
            $keeper->setSizeOfDog($sizeOfDog);
            $keeper->setDailyFee($dailyFee);            
            
            require_once(VIEWS_PATH."keeper/home.php");            
        }

        public function RegisterView($message = "")
        {
            require_once(VIEWS_PATH."keeper/register.php");
        } 
    }

?>