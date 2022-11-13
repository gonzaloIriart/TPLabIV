<?php
    // Register user, manage user view
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\EventDAO as EventDAO;
    use DAO\ReserveDAO as ReserveDAO;
    use DAO\BankAccountDAO as BankAccountDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\BankAccount; 
    use Models\User as User;
    use Models\Owner as Owner;
    use Models\Keeper as Keeper;

    class UserController
    {
        private $userDAO;
        private $OwnerDAO;
        private $keeperDAO;
        private $eventDAO;
        private $reserveDAO;
        private $bankAccountDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO;
            $this->OwnerDAO = new OwnerDAO;
            $this->keeperDAO = new KeeperDAO;
            $this->eventDAO = new EventDAO;
            $this->reserveDAO = new ReserveDAO;
            $this->bankAccountDAO = new BankAccountDAO;
        }

        public function UpdatePassword($email){
            $user = $this->userDAO->GetUserByEmail($email);
            if($user->getUserId() != null){
                require_once(VIEWS_PATH."passwordRecover.php");
            }
            else{
                $message=("Email no registrado");
                require_once(VIEWS_PATH."index.php");
            }
            
        }

        public function VerifyAnswerUpdatePassword($id, $answer, $newPassword){

            $user =  $this->userDAO->GetUserById($id);

            if($user->getAnswer() == $answer){
                $this->userDAO->UpdateUserPasswordById($id, $newPassword);
                require_once(VIEWS_PATH."index.php");
            }
            else{
                $message = "La respuesta no es correcta.";
                require_once(VIEWS_PATH."passwordRecover.php");
            }

            var_dump($user);


        }

        public function Register($name, $email, $password, $role, $sizeOfDog = null, $dailyFee = null, $secretQuestion, $answer) 
        {
            if (!($role == 'o' || $role == 'k'))
            {
                $role = 'o';
            }

            if($this->userDAO->GetUserByEmail($email)->getUserId() != null)
            {
                $this->RegisterView("El email ya se encuentra en uso.");

            }else{

                $user = new User();
            $user->setName($name);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setRole($role);
            $user->setSecretQuestion($secretQuestion);
            $user->setAnswer($answer);

            $this->userDAO->Add($user);
            $user = $this->userDAO->GetUserByEmail($email);

          

            if($role == 'k'){
                $keeper = new Keeper();
                $keeper->setSizeOfDog($sizeOfDog);
                $keeper->setDailyFee($dailyFee); 
                $keeper->setUser($user);

                $this->keeperDAO->Add($keeper);
                $keeper = $this->keeperDAO->getKeeperByUserId($user->getUserId());

                $bankAccount = new BankAccount();
                $bankAccount->setAlias($alias);
                $bankAccount->setCbu($cbu);
                $bankAccount->setBank($bank);
                $bankAccount->setKeeper($keeper);
                $this->bankAccountDAO->Add($bankAccount);
            }
            if($role == 'o')
            {
                $owner = new Owner();
                $owner->setUser($user);
                $this->OwnerDAO->Add($owner);

            }
            
            SessionHelper::hydrateUserSession($user);
            
            if($user->getRole() == 'o'){
         
                $owner = $this->OwnerDAO->getOwnerByUserId($user->getUserId());
                $owner->setUser($user);
                SessionHelper::hydrateOwnerSession($owner);
                require_once(VIEWS_PATH."ownerHome.php");
            }
            else if($user->getRole() == 'k'){
                $keeper = $this->keeperDAO->getKeeperByUserId($user->getUserId());
                SessionHelper::hydrateKeeperSession($keeper);
                $this->CalendarView();
            }else {
                require_once(VIEWS_PATH."errorPage.php");
            }
            }
            
            
            
        }

        public function RegisterView($message = "")
        {
            require_once(VIEWS_PATH."user/register.php");
        } 

        public function CalendarView($message = ""){
            $keeper = $_SESSION["keeper"];
            $reserves = $this->reserveDAO->GetReservesAsJson($this->reserveDAO->GetReservesByKeeperId($keeper->getKeeperId()));
            $events = $this->eventDAO->GetEventsAsJson($this->eventDAO->GetByKeeperId($keeper->getKeeperId()), $keeper);

            require_once(VIEWS_PATH."keeper/home.php");
        }
    }

?>