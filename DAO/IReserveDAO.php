<?php 
    namespace DAO;

    interface IReserveDAO 
    {
        function Add($reserve);
        function GetById($id);
    }

?>