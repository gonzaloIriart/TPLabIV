<?php 
    namespace DAO;

    use Models\Owner as Owner;
    use Models\User as User;
    use Models\Pet as Pet;
    use Models\Reserve as Reserve;
    use Models\Review as Review;
    use Helpers\ParameterHelper;
    use DAO\EventDAO;
    use DAO\PetDAO;
    use DAO\ReserveDAO;

    class ReviewDAO implements IReviewDAO 
    {
        private $eventDAO;
        private $petDAO;
        private $reserveDAO;
        
        public function __construct()
        {
            $this->eventDAO = new EventDAO;
            $this->petDAO = new PetDAO;
            $this->reserveDAO = new ReserveDAO;
        }
        
        function Add($review){
            $query = "CALL Review_Add(?, ?, ?, ?)";

            $parameters = ParameterHelper::encodeReview($review);
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

        function GetById($id){
            $query = "CALL Review_GetById(?)";
            $parameters["id"] = $id;
            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);
            $review = ParameterHelper::decodeReview($results[0]);

        }

        function GetAllByKeeperId($keeperId){
            $query = "CALL Review_GetAllByKeeperId(?)";
            $parameters["keeperId"] = $keeperId;
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);
            $reviews = array();
            foreach($results as $reviewItem){
                $review = ParameterHelper::decodeReview($reviewItem);
                $reserve = $this->reserveDAO->GetById($review->getReserve()->getReserveId());
                $review->setReserve($reserve);
                array_push($reviews, $review);
            }
            return $reviews;

        }

        function GetStarAverageByKeeperId($keeperId){
            $query = "CALL Review_GetStarsAverageByKeeperId(?)";
            $parameters["keeperId"] = $keeperId;
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);
            return $results;

        }
    }
?>