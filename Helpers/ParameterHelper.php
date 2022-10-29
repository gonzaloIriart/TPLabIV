<?php
    namespace Helpers;

    use Models\User;
    use Models\UserRol;
    use Models\Keeper;
    use Models\Owner;
    use Models\Pet;
    use Models\Event as Event;

    class ParameterHelper {
        static function encodeUser($user){
            $encodedUser["name"] = $user->getName();
            $encodedUser["email"] = $user->getEmail();
            $encodedUser["password"] = $user->getPassword();
            $encodedUser["role"] = $user->getRole();
            
            return $encodedUser;
        }

        static function decodeUser($encodedUser){
            $user = new User();
            $user->setUserId($encodedUser["id"]);
            $user->setEmail($encodedUser["email"]);
            $user->setPassword($encodedUser["password"]);
            $user->setName($encodedUser["name"]);
            $user->setRole($encodedUser["role"]);
            return $user;
        }

        static function encodeKeeper($keeper)
        {
            $encodedKeeper["sizeOfDog"] = $keeper->getSizeOfDog();
            $encodedKeeper["dailyFee"] = $keeper->getDailyFee();
            $encodedKeeper["userId"] = $keeper->getUser()->getUserId();

            return $encodedKeeper;
        }

        static function decodeKeeper($encodedKeeper)
        {
            $keeper = new Keeper();
            $keeper->setKeeperId($encodedKeeper["id"]);
            $keeper->setSizeOfDog($encodedKeeper["sizeOfDog"]);
            $keeper->setDailyFee($encodedKeeper["dailyFee"]);

            return $keeper;
        }

        static function encodeEvent($event)
        {
            $encodedEvent["status"] = $event->getStatus();
            $encodedEvent["startDate"] = $event->getStartDate();
            $encodedEvent["endDate"] = $event->getEndDate();
            $encodedEvent["keeperId"] = $event->getKeeper()->getKeeperId();
        }

        static function decodeEvent($encodedEvent)
        {
            $event = new Event();
            
            $event->setEventId($encodedEvent["id"]);
            $event->setStatus($encodedEvent["status"]);
            $event->setStartDate($encodedEvent["startDate"]);
            $event->setEndDate($encodedEvent["endDate"]);
        }
    }
?>