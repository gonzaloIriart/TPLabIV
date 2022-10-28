<h2>User Register</h2>
<form action="<?php echo FRONT_ROOT . "User/Register" ?>" method="post" style="background-color: #EAEDED;padding: 2rem !important;">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Nombre" name="name" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="email" name="email" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="password" name="password" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <input type="checkbox" name="role" onclick="ShowHideKeeper(this)" id="role"><label class="ml-2">Register as keeper?</label>
    
    <div id="keeperRegister" style="display: none">
        <div class="form-group">
            <label for="size" class="form-label mt-4">Tamaño del perro</label>
            <select class="form-select" value="" name="sizeOfDog">
                <option value="small">Pequeño (menos de 10 kg)</option>
                <option value="medium">Mediano (11 a 25 kg)</option>
                <option value="big">Grande (mas de 26 kg)</option>
            </select>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Daily Fee</label>
            <div class="col-sm-10">
                <input type="number" name="dailyFee" class="form-control-plaintext" value="0">
            </div>
        </div>
    </div>

    <div>
        <input type="submit" class="btn" value="Regristrarse" style="background-color:#DC8E47;color:white;" />
    </div>
</form>

<script type="text/javascript">
        function ShowHideKeeper(role) {
            const keeperRegister = document.getElementById('keeperRegister');
            let rolecheck = document.getElementById("role");
            keeperRegister.style.display = role.checked ? "block" : "none";
            rolecheck.value = role.checked ? "k" : "o";
    }
</script>