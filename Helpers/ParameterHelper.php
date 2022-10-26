<?php
    namespace Helpers;

    use Models\User;
    use Models\UserRol;
    use Models\Keeper;
    use Models\Owner;
    use Models\Pet;

    class ParameterHelper {
        static function encodeUser($user){
            $encodedUser["name"] = $user->getName();
            $encodedUser["password"] = $user->getPassword();
            $encodedUser["email"] = $user->getEmail();
            $encodedUser["role"] = $user->getRole();
            
            return $encodedUser;
        }

        static function decodeUser($encodedUser){
            $user = new User();
            $user->setUserId($encodedUser["userId"]);
            $user->setEmail($encodedUser["email"]);
            $user->setPassword($encodedUser["password"]);
            $user->setName($encodedUser["name"]);
            $user->setRole($encodedUser["role"]);
            return $user;
        }

        static function encodeKeeper($keeper)
        {
            $encodedKeeper["keeperId"] = $keeper->getKeeperId();
            $encodedKeeper["sizeOfDog"] = $keeper->getSizeOfDog();
            $encodedKeeper["dailyFee"] = $keeper->getDailyFee();
            $encodedKeeper["reviews"] = null;
            $encodedKeeper["reserves"] = null;
            $encodedKeeper["availableDays"] = null;
            $encodedKeeper["user"] = null;

            return $encodedKeeper;
        }

        static function decodeKeeper($encodedKeeper)
        {
            $keeper = new Keeper();
            $keeper->setKeeperId($encodedKeeper["keeperId"]);
            $keeper->setSizeOfDog($encodedKeeper["sizeOfDog"]);
            $keeper->setDailyFee($encodedKeeper["dailyFee"]);

            return $keeper;
        }
    }
?>