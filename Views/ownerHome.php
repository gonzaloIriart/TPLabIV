<?php 
    require_once("Views/nav.php");
?>

<h1>Escoja el rango de fechas deseado</h1>

<form action=" <?php echo FRONT_ROOT . "Keeper/ShowAvailableKeepers" ?>"> 
    <input type="text" name="daterange" value="" />
    <input type="submit" class="btn" value="Filtrar" style="background-color:#DC8E47;color:white;" />

</form>


<?php
if($availableKeepers != null){
    //aca mostrar los keepers, cada uno con un boton de reservar, se enviara al metodo create reserva la pet, las fechas indicadas en el filtro y todo loq ue falte
    echo $availableKeepers;
}
else{
    ?>
    <h2>Seleccione un rango de fechas</h2>
    <?php
}
?>

<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

<script>
$('input[name="daterange"]').daterangepicker();
</script>

