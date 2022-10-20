<form action="<?php echo FRONT_ROOT . "Keeper/Register" ?>" method="post">
    <legend>Register as Keeper</legend>
    <div class="form-group">
      <label for="size" class="form-label mt-4">Tamaño del perro</label>
      <select class="form-select" name="sizeOfDog">
        <option value="small">Pequeño (menos de 10 kg)</option>
        <option value="medium">Mediano (11 a 25 kg)</option>
        <option value="big">Grande (mas de 26 kg)</option>
      </select>
    </div>
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Daily Fee</label>
      <div class="col-sm-10">
        <input type="text" name="dailyFee" class="form-control-plaintext" value="$100">
      </div>
    </div>
    <div>
        <input type="submit" class="btn" value="Regristrarse" style="background-color:#DC8E47;color:white;" />
    </div>
</form>