<?php 
    namespace Models;

    class Review
    {
        private $reviewId;
        private $date;
        private $stars;
        private $comment;
        private $reserve;

        public function getReviewId()
        {
            return $this->reviewId;
        }

        public function setReviewId($reviewId)
        {
            $this->reviewId = $reviewId;
        }

        public function getDate()
        {
            return $this->date;
        }

        public function setDate($date)
        {
            $this->date = $date;
        }

        public function getStars()
        {
            return $this->stars;
        }

        public function setStars($stars)
        {
            $this->stars = $stars;
        }

        public function getComment()
        {
            return $this->comment;
        }

        public function setComment($comment)
        {
            $this->comment = $comment;
        }

        public function getReserve()
        {
            return $this->reserve;
        }

        public function setReserve($reserve)
        {
            $this->reserve = $reserve;
        }
    }
?>