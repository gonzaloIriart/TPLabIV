<?php
    namespace DAO;
    use Models\UserRol as UserRol;
    use Models\User as User;
    use Models\Keeper as Keeper;
    use Models\Owner as Owner;
    use DAO\IUserDAO as IUserDAO;
    use Helpers\JsonHelper as JsonHelper;

    class UserDAO implements IUserDAO
    {
        private $userList = array();
     
        public function GetUserByEmail(string $email){
            $this->RetrieveData();
            
            foreach($this->userList as $userItem){
                if($email == $userItem->getEmail()){
                    return $userItem;
                }
            }

            return null;
        }

        public function GetUserById($id){
            $this->RetrieveData();
            
            foreach($this->userList as $userItem){
                if($id == $userItem->getUserId()){
                    return $userItem;
                }
            }

            return null;
        }

        public function isOwner(User $user){
            foreach($user->getRoles() as $rol){
                if($rol->getRol() == "owner")
                    return true;
            }
            return false;
        }

        public function isKeeper(User $user){
            foreach($user->getRoles() as $rol){
                if($rol->getRol() == "keeper")
                    return true;
            }
            return false;
        }

        public function Add(User $user){
            $this->RetrieveData();
            array_push($this->userList, $user);
            $this->SaveData();
        }

        public function AddRol(User $user, string $rol){
            $userRol = new UserRol();
            $userRol->setUser($user);
            $userRol->setRol($rol);
            $this->UserRolDAO->Add($userRol);
            // Set user to null before adding the rol to avoid circular reference.
            $userRol->setUser(null);
            array_push($user->getRoles(), $userRol);
            foreach($this->userList as $userItem){
                if($userItem->getUserId() == $user->getUserId()){
                    $userItem = $user;
                }
            }
            $this->SaveData();
            return $user;
        }

        private function SaveData()
        {           
            $arrayToEncode = array();

            foreach($this->userList as $user) {
                $encodedUSer = JsonHelper::encodeUser($user);
                array_push($arrayToEncode, $encodedUSer);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/users.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->userList = array();

            if(file_exists('Data/users.json'))
            {
                $jsonContent = file_get_contents('Data/users.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $userItem){
                    $user = JsonHelper::decodeUser($userItem);
                    array_push($this->userList, $user);
                }            
            }
        }
    }
?>