
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
        <h2>Recuperar contraseña</h2>
        <form action="<?php echo FRONT_ROOT . "User/VerifyAnswerUpdatePassword" ?>" method="post" style="background-color: #EAEDED;padding: 2rem !important;">
            <input type="text" name="id" value="<?php echo($user->getUserId())?>" style="display: none">
            <label for="answer" class="form-label mt-4">
                <?php
                if($user->getSecretQuestion() == "1"){
                    echo("¿Cuál es el nomnre de su primera mascota?");
                }
                elseif($user->getSecretQuestion()== "2"){
                    echo("¿Cómo se llamaba su colegio primario?");
                }
                else{
                    echo("¿Cuál es el apellido de soltera de su madre?");
                }
                ?>
            </label>
            <div class="">
                <input type="text" name="answer" class="form-control mt-2" value="" required>
            </div>
            <label for="answer" class="form-label mt-4">Nueva contraseña</label>
            <div class="">
                <input type="text" name="newPassword" class="form-control mt-2" value="" required>
            </div>
            <div>
                <a href="<?php echo  FRONT_ROOT."Home/Index" ?>" class="btn mt-2"> Cancel </a>
                <input type="submit" class="btn mt-2" value="Cambiar contraseña" style="background-color:#DC8E47;color:white;" />
            </div>
        
        </form>
    </div>

</div>


   



</div>
</div>

