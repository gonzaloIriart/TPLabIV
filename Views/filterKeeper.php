<?php 
    require_once("Views/nav.php");
?>

<div style="max-width: 60rem;margin: 5px auto" class="container card text-center">
  <div class="card-body">
  <h1>Escoja el rango de fechas deseado</h1>

<form action=" <?php echo FRONT_ROOT . "Keeper/ShowAvailableKeepers" ?>"> 
    <input type="text" name="daterange" value="" />
    
    <div>
    <label for="petId" class="">Seleccione la mascota</label>
      <select class="form-select" name="petId">
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

if(!empty($availableKeepers)){
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
      <td><?php echo $keeper->getDailyFee() ?></td>
      <td><?php echo (intval($keeper->getDailyFee())*4) ?></td>
      <td>
        
      <form action="<?php echo  FRONT_ROOT . "Reserve/CreateReserve/"?>" method="post">

        <input type="text" name="keeperId" value="<?php echo($keeper->getKeeperId()) ?>" style="display:none;background-color:#DC8E47;color:white;" />
        <input type="text" name="petId" value="<?php echo($petId) ?>" style="display:none;background-color:#DC8E47;color:white;" />
        <input type="text" name="dates" value="<?php echo($dates[0]." ".$dates[1]) ?>" style="display:none;background-color:#DC8E47;color:white;" />
        <input type="text" name="totalFee" value="<?php echo(intval($keeper->getDailyFee())*4) ?>" style="display:none;background-color:#DC8E47;color:white;" />

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
    ?>

<div style="max-width: 60rem;margin: 5px auto" class="container card text-center">
  <div class="card-body">
  <h2 >Seleccione un nuevo rango de fechas</h2>

  </div>
</div>

    <?php
}
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

