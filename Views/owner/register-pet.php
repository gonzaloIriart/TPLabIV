<?php 
    require_once("Views/nav.php");
?>

<div class= "form-box" >
<form action="<?php echo FRONT_ROOT . "Pet/RegisterPet" ?>" method="post">
    <legend>Pet register</legend>
    <div class="form-group row">
      <div class="form-group">
  <label class="col-form-label mt-4" for="inputDefault">Nombre</label>
  <input type="text" name="name"  class="form-control" placeholder="" id="inputDefault">
  </div>  
    </div>
    <div class="form-group">
      <label for="size" class="form-label mt-4">Tamaño del perro</label>
      <select class="form-select" name="size">
        <option value="small">Pequeño (menos de 10 kg)</option>
        <option value="medium">Mediano (11 a 25 kg)</option>
        <option value="big">Grande (mas de 26 kg)</option>
      </select>
    </div>

    <div class="form-group">
  <label class="col-form-label mt-4" for="inputDefault">Link de la imagen</label>
  <input type="text" name="picture"  class="form-control" placeholder="" id="inputDefault">
</div>
    <div class="form-group">
  <label class="col-form-label mt-4" for="inputDefault">Link del video</label>
  <input type="text" name="video"  class="form-control" placeholder="" id="inputDefault">
</div>  
    <div class="form-group">
  <label class="col-form-label mt-4" for="inputDefault">Link de la vacunacion</label>
  <input type="text" name="vaccinationScheduleImg"  class="form-control" placeholder="" id="inputDefault">
</div>
    <div>
        <input type="submit" class="btn" value="Guardar" style="background-color:#DC8E47;color:white;" />
    </div>
</form>
</div>