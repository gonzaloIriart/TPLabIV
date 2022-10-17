<form action="<?php echo FRONT_ROOT . "Pet/Register" ?>" method="post">
  <fieldset>
    <legend>Pet register</legend>
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Nombre</label>
      <div class="col-sm-10">
        <input type="text" name="name" class="form-control-plaintext" value="Firulais">
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
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Link de foto</label>
      <div class="col-sm-10">
        <input type="text" name="picture" class="form-control-plaintext" value="www.ejemplo.com">
      </div>
    </div>
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Link de video</label>
      <div class="col-sm-10">
        <input type="text" name="video" class="form-control-plaintext" value="www.ejemplo.com">
      </div>
    </div>
    <div class="form-group">
      <label for="vaccinationSchedule" class="form-label mt-4">Esquema de vacunacion</label>
      <select class="form-select" name="vaccinationSchedule">
        <option value="incomplete">Incompleto</option>
        <option value="complete">Completo</option>
      </select>
    </div>
  </fieldset>
</form>