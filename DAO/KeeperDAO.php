<?php 
    namespace DAO;
    use DAO\IKeeperDAO;
    use Models\Keeper as Keeper;
    use Helpers\JsonHelper as JsonHelper;

    class KeeperDAO implements IKeeperDAO {
        private $keeperList = array();

        function Add(Keeper $keeper) 
        {
            $this->RetrieveData();
            array_push($this->keeperList, $keeper);
            $this->SaveData();
        }
        function GetById($id) {}
        function GetAll($limit = null)
        {
            $this->RetrieveData();
             
        }

        function ListByDogSize($dogSize) {}

        private function SaveData()
        {        
            $arrayToEncode = array();

            foreach($this->keeperList as $keeper) {
                $encodedKeeper = JsonHelper::encodeKeeper($keeper);
                array_push($arrayToEncode, $encodedKeeper);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/keepers.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->keeperList = array();

            if(file_exists('Data/keepers.json'))
            {
                $jsonContent = file_get_contents('Data/keepers.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true): array();
                
                foreach($arrayToDecode as $keeperItem)
                {
                    $keeper = JsonHelper::decodeKeeper($keeperItem);
                }
            }
        }
    }
?>