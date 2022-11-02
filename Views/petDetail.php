<?php 
   
   require_once("nav.php");
   
?>

<div class="card mb-3">
  <h3 class="card-header"><?php echo $pet->getName() ?></h3>
  <div class="card-body">
    <h6 class="card-subtitle text-muted"><?php echo $pet->getSize() ?></h6>
  </div>

  <img src=" <?php echo $pet->getPicture() ?>"width="50%"/>
  <iframe width="560" height="315" src="<?php echo $pet->getVideo() ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  <img src=" <?php echo $pet->getVaccinationScheduleImg() ?>"width="50%"/>

  <div class="card-body">
    <p class="card-text"><?php echo $pet->getDescription() ?></p>
  </div>
  <div class="card-footer text-muted">
    2 days ago
  </div>
</div>

