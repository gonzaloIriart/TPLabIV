<?php 
   
   require_once("nav.php");
   
?>

<div style="max-width: 60rem;margin: 5px auto" class="container card text-center">
  <div class="card-body">
    <h2 style="margin: 5px" class="card-title"><?php echo $pet->getName() ?></h2>
    <img style="margin: 5px" src=" <?php echo $pet->getPicture() ?>"width="50%"/>
    <iframe style="margin: 5px" width="560" height="315" src="<?php echo $pet->getVideo() ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <img style="margin: 5px" src=" <?php echo $pet->getVaccinationScheduleImg() ?>"width="50%"/>
    <p style="margin: 5px" class="card-text">Descripción: <?php echo $pet->getDescription() ?></p>
  </div>
</div>


