<?php 
    namespace DAO;
    use DAO\IKeeperDAO;
    use DAO\UserDAO;
    use Models\Keeper as Keeper;
    use Helpers\ParameterHelper;

    class KeeperDAO implements IKeeperDAO {

        public function __construct()
        {
            $this->UserDAO = new UserDAO;

        }

        private $keeperList = array();

        function Add(Keeper $keeper) 
        {
            $query = "CALL Keeper_Add(?, ?, ?)";

            $parameters = ParameterHelper::encodeKeeper($keeper);

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

        function GetAll($limit = 1000)
        {
            $query = "CALL Keeper_GetAll()";

            $this->connection = Connection::GetInstance();

            $parameters["limit"] = $limit;

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            $keeper = array();
            foreach($results as $keeperItem)
            {
                $keeperAux = ParameterHelper::decodeKeeper($keeperItem);
                $keeperAux->setUser($this->UserDAO->GetUserById($keeperItem["userId"]));
                array_push($keeper, $keeperAux); 
            }

            return $keeper;
        }

        public function GetById($id){
            $this->RetrieveData();
            
            foreach($this->keeperList as $keeperItem){
                if($id == $keeperItem->getKeeperId()){
                    return $keeperItem;
                }
            }

            return null;
        }

        public function getKeeperByUserId($userId){
            $query = "CALL Keeper_GetByUserId(?)";

            $this->connection = Connection::GetInstance();
            $parameters["userId"] = $userId;

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            $keeper = new Keeper();
            foreach($results as $keeperItem)
            {
                $keeper = ParameterHelper::decodeKeeper($keeperItem);
            }

            return $keeper;
        }

        public function getKeeperNotAvailableByDate($dates){
            $query = "CALL Keeper_GetByEventAvailableDates(?, ?)";

            $this->connection = Connection::GetInstance();         
         
            $parameters = ParameterHelper::encodeDates($dates);

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            $keeper = array();
            foreach($results as $keeperItem)
            {

                array_push($keeper, ParameterHelper::decodeKeeper($keeperItem)); 
            }

            return $keeper;
        }

        function ListByDogSize($dogSize) {}

        private function SaveData()
        {        
            $arrayToEncode = array();

            foreach($this->keeperList as $keeper) {
                $encodedKeeper = ParameterHelper::encodeKeeper($keeper);
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
                    $keeper = ParameterHelper::decodeKeeper($keeperItem);
                }
            }
        }
    }
?>