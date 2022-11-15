<?php
require_once("Views/nav.php");
?>
    <?php if(sizeof($reviews) <= 0) {?>
      <h2 class="text-center mt-5">Nada por aqui...</h2>
      <?php } ?>
<?php foreach ($reviews as $review) { ?>
    <div style="max-width: 60rem;" class="container card text-center">
        <div class="card-body">
            <label class="card-title">Reseña de Mascota: <?php echo $review->getReserve()->getPet()->getName() ?></label>
            <label class="card-text"> de <?php echo $review->getReserve()->getPet()->getOwner()->getUser()->getName() ?></label>
            <p class="card-text">
                Desde: <?php echo date("Y/m/d", strtotime(str_replace('-"', '/', $review->getReserve()->getEvent()->getStartDate())))?>
            </p >
            <p class="card-text">
                Hasta: <?php echo date("Y/m/d", strtotime(str_replace('-"', '/', $review->getReserve()->getEvent()->getEndDate())))?>
            </p>
            <p class="card-text">
                <?php echo $review->getComment() ?>
            </p>
            <p class="card-text">
                <?php echo $review->getStars()  ?><span class="fa fa-star" data-rating="1"></span>
            </p>

        </div>
    </div>
<?php } ?>

<script>
    function formatDate(date) {
        let year = date.slice(0,4);
        let month = date.slice(5,7);
        let day = date.slice(8,10);
        return `${day}/${month}/${year}`;
    }
</script>