<?php 
    namespace DAO;

    use Models\Owner as Owner;
    use Models\User as User;
    use Models\Pet as Pet;
    use Helpers\ParameterHelper;

    class PetDAOjson 
    {
        private $petList = array();

        function Add($pet){         
            $this->RetrieveData();
            $num = count($this->petList)+1;
            $pet->setPetId($num);
            array_push($this->petList, $pet);
            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->petList;
        }

        public function GetById($id)
        {

            $this->RetrieveData();
    
            foreach($this->petList as $petItem){
                if($id == $petItem->getPetId()){
                    return $petItem;
                }
            }

        }

        function GetListByOwner($id){

            $this->RetrieveData();

            foreach($this->petList as $pet){
                if($pet->getOwner()->getOwnerId() != $_SESSION['owner']->getOwnerId()){
                    unset($this->petList, $pet);
                }
            }

            return $this->petList;

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
                $valuesArray["owner"] = ParameterHelper::encodeOwnerJson($pet->getOwner());

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
                    $pet->setOwner(ParameterHelper::decodeOwnerJson($petItem["owner"]));
                    array_push($this->petList, $pet);
                }            
            }
        }
    }

?>