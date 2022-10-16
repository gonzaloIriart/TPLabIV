<?php
    namespace DAO;
    use Models\UserRol as UserRol;
    use Models\User as User;
    use Models\Keeper as Keeper;
    use Models\Owner as Owner;
    use DAO\IUserDAO as IUserDAO;

    class UserDAO implements IUserDAO
    {
        private $userList = array();
     
        public function GetUserByEmail($email){
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
            array_push($userList, $user);
            $this->SaveData();
        }

        public function AddRol(User $user, $rol){
            $user = $this->GetUserById($user->getUserId);
            array_push($user->getRoles(), $user);
            $this->SaveData();
        }

        private function SaveData()
        {           
            $arrayToEncode = array();
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
                    $roles = array();
                    $user = new User();
                    $owner = new Owner();
                    $keeper = new Keeper();
                    $user->setUserId($userItem["userId"]);
                    $user->setEmail($userItem["email"]);
                    $user->setPassword($userItem["password"]);
                    $user->setName($userItem["name"]);

                    foreach($userItem["roles"] as $rolItem){
                        $rol = new UserRol();
                        $rol->setUserRolId($rolItem["userRolId"]);
                        $rol->setUser($rolItem["user"]);
                        $rol->setRol($rolItem["rol"]);
                        array_push($roles, $rol);
                    }

                    $user->setRoles($roles);

                    array_push($this->userList, $user);
                }            
            }
        }
    }
?>