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
        public static function hydrateUserSession(User $user) {            
            $_SESSION["loginUser"] = $user;
        }
    }
?>