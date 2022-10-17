<?php
    namespace DAO;

    use Models\Owner as Owner;
    use Models\Pet as Pet;

    class OwnerDAO implements IOwnerDAO{
        private $ownersList = array();
        
        function Add($owner)
        {
        }
        
        function GetById($id){
            $owner = new Owner();
            return $owner;
        }
        
        function GetListByOwner($id)
        {

        }
        
        function AddPetToOwner(Owner $owner, Pet $pet)
        {

        }

        

        private function SaveData()
        {           
            $arrayToEncode = array();
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/owners.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->ownersList = array();

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
