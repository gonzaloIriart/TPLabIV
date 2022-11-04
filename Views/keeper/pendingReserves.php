<?php 
    require_once("Views/nav.php");
?>

<div style="max-width: 60rem;" class="container card text-center">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $reserve->getPet()->getOwner()->getUser()->getName() ?></h5>
    <p class="card-text"><?php echo $reserve->getPet()->getSize() ?></p>
    <p class="card-text">Desde: <?php echo $reserve->getEvent()->getStartDate() ?></p>
    <p class="card-text">Hasta: <?php echo $reserve->getEvent()->getEndDate() ?></p>
    <a href="#" class="btn btn-primary">Aceptar</a>
    <a href="#" class="btn btn-outline-danger">Rechazar</a>
  </div>
</div>