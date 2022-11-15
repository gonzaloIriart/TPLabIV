<?php 
    namespace DAO;

    use Models\Owner as Owner;
    use Models\User as User;
    use Models\Pet as Pet;
    use DAO\OwnerDAO as OwnerDAO;
    use Helpers\ParameterHelper;

    class PetDAO implements IPetDAO 
    {
        private $ownerDAO;

        public function __construct()
        {
            $this->ownerDAO = new OwnerDAO;
        }

        private $petList = array();

        function Add($pet){            


            $query = "CALL Pet_Add(?, ?, ?, ?, ?, ?, ?)";

            $parameters = ParameterHelper::encodePet($pet);

            $this->connection = Connection::GetInstance();


            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);

        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->petList;
        }

        public function GetById($id)
        {

            $query = "CALL Pet_GetById(?)";

            $this->connection = Connection::GetInstance();
            
            $parameters["Id"] = $id;

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach($results as $pet)
            {
               $pet = ParameterHelper::decodePet($pet);
               $owner = $this->ownerDAO->GetById($pet->getOwner()->GetOwnerId());
               $pet->setOwner($owner);
            }
            
            return $pet;

        }

        function GetListByOwner($ownerId){

            $query = "CALL Pet_GetByOwnerId(?)";

            $this->connection = Connection::GetInstance();
            
            $parameters["OwnerId"] = $ownerId;

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            $pets = array();
            foreach($results as $pet)
            {
               array_push($pets, ParameterHelper::decodePet($pet));
            }

            return $pets;
        }

    }

?>