<?php
    namespace DAO;

    use Models\Owner as Owner;
    use Models\Pet as Pet;
    use Helpers\ParameterHelper;

    class OwnerDAO implements IOwnerDAO{

        private $ownerList = array();
        
        function Add(Owner $owner) 
        {
            $query = "CALL Owner_Add(?)";

            $parameters = ParameterHelper::encodeOwner($owner);

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

        
        function GetById($id){
            $owner = new Owner();
            return $owner;
        }

        public function getOwnerByUserId($userId){
            
            $query = "CALL Owner_GetByUserId(?)";

            $this->connection = Connection::GetInstance();
            $parameters["userId"] = $userId;

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            $keeper = new Owner();
            foreach($results as $owner)
            {
                $owner = ParameterHelper::decodeOwner($owner);
            }

            return $owner;
        }
        
        function GetPetListByOwner($id)
        {
        }
        
        function AddPetToOwner($ownerId, $petId)
        {
            $this->RetrieveData();
            foreach($this->ownerList as $ownerItem){
                if($ownerItem->getOwnerId() == $ownerId){
                    $_SESSION["owner"]->setPets($ownerItem->getPets().', '. $petId);
                    $ownerItem->setPets($ownerItem->getPets().', '. $petId);
                  
                    var_dump($ownerItem);
                    var_dump($_SESSION["owner"]);
                    
                }
            }
            $this->SaveData();
        }        

        private function SaveData()
        {   
        
            $arrayToEncode = array();

            foreach($this->ownerList as $owner)
            {
                $valuesArray["ownerId"] = $owner->getOwnerId();
                $valuesArray["pets"] = $owner->getPets();
                $valuesArray["user"] = $owner->getUser();
                
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/owners.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->ownerList = array();

            if(file_exists('Data/owners.json'))
            {
                $jsonContent = file_get_contents('Data/owners.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $ownerItem){
                    $owner = new Owner();
                    $owner->setOwnerId($ownerItem["ownerId"]);
                    $owner->setPets($ownerItem["pets"]);
                    array_push($this->ownerList, $owner);
                }            
            }
        }
    }
?>
