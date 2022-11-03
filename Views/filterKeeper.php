<?php 
    require_once("Views/nav.php");
?>

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

<?php


if(!empty($availableKeepers)){
?>

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
      <td> <a href="<?php echo  FRONT_ROOT . "Reserve/CreateReserve/" .$keeper->getKeeperId() ."/". $petId ?>" class="btn btn-outline-info">Reservar</a></td>
      </tr>
     <?php
     }
     ?>
  </tbody>
</table>
</div>
  
<?php
}

else{
    ?>
    <h2>Seleccione un nuevo rango de fechas</h2>
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

