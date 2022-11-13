<?php 
    namespace DAO;

    use Models\Owner as Owner;
    use Models\User as User;
    use Models\Pet as Pet;
    use Models\Reserve as Reserve;
    use Helpers\ParameterHelper;
    use DAO\EventDAO;
    use DAO\PetDAO;

    class ReserveDAO implements IReserveDAO 
    {
        private $eventDAO;
        private $petDAO;

        public function __construct()
        {
            $this->eventDAO = new EventDAO;
            $this->petDAO = new PetDAO;
        }

        function Add($reserve){            
            $query = "CALL Reserve_Add(?, ?, ?, ?)";

            $parameters = ParameterHelper::encodeReserve($reserve);


            $this->connection = Connection::GetInstance();


            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

        public function GetById($id)
        {

            $query = "CALL Reserve_GetById(?)";

            $this->connection = Connection::GetInstance();
            
            $parameters["Id"] = $id;

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach($results as $reserveItem)
            {
               $reserve = ParameterHelper::decodeReserve($reserveItem);
            }
            
            return $reserve;

        }

        public function GetReservesByKeeperId($keeperId){
            $query = "CALL Reserve_GetAllByKeeperId(?)";

            $this->connection = Connection::GetInstance();
            
            $parameters["keeperId"] = $keeperId;
            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);
            $reserves = array();
            foreach($results as $reserveItem){
                $reserve = ParameterHelper::decodeReserve($reserveItem);
                $pet = $this->petDAO->GetById($reserve->getPet()->getPetId());
                $event = $this->eventDAO->GetById($reserve->getEvent()->getEventId());
                $reserve->setEvent($event);
                $reserve->setPet($pet);
                array_push($reserves, $reserve);
            }
            return $reserves;
        }

        public function GetReservesAsJson($reserves)
        {
            $reservesJson = array();
            foreach($reserves as $reserveItem)
            {
                $reserveJson = ParameterHelper::encodeReserveToJson($reserveItem);
                $pet = $this->petDAO->GetById($reserveJson["petId"]);
                $reserveJson["pet"] = ParameterHelper::encodePet($pet);
                array_push($reservesJson, $reserveJson);
            }
            return $reservesJson;

        }

        public function DeleteReserve($id)
        {

            $query = "CALL Reserve_DeleteById(?)";

            $this->connection = Connection::GetInstance();
            
            $parameters["Id"] = $id;

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

    
    }

?>