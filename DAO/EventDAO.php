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

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

        public function GetEventsAsJson($events, $keeper) {
            $eventsJson = array();
            foreach($events as $eventItem)
            {
                $eventItem->setKeeper($keeper);
                $eventJson = ParameterHelper::encodeEvent($eventItem);
                array_push($eventsJson, $eventJson);
            }
            return $eventsJson;
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

        public function DeleteEvent($eventId){

        }
    }

?>