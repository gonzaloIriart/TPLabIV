<?php 
    namespace DAO;

    use Models\Owner as Owner;
    use Models\User as User;
    use Models\Pet as Pet;
    use Helpers\ParameterHelper;

    class PetDAO implements IPetDAO 
    {
        private $petList = array();

        function Add($pet){            


            $query = "CALL Pet_Add(?, ?, ?, ?, ?, ?, ?)";

            $parameters = ParameterHelper::encodePet($pet);

            $this->connection = Connection::GetInstance();


            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);

        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->petList;
        }

        public function GetById($id)
        {

            $query = "CALL Pet_GetById(?)";

            $this->connection = Connection::GetInstance();
            
            $parameters["Id"] = $id;

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach($results as $pet)
            {
               $pet = ParameterHelper::decodePet($pet);
            }
            
            return $pet;

        }

        function GetListByOwner($ownerId){

            $query = "CALL Pet_GetByOwnerId(?)";

            $this->connection = Connection::GetInstance();
            
            $parameters["OwnerId"] = $ownerId;

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            $pets = array();
            foreach($results as $pet)
            {
               array_push($pets, ParameterHelper::decodePet($pet));
            }

            return $pets;
        }

        private function SaveData()
        {           
            $arrayToEncode = array();

            foreach($this->petList as $pet)
            {
                $valuesArray["petId"] = $pet->getPetId();
                $valuesArray["name"] = $pet->getName();
                $valuesArray["size"] = $pet->getSize();
                $valuesArray["picture"] = $pet->getPicture();
                $valuesArray["video"] = $pet->getVideo();
                $valuesArray["vaccinationScheduleImg"] = $pet->getVaccinationScheduleImg();
                $valuesArray["owner"] = $pet->getOwner();
                
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/pets.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->petList = array();

            if(file_exists('Data/pets.json'))
            {
                $jsonContent = file_get_contents('Data/pets.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $petItem){
                    $pet = new Pet();
                    $pet->setPetId($petItem["petId"]);
                    $pet->setName($petItem["name"]);
                    $pet->setSize($petItem["size"]);
                    $pet->setPicture($petItem["picture"]);
                    $pet->setVideo($petItem["video"]);
                    $pet->setVaccinationScheduleImg($petItem["vaccinationScheduleImg"]);
                    $pet->setOwner($petItem["owner"]);
                    array_push($this->petList, $pet);
                }            
            }
        }
    }

?>