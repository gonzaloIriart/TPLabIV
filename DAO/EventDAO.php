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

        function GetByKeeperId($keeperId) {
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
    }

?>