<?php 
    namespace DAO;

    use Models\Owner as Owner;
    use Models\User as User;
    use Models\Pet as Pet;

    class PetDAO implements IPetDAO 
    {
        private $petList = array();

        function Add($pet){            
            $this->RetrieveData();
            array_push($this->petList, $pet);
            $this->SaveData();
        }

        public function GetAll()
            {
                $this->RetrieveData();
                return $this->petList;
            }

        function GetById($id){}

        function GetListByOwner($id){}

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
                $valuesArray["vaccinationSchedule"] = $pet->getVaccinationScheduleIg();
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
                    $owner = new Owner();
                    $user = new User();
                    $pet->setPetId($petItem["petId"]);
                    $pet->setName($petItem["name"]);
                    $pet->setSize($petItem["size"]);
                    $pet->setPicture($petItem["picture"]);
                    $pet->setVideo($petItem["video"]);
                    $pet->setVaccinationScheduleImg($petItem["vaccinationScheduleImg"]);
                    $owner->setOwnerId($petItem["ownerId"]);

                    array_push($this->petList, $pet);
                }            
            }
        }
    }

?>