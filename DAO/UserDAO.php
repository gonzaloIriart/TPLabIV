<?php
    namespace DAO;
    use Models\UserRol as UserRol;
    use Models\User as User;
    use Models\Keeper as Keeper;
    use Models\Owner as Owner;
    use DAO\IUserDAO as IUserDAO;
    use Helpers\ParameterHelper as ParameterHelper;

    class UserDAO implements IUserDAO
    {
        private $userList = array();
        private $connection;
        private $tableName = "user";

        
     
        public function GetUserByEmail(string $email){
            $query = "CALL User_GetByEmail(?)";

            $this->connection = Connection::GetInstance();
            $parameters["email"] = $email;

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            $user = new User();
            foreach($results as $userItem)
            {
                $user = ParameterHelper::decodeUser($userItem);
            }

            return $user;
        }

        public function GetUserById($id){
            $query = "CALL User_GetById(?)";

            $this->connection = Connection::GetInstance();
            $parameters["id"] = $id;

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach($results as $userItem)
            {
                $user = new User();
                $user = ParameterHelper::decodeUser($userItem);
            }

            return $user;
        }

        public function isOwner(User $user){
            return ($user->getRole() == "o");
        }

        public function isKeeper(User $user){
            return ($user->getRole() == "k");
        }

        public function Add(User $user){


            $query = "CALL User_Add(?, ?, ?, ?, ?, ?)";

            $parameters = ParameterHelper::encodeUser($user);

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

        public function UpdateUserPasswordById($id, $newPassword){
            $query = "CALL User_UpdateUserPasswordById(?, ?)";

            $parameters["Id"] = $id;
            $parameters["newPassword"] = $newPassword;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

        private function SaveData()
        {           
            $arrayToEncode = array();

            foreach($this->userList as $user) {
                $encodedUSer = ParameterHelper::encodeUser($user);
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
                    $user = ParameterHelper::decodeUser($userItem);
                    array_push($this->userList, $user);
                }            
            }
        }
    }
?>