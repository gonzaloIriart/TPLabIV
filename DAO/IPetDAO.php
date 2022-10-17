<?php 
    namespace DAO;

    interface IPetDAO 
    {
        function Add($pet);
        function GetById($id);
        function GetListByOwner($id);
    }

?>