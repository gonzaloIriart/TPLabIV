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
    use Helpers\ParameterHelper;

    class ReserveController
    {

        public function __construct()
        {
            $this->userDAO = new UserDAO;
            $this->OwnerDAO = new OwnerDAO;
            $this->PetDAO = new PetDAO();
            $this->ReserveDAO = new ReserveDAO();
            $this->KeeperDAO = new KeeperDAO();
            $this->EventDAO = new EventDAO();
        }

        public function CreateReserve($keeperId, $petId, $dates, $totalPrice)
        {
            SessionHelper::ValidateSession();

            $arrayDates = ParameterHelper::encodeDates (explode(" ", $dates));
            $startDate = $arrayDates["startDate"];
            $endDate = $arrayDates["endDate"];
           
            $event = new Event();
            $event->setKeeper($this->KeeperDAO->GetById($keeperId));
            $event->setStartDate($startDate);
            $event->setEndDate($endDate);
            $event->setStatus("pending"); // esto habria que ponerlo en un enum
            $eventId = $this->EventDAO->Add($event);
            $event->setEventId($eventId["0"]["0"]);

            $reserve = new Reserve(); 
            $reserve->setTotalFee($totalPrice); 
            $reserve->setAdvancePayment($totalPrice*0.5); // calcularlo, calculo que sera un porcentaje de totalfee
            $reserve->setPet($this->PetDAO->GetById($petId));
            $reserve->setEvent($event);
            $this->ReserveDAO->Add($reserve);

            $message = "Reserva realizada con exito";
            require_once(VIEWS_PATH."ownerHome.php");

            
            
        }

       



    }

    ?>