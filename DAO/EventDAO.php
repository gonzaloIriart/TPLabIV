<?php 
    namespace DAO;
    
    use Models\Keeper as Keeper;
    use Models\Event as Event;
    use Helpers\ParameterHelper;

    class EventDAO implements IEventDAO 
    {
        function Add(Event $event) {
            $query = "CALL Event_Add(?, ?, ?, ?)";

            $parameters = ParameterHelper::encodeEvent($event);

            $this->connection = Connection::GetInstance();

            $id = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            return $id;
        }

        public function GetEventsAsJson($events, $keeper) {
            $eventsJson = array();
            foreach($events as $eventItem)
            {
                $eventItem->setKeeper($keeper);
                $eventJson = ParameterHelper::encodeEventToJson($eventItem);
                array_push($eventsJson, $eventJson);
            }
            return $eventsJson;
        }

        public function GetById($eventId){
            $query = "CALL Event_GetById(?)";
            $this->connection = Connection::GetInstance();
            $parameters["eventId"] = $eventId;

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);
            $event = new Event();
            $event = ParameterHelper::decodeEvent($result[0]);
            return $event;
        }

        public function GetByKeeperId($keeperId) {
            $query = "CALL Event_GetByKeeperId(?)";

            $this->connection = Connection::GetInstance();
            $parameters["keeperId"] = $keeperId;

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            $events = array();

            foreach($results as $eventItem)
            {
                $event = new Event();
                $event = ParameterHelper::decodeEvent($eventItem);

                array_push($events, $event);
            }

            return $events;
        }

        public function UpdateEventState($eventId, $status){
            
            $query = "CALL Event_UpdateStatus(?, ?)";

            $this->connection = Connection::GetInstance();
            $parameters["eventId"] = $eventId;
            $parameters["status"] = $status;

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

        public function DeleteEvent($eventId){
    
                $query = "CALL Event_DeleteById(?)";
    
                $this->connection = Connection::GetInstance();
                
                $parameters["Id"] = $eventId;
    
                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
            
        }
    }
