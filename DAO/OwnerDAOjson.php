<?php
    namespace DAO;

    use Models\Owner as Owner;
    use Models\Pet as Pet;

    class OwnerDAO implements IOwnerDAO{
        private $ownerList = array();
        
        function Add($owner)
        {
            $this->RetrieveData();
            array_push($ownerList, $owner);
            $this->SaveData();
        }
        
        function GetById($id){
            $owner = new Owner();
            return $owner;
        }

        function getOwnerByUserId($userId)
        {

            $this->RetrieveData();
            foreach($this->ownerList as $ownerItem){
                if($userId == $ownerItem->getOwnerId())
                {
                    return $ownerItem;
                }
            }
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
