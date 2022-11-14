<?php
    namespace Controllers;

    use DAO\ReviewDAO as ReviewDAO;
    use Helpers\SessionHelper as SessionHelper;
    use Models\Review as Review;
    use Models\Reserve as Reserve;

    class ReviewController
    {
      
        private $ReviewDAO;


        public function __construct()
        {
            $this->ReviewDAO = new ReviewDAO();
        }

        public function RegisterReview($comment, $stars, $reserveId)
        {
            var_dump($_POST);
            $date = date("Y-m-d");
            var_dump($date);
            $review = new Review();
            $review->setComment($comment);
            $review->setDate($date);
            $review->setStars($stars);
            $reserve = new Reserve();
            $reserve->setReserveId($reserveId);
            $review->setReserve($reserve);
            $this->ReviewDAO->Add($review);
            $message = "Review realizada con exito.";
            header("Location: ".FRONT_ROOT."Owner/WriteReviews");
            
        } 



    }
?>