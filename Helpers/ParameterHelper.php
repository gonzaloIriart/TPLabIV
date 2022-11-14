<?php
    namespace Helpers;

    use Models\BankAccount;
    use Models\User;
    use Models\UserRol;
    use Models\Keeper;
    use Models\Owner;
    use Models\Pet;
    use Models\Reserve;
    use Models\Payment;
    use Models\Event as Event;
use Models\Review;

    class ParameterHelper {
        static function encodeUser($user){
            $encodedUser["name"] = $user->getName();
            $encodedUser["email"] = $user->getEmail();
            $encodedUser["password"] = $user->getPassword();
            $encodedUser["role"] = $user->getRole();
            $encodedUser["secretQuestion"] = $user->getSecretQuestion();
            $encodedUser["answer"] = $user->getAnswer();
            
            return $encodedUser;
        }

        static function decodeUser($encodedUser){
            $user = new User();
            $user->setUserId($encodedUser["id"]);
            $user->setEmail($encodedUser["email"]);
            $user->setPassword($encodedUser["password"]);
            $user->setName($encodedUser["name"]);
            $user->setRole($encodedUser["role"]);
            $user->setSecretQuestion($encodedUser["secretQuestion"]);
            $user->setAnswer($encodedUser["answer"]);
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
            $user = new User();
            $user->setUserId($encodedOwner["userId"]);
            $owner->setOwnerId($encodedOwner["id"]);
            $owner->setUser($user);

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
            $owner = new Owner();

            $owner->setOwnerId($encodedPet["ownerId"]);
            $pet->setPetId($encodedPet["id"]);
            $pet->setOwner($owner);
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

        static function encodeEventToJson($event)
        {
            $encodedEvent["id"] = $event->getEventId();
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

        static function encodeReserveToJson($reserve)
        {
            $encodeReserve["id"] = $reserve->getReserveId();
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

        static function encodeBankAccount($bankAccount)
        {
            $encodedBankAccount["alias"] = $bankAccount->getAlias();
            $encodedBankAccount["cbu"] = $bankAccount->getCbu();
            $encodedBankAccount["bank"] = $bankAccount->getBank();
            $encodedBankAccount["keeperId"] = $bankAccount->getKeeper()->getKeeperId();

            return $encodedBankAccount;
        }

        static function decodeBankAccount($encodedBankAccount)
        {
            $bankAccount = new BankAccount();
            
            $bankAccount->setBankAccountId($encodedBankAccount["id"]);
            $bankAccount->setAlias($encodedBankAccount["alias"]);
            $bankAccount->setCbu($encodedBankAccount["cbu"]);
            $bankAccount->setBank($encodedBankAccount["bank"]);

            return $bankAccount;
        }

        static function encodePayment($payment)
        {
            $encodedPayment["ownerId"] = $payment->getOwner()->getOwnerId();
            $encodedPayment["reserveId"] = $payment->getReserve()->getReserveId();
            $encodedPayment["bankAccountId"] = $payment->getBankAccount()->getBankaccountId();

            return $encodedPayment;
        }

        static function decodePayment($encodedPayment)
        {
            $payment = new Payment();
            
            $payment->setPaymentId($encodedPayment["id"]);
            $payment->setBankAccount($encodedPayment["bankAccountId"]);
            $payment->setOwner($encodedPayment["ownerId"]);
            $payment->setReserve($encodedPayment["reserveId"]);

            return $payment;
        }

        static function encodeReview($review)
        {       
            $encodedReview["comment"] = $review->getComment();
            $encodedReview["date"] = $review->getDate();
            $encodedReview["stars"] = $review->getStars();
            $encodedReview["reserveId"] = $review->getReserve()->getReserveId();

            return $encodedReview;
        }

        static function decodeReview($encodedReview)
        {
            $reserve = new Reserve();
            $review = new Review();
            
            $reserve->setReserveId($encodedReview["reserveId"]);
            $review->setReserve($reserve);

            $review->setReviewId($encodedReview["id"]);
            $review->setDate($encodedReview["date"]);
            $review->setStars($encodedReview["stars"]);
            $review->setComment($encodedReview["comment"]);

            return $review;
        }
    }
?>