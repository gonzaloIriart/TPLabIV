<?php 
    namespace DAO;

    interface IKeeperDAO 
    {
        function Add($keeper);
        function GetById($id);
        function ListByDogType($dogType);
    }

?>