<?php
    namespace DAO;

    use Models\User as User;
    use Models\Keeper as Keeper;
    use Models\Owner as Owner;

    interface IUserDAO {
        function GetUserByEmail(string $email);
        function Add(User $user);
        function isOwner(User $user);
        function isKeeper(User $user);
    }
?>