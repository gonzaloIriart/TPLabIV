<?php 
    namespace DAO;
    use Models\Keeper as Keeper;

    interface IKeeperDAO 
    {
        function Add(Keeper $keeper);
        function GetById($id);
        function GetAll($limit = null);
        function ListByDogSize($dogSize);
    }

?>