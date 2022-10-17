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
        
        function GetPetListByOwner($id)
        {
        }
        
        function AddPetToOwner(Owner $owner, Pet $pet)
        {
            $this->RetrieveData();
            $ownerPets = $owner->getPets();
            array_push($ownerPets, $pet);
            foreach($this->ownerList as $ownerItem){
                if($ownerItem->getOwnerId() == $owner->getOwnerId()){
                    $ownerItem = $owner;
                }
            }
            $this->SaveData();
        }        

        private function SaveData()
        {           
            $arrayToEncode = array();
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

                foreach($arrayToDecode as $userItem){
                    $owner = new Owner();

                    array_push($this->ownerList, $owner);
                }            
            }
        }
    }
?>
