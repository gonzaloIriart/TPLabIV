<?php 
    namespace DAO;

    interface IReviewDAO 
    {
        function Add($review);
        function GetById($id);
        function GetAllByKeeperId($keeperId);
    }

?>