<?php
    namespace DAO;

    interface IUserDAO {
        function GetUserByEmail($email);
    }

?>