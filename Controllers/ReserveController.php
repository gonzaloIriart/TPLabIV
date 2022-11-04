<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use DAO\PetDAO as PetDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\ReserveDAO as ReserveDAO;
    use DAO\EventDAO as EventDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Helpers\JsonHelper as JsonHelper;
    use Models\User as User;
    use Models\Owner as Owner;
    use Models\Pet as Pet;
    use Models\Keeper as Keeper;
    use Models\Reserve as Reserve;
    use Models\Event as Event;

    class ReserveController
    {

        public function __construct()
        {
            $this->userDAO = new UserDAO;
            $this->OwnerDAO = new OwnerDAO;
            $this->PetDAO = new PetDAO();
            $this->ReserveDAO = new ReserveDAO();
            $this->KeeperDAO = new KeeperDAO();
        }

        public function CreateReserve($keeperId, $petId, $dates, $totalPrice)
        {
            var_dump($keeperId);
            var_dump($petId);
            var_dump($dates);
            var_dump($totalPrice);

            $arrayDates = explode(" ", $dates);
            $startDate = $arrayDates["0"];
            $endDate = $arrayDates["1"];
           
            $event = new Event();
            $event->setKeeper($this->KeeperDAO->GetById($keeperId));
            $event->setStartDate($startDate);
            $event->setEndDate($endDate);
            $event->setStatus("pending"); // esto habria que ponerlo en un enum
            //$this->EventDAO->Add($event);

            // $reserve = new Reserve(); 
            // $reserve->setTotalFee(10); // calcular total fee, calculo que sera keeper->price * los dias entre startDate y endDate
            // $reserve->setAdvancePayment(5); // calcularlo, calculo que sera un porcentaje de totalfee
            // $reserve->setPet($pet);
            // $reserve->setEvent($event);
            // //$this->ReserveDAO->Add($reserve);

            
            
        }

       



    }

    ?>