<?php 
    require_once("Views/nav.php");
?>

<?php
if($message != "ok" && $message != ""){
?>
<div class="alert alert-danger">
  <a href="#" class="alert-link"><?php echo($message) ?></a>
</div>
<?php
}

?>

<div style="max-width: 60rem;margin: 5px auto" class="container card text-center">
  <div class="card-body">
    
  <form action="<?php echo FRONT_ROOT . "Pet/RegisterPet" ?>" method="post" enctype="multipart/form-data">
    <legend>Pet register</legend>
    <div class="form-group row">
      <div class="form-group">
  <label class="col-form-label mt-2" for="inputDefault">Nombre</label>
  <input type="text" name="name"  class="form-control" placeholder="" id="inputDefault" required>
  </div>  
    </div>
    <div class="form-group">
      <label for="size" class="form-label mt-2">Tamaño del perro</label>
      <select class="form-select" name="size">
        <option value="small">Pequeño (menos de 10 kg)</option>
        <option value="medium">Mediano (11 a 25 kg)</option>
        <option value="big">Grande (mas de 26 kg)</option>
      </select>
    </div>

    <div class="form-group">
  <label class="col-form-label mt-2" for="inputDefault">Imagen</label>
  <input type="file" name="picture"  class="form-control" id="inputDefault" required>
</div>
    <div class="form-group">
  <label class="col-form-label mt-2" for="inputDefault">Link del video</label>
  <input type="text" name="video"  class="form-control" placeholder="" id="inputDefault">
</div>  
    <div class="form-group">
  <label class="col-form-label mt-2" for="inputDefault">Link de la vacunacion</label>
  <input type="file" name="vaccinationScheduleImg"  class="form-control" placeholder="" id="inputDefault" required>
</div>
</div>  
  <div class="form-group">
  <label class="col-form-label mt-2" for="inputDefault">Descripcion</label>
  <textarea name="descripcion" id="" cols="30" rows="10" class="form-control"></textarea>
</div>
    <div>
    <a href="<?php echo  FRONT_ROOT."Owner/HomeView" ?>" class="btn mt-2"> Cancel </a>
        <input type="submit" class="btn mt-2 mt-2" value="Guardar" style="background-color:#DC8E47;color:white;" />
    </div>
</form>

  </div>
</div>

<div class=  >

</div>