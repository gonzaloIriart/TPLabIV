<?php 
    require_once("Views/nav.php");
    ?>

<?php foreach($reserves as $reserve){?>
<div style="max-width: 60rem;" class="container card text-center">
  <div class="card-body">
    <h5 class="card-title"><?php echo $reserve->getPet()->getName() ?></h5>
    <p class="card-text"><?php echo $reserve->getPet()->getSize() ?></p>
    <p class="card-text">Desde: <?php echo $reserve->getEvent()->getStartDate() ?></p>
    <p class="card-text">Hasta: <?php echo $reserve->getEvent()->getEndDate() ?></p>
    <a href="<?php echo(FRONT_ROOT . "/Keeper/UpdateEventState/" . $reserve->getEvent()->getEventId()."/" ."reserved"); ?>" class="btn btn-primary">Aceptar</a>
    <a href="<?php echo(FRONT_ROOT . "/Keeper/DeleteReserve/" . $reserve->getReserveId() ); ?>" class="btn btn-outline-danger">Rechazar</a>
  </div>
</div>
<?php } ?>