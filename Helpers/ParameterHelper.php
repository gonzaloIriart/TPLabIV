<?php
    namespace Helpers;

    use Models\User;
    use Models\UserRol;
    use Models\Keeper;
    use Models\Owner;
    use Models\Pet;
    use Models\Reserve;
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

        static function encodeOwner($owner)
        {
            $encodedOwner["userId"] = $owner->getUser()->getUserId();
            return $encodedOwner;
        }

        static function decodeOwner($encodedOwner)
        {
            $owner = new Owner();
            $owner->setOwnerId($encodedOwner["id"]);

            return $owner;
        }

        static function encodePet($pet)
        {
            $encodedPet["ownerId"] = $pet->getOwner();
            $encodedPet["name"] = $pet->getName();
            $encodedPet["size"] = $pet->getSize();
            $encodedPet["video"] = $pet->getVideo();
            $encodedPet["picture"] = $pet->getPicture();
            $encodedPet["vaccinationScheduleImg"] = $pet->getVaccinationScheduleImg();
            $encodedPet["description"] = $pet->getDescription();
            return $encodedPet;
        }

        static function decodePet($encodedPet)
        {

            $pet = new Pet();
            $pet->setPetId($encodedPet["id"]);
            $pet->setOwner($encodedPet["ownerId"]);
            $pet->setName($encodedPet["name"]);
            $pet->setSize($encodedPet["size"]);
            $pet->setVideo($encodedPet["video"]);
            $pet->setPicture($encodedPet["picture"]);
            $pet->setVaccinationScheduleImg($encodedPet["vaccinationScheduleImg"]);
            $pet->setDescription($encodedPet["description"]);

            return $pet;
        }

        static function encodeEvent($event)
        {
            $encodedEvent["status"] = $event->getStatus();
            $encodedEvent["startDate"] = $event->getStartDate();
            $encodedEvent["endDate"] = $event->getEndDate();
            $encodedEvent["keeperId"] = $event->getKeeper()->getKeeperId();

            return $encodedEvent;
        }

        static function decodeEvent($encodedEvent)
        {
            $event = new Event();
            
            $event->setEventId($encodedEvent["id"]);
            $event->setStatus($encodedEvent["status"]);
            $event->setStartDate($encodedEvent["startDate"]);
            $event->setEndDate($encodedEvent["endDate"]);

            return $event;
        }

        static function encodeDates($dates)
        {
            $encodedDates["startDate"] = date("Y-m-d", strtotime($dates["0"])) ;
            $encodedDates["endDate"] = date("Y-m-d", strtotime($dates["1"])) ;

            return $encodedDates;
        }

        static function encodeDatesPlusMinusOne($dates)
        {
            $encodedDates["startDate"] = date("Y-m-d", strtotime($dates["0"] . '- 1 days')) ;
            $encodedDates["endDate"] = date("Y-m-d", strtotime($dates["1"] . '+ 1 days')) ;

            return $encodedDates;
        }

        static function encodeReserve($reserve)
        {

            $encodeReserve["totalFee"] = $reserve->getTotalFee();
            $encodeReserve["advancePayment"] = $reserve->getAdvancePayment();
            $encodeReserve["petId"] = $reserve->getPet()->getPetId();
            $encodeReserve["eventId"] = $reserve->getEvent()->getEventId();

            return $encodeReserve;

        }

        static function decodeReserve($encodedReserve)
        {
            $reserve = new Reserve();
            $pet = new Pet();
            $event = new Event();
            
            $pet->setPetId($encodedReserve["petId"]);
            $event->setEventId($encodedReserve["eventId"]);

            $reserve->setReserveId($encodedReserve["id"]);
            $reserve->setTotalFee($encodedReserve["totalFee"]);
            $reserve->setAdvancePayment($encodedReserve["advancePayment"]);
            $reserve->setPet($pet);
            $reserve->setEvent($event);

            return $reserve;
        }


        
    }
?>