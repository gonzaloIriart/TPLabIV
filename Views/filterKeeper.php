<?php 
    require_once("Views/nav.php");
?>

<?php if(empty($petList)) {?>
      <h2 class="text-center mt-5">Debe ingresar al menos una mascota para continuar.</h2>
<?php }else{ ?>

<div style="max-width: 60rem;margin: 5px auto" class="container card text-center">
  <div class="card-body">
  <h1>Escoja el rango de fechas deseado</h1>

<form action=" <?php echo FRONT_ROOT . "Keeper/ShowAvailableKeepers" ?>" method="post"> 
    <input type="text" name="daterange" class="form-control" value="" />
    
    <div>
    <label for="petId" class="">Seleccione la mascota</label>
      <select class="form-select" name="petId" required>
      <?php
        foreach ($petList as $pet)
        {
        ?>
        <option value="<?php echo($pet->GetPetId())?>"><?php echo($pet->GetName())?></option>
        <?php
        }
        ?>
      </select>
    </div>

    <input type="submit" class="btn" value="Filtrar" style="background-color:#DC8E47;color:white;" />

</form>

  </div>
</div>

<?php
}
if(!empty($availableKeepers)){
  $flag =1;
?>

<div style="max-width: 60rem;margin: 5px auto" class="container card text-center">
  <div class="card-body">
  <div>
<table class="table table-hover ">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Precio por día</th>
      <th scope="col">Precio Total</th>
      <th scope="col">Reputación</th>
      <th scope="col"></th>

    </tr>
  </thead>
  <tbody>
     <?php

     foreach ($availableKeepers as $keeper)
     {
     ?>
     <tr class="table-primary">
      <td><?php echo $keeper->getUser()->getName() ?></td>
      <td><?php echo "$".$keeper->getDailyFee() ?></td>
      <td><?php echo "$".(intval($keeper->getDailyFee())*$dayDiff) ?></td>
      <td><?php if(round($keeper->getStarsAverage(),2)>0){echo round($keeper->getStarsAverage(),2); }else{echo "Sin reseñas";}; ?><span class="star-rating"> <span class="fa fa-star" data-rating="1"></span></span></td>
      <td>
        
      <form action="<?php echo  FRONT_ROOT . "Reserve/CreateReserve/"?>" method="post">

        <input type="text" name="keeperId" value="<?php echo($keeper->getKeeperId()) ?>" style="display:none;background-color:#DC8E47;color:white;" />
        <input type="text" name="petId" value="<?php echo($petId) ?>" style="display:none;background-color:#DC8E47;color:white;" />
        <input type="text" name="dates" value="<?php echo($dates[0]." ".$dates[1]) ?>" style="display:none;background-color:#DC8E47;color:white;" />
        <input type="text" name="totalPrice" value="<?php echo(intval($keeper->getDailyFee())*$dayDiff) ?>" style="display:none;background-color:#DC8E47;color:white;" />
        
        <button  type="button" class="btn" style="width:150px" data-bs-toggle="modal" data-bs-target="#myModal">Ver Reviews</button>
        <div class="modal" id="myModal">
          <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title center">Reseñas</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                    <?php
                    if(!empty($keeper->getReviewsList())){
                      foreach($keeper->getReviewsList() as $review){
                        ?>
                        <div style="max-width: 60rem;" class="container card text-center">
                        <div class="card-body">
                        <p class="card-text"><?php echo date("Y/m/d", strtotime(str_replace('-"', '/', $review->getDate()))) ?></p>
                        <p class="card-text"><?php echo $review->getStars() ?> <span class="star-rating"> <span class="fa fa-star" data-rating="1"></span></span></p>
                        <p class="card-text"><?php echo $review->getComment() ?></p>
                        </div>
                        </div>
                        <?php
                        }}
                      else{
                        echo("No hay reseñas.");}
                        ?>

                </div>
              </div>
            </div>
          </div>
        </div>

        <input type="submit" class="btn" value="Reservar" style="background-color:#DC8E47;color:white;" />
      </form></td>
      </tr>
     <?php
     }
     ?>
  </tbody>
</table>
</div>

  </div>
</div>
  
<?php
}

else{
  if($flag ?? 1 != 1){
    ?>

<div style="max-width: 60rem;margin: 5px auto" class="container card text-center">
  <div class="card-body">
  <h2 >Seleccione un nuevo rango de fechas</h2>

  </div>
</div>

    <?php
}}
?>


<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

<script>
$('input[name="daterange"]').daterangepicker({
    locale: {
      format: 'DD-MM-YYYY'
    }
});
</script>

