<?php 
    namespace DAO;
    use Models\Keeper as Keeper;
    use Models\Event as Event;

    interface IEventDAO 
    {
        function Add(Event $event);
        function GetByKeeperId($id);
    }

?>