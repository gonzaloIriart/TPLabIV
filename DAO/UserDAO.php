<?php
    namespace DAO;
    use Models\User as User;
    use DAO\IUserDAO as IUserDAO;

    class UserDAO implements IUSERDAO
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
                    $user = new User();
                    $user->setUserId($userItem["userId"]);
                    $user->setEmail($userItem["email"]);
                    $user->setPassword($userItem["password"]);

                    array_push($this->userList, $user);
                }
              
            }
        }
    }
?>