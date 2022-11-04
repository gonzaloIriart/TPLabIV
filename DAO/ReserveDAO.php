<?php 
    namespace DAO;

    use Models\Owner as Owner;
    use Models\User as User;
    use Models\Pet as Pet;
    use Models\Reserve as Reserve;
    use Helpers\ParameterHelper;

    class ReserveDAO implements IReserveDAO 
    {
        private $petList = array();

        function Add($pet){            


            $query = "CALL Reserve_Add(?, ?, ?, ?)";

            $parameters = ParameterHelper::encodeReserve($reserve);

            $this->connection = Connection::GetInstance();


            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);

        }

        public function GetById($id)
        {

            $query = "CALL Reserve_GetById(?)";

            $this->connection = Connection::GetInstance();
            
            $parameters["Id"] = $id;

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach($results as $pet)
            {
               $reserve = ParameterHelper::decodePet($reserve);
            }
            
            return $reserve;

        }

    
    }

?>