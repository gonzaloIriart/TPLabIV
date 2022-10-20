<?php
    namespace Helpers;

    use Models\User;
    use Models\UserRol;
    use Models\Keeper;
    use Models\Owner;
    use Models\Pet;

    class JsonHelper {
        static function encodeUser($user){
            $encodedUser["userId"] = $user->getUserId();
            $encodedUser["email"] = $user->getEmail();
            $encodedUser["password"] = $user->getPassword();
            $encodedUser["name"] = $user->getName();
            $encodedUser["roles"] = array();
            
            foreach($user->getRoles() as $userRol) {
                $encodedUserRol["userRolId"] = $userRol->getUserRolId();
                $encodedUserRol["rol"] = $userRol->getRol();
                $encodedUserRol["user"] = null;
                array_push($encodedUser["roles"], $encodedUserRol);
            }
            return $encodedUser;
        }

        static function decodeUser($encodedUser){
            $roles = array();
            $user = new User();
            $user->setUserId($encodedUser["userId"]);
            $user->setEmail($encodedUser["email"]);
            $user->setPassword($encodedUser["password"]);
            $user->setName($encodedUser["name"]);
            $user->setRole($encodedUser["role"]);
            return $user;
        }
    }
?>