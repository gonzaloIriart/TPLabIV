<?php
    namespace DAO;

    use Models\User as User;

    interface IUserDAO {
        function GetUserByEmail($email);
        function Add(User $user);
        function AddRol(User $user, $rol);
    }

?>