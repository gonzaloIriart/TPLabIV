<?php 
    namespace DAO;

    interface IUserRolDAO 
    {
        function Add($userRol);
        function GetById($id);
        function GetListByUser($userId);
    }

?>