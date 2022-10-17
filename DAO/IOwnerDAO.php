<?php 
    namespace DAO;

    interface IOwnerDAO 
    {
        function Add($owner);
        function GetById($id);
        function GetListByOwner($id);
    }

?>