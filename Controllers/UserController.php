<?php
    // Register user, manage user view
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\Keeper as Keeper;
    use Models\User as User;

    class UserController
    {
        private $userDAO;
        private $keeperDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO;
            $this->keeperDAO = new KeeperDAO;
        }

        public function Register($name, $email, $password, $role = 'o', $sizeOfDog = null, $dailyFee = null) 
        {
            if($this->userDAO->GetUserByEmail($email))
                $this->RegisterView("El email ya se encuentra en uso.");

            $user = new User();
            $user->setName($name);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setRole($role);
            $this->userDAO->Add($user);

            if($role == 'k'){
                $keeper = new Keeper();
                $keeper->setSizeOfDog($sizeOfDog);
                $keeper->setDailyFee($dailyFee); 
                $keeper->setUser($user);

                $this->keeperDAO->Add($keeper);
            }
            
            $user = $this->userDAO->GetUserByEmail($email);
            SessionHelper::hydrateUserSession($user);
            require_once(VIEWS_PATH."keeperHome.php");
            
        }

        public function RegisterView($message = "")
        {
            require_once(VIEWS_PATH."user/register.php");
        } 
    }

?>