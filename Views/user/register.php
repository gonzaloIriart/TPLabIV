<h2>User Register</h2>
<form action="<?php echo FRONT_ROOT . "User/Register" ?>" method="post" style="background-color: #EAEDED;padding: 2rem !important;">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Nombre" name="name" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Nombre" name="email" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="Nombre" name="password" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div>
        <input type="submit" class="btn" value="Regristrarse" style="background-color:#DC8E47;color:white;" />
    </div>
</form>