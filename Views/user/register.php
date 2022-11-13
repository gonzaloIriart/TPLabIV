
<?php
if($message ?? false){
?>
<div class="alert alert-danger">
  <a href="#" class="alert-link"><?php echo($message) ?></a>
</div>
<?php
}
?>

<div style="max-width: 60rem;margin: 5px auto" class="container card text-center">
  <div class="card-body">
<h2>User Register</h2>
<form action="<?php echo FRONT_ROOT . "User/Register" ?>" method="post" style="background-color: #EAEDED;padding: 2rem !important;">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Nombre" name="name" aria-label="Username" aria-describedby="basic-addon1" required>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="email" name="email" aria-label="Username" aria-describedby="basic-addon1" required>
    </div>
    <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="password" name="password" aria-label="Username" aria-describedby="basic-addon1" required>
    </div>

    
    <div class="form-check form-check-inline">
        <input type="radio" class="" id="radio1" name="role" value="o" checked onclick="ShowHideKeeper(radio2)">Owner
        <label class="form-check-label" for="radio1"></label>
    </div>
    <div class="form-check form-check-inline">
        <input type="radio" class="" id="radio2" name="role" value="k" onclick="ShowHideKeeper(this)">Keeper
        <label class="form-check-label" for="radio2"></label>
    </div>


    <div id="keeperRegister" style="display: none">
        <div class="form-group">
            <label for="size" class="form-label mt-4">Tamaño del perro</label>
            <select class="form-select" value="" name="sizeOfDog">
                <option value="small">Pequeño (menos de 10 kg)</option>
                <option value="medium">Mediano (11 a 25 kg)</option>
                <option value="big">Grande (mas de 26 kg)</option>
            </select>
        </div>
        <div class="form-group row mt-4">
            <label for="name" class="col-sm-2 col-form-label">Daily Fee</label>
            <div class="col-sm-10">
                <input type="number" name="dailyFee" class="form-control" value="0">
            </div>
        </div>
    </div>

    <div>
    <label for="secretQuestion" class="form-label mt-4">Seleccione una pregunta secreta</label>
        <select class="form-select" value="" name="secretQuestion">
            <option value="1">¿Cuál es el nombre de su primera mascota?</option>
            <option value="2">¿Cómo se llamaba su colegio primario?</option>
            <option value="3">¿Cuál es el apellido de soltera de su madre?</option>
        </select>
    <div class="form-group row mt-4">
        <label for="answer" class="col-sm-2 col-form-label">Respuesta</label>
        <div class="col-sm-10">
            <input type="text" name="answer" class="form-control" value="" required>
        </div>
    </div>


    <div>
        <a href="<?php echo  FRONT_ROOT."Home/Index" ?>" class="btn mt-2"> Cancel </a>
        <input type="submit" class="btn mt-2" value="Registrarse" style="background-color:#DC8E47;color:white;" />
    </div>


</form>

</div>
</div>

<script type="text/javascript">
        function ShowHideKeeper(role) {
            const keeperRegister = document.getElementById('keeperRegister');
            let rolecheck = document.getElementById("role");
            keeperRegister.style.display = role.checked ? "block" : "none";
            rolecheck.value = role.checked ? "k" : "o";
    }
</script>