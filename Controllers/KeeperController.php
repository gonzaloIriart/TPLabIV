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

        public function AddBusyEvent($name = "unavailable", $startDate, $endDate){
            
        }

        public function RegisterView($message = "")
        {
            require_once(VIEWS_PATH."keeper/register.php");
        } 

        public function ShowAvailableKeepers ($dates, $dogSize)
        {
            var_dump($dates);
            //$availableKeepers = aca deberiamos llamar al dao, para que llame al store que traiga los no disponibles y sacarselos a la lista que devuelva el getall
            $availableKeepers = "estos son los keeper disponibles";
            require_once(VIEWS_PATH."ownerHome.php");
            
        } 
    }

?>