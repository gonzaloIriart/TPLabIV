<?php
    namespace Helpers;

    use Models\User;
    use Models\Keeper;
    use Models\Owner;
    use DAO\UserDAO;
    use DAO\KeeperDAO;
    use DAO\OwnerDAO;

    class SessionHelper {
        private $userDAO;
        private $keeperDAO;
        private $ownerDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
            $this->keeperDAO = new KeeperDAO();
            $this->ownerDAO = new OwnerDAO();
        }

        public static function resetSession() { 
            session_destroy();
        }

        public static function hydrateUserSession(User $user) {            
            $_SESSION["loggedUser"] = $user;
        }

        
        public static function hydrateOwnerSession(Owner $owner) {            
            $_SESSION["owner"] = $owner;
        }

        public static function hydrateKeeperSession(Keeper $keeper) {            
            $_SESSION["keeper"] = $keeper;
        }

        public static function getLoginUser() {
            return $_SESSION["loggedUser"];
        }

        public static function ValidateSession(){
            if(!isset($_SESSION["loggedUser"])){
                header("location: ". FRONT_ROOT . "Home/Index");
            }
        }
    }
?>