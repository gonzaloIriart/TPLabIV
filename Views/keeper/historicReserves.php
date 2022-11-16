<?php 
    require_once("Views/nav.php");
    ?>
    <?php if(empty($reserves)) {?>
      <h2 class="text-center mt-5">Nada por aqui...</h2>
      <?php } ?>
<?php foreach($reserves as $reserve){?>
<div style="max-width: 60rem;" class="container card text-center">
  <div class="card-body">
    <h5 class="card-title">Mascota: <?php echo $reserve->getPet()->getName() ?></h5>
    <p class="card-text">Dueño/a: <?php echo $reserve->getPet()->getOwner()->getUser()->getName() ?></p>
    <p class="card-text">Tamaño: <?php echo $reserve->getPet()->getSize() ?></p>
    <p class="card-text">Desde: <?php echo date("d/m/Y", strtotime(str_replace('-"', '/', $reserve->getEvent()->getStartDate())))?></p>
    <p class="card-text">Hasta: <?php echo date("d/m/Y", strtotime(str_replace('-"', '/', $reserve->getEvent()->getEndDate())))?></p>
    
    <?php if(sizeof($reviews) > 0) {
        foreach($reviews as $review){
          if($review->getReserve()->getReserveId() == $reserve->getReserveId()){
            ?>
            <div class="container">
        <label class="col-form-label mt-2" for="inputDefault">Reseña: </label>
        <p >
          <?php echo $review->getComment() ?>
        </p>
        <p >
          <?php echo $review->getStars()  ?><span class="fa fa-star" data-rating="1"></span>
        </p>
        
    </div>
        <?php }
    }
  } else {?>
      <p class="card-text">Sin reseña...</p>
  <?php } ?>
</div>
</div>
<?php } ?>
