
<?php
if($message ?? false){
?>
<div class="alert alert-danger">
  <a href="#" class="alert-link"><?php echo($message) ?></a>
</div>
<?php
}
?>

<main class="d-flex align-items-center justify-content-center height-100" >
     <div class="content">
          <header class="text-center">
               <h2>Pet Hero</h2>
          </header>


          <form action="<?php echo FRONT_ROOT."Home/Login" ?>" method="post" class="login-form bg-dark-alpha p-5 bg-light">
               <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control form-control-lg" placeholder="Ingresar usuario" required>
               </div>
               <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
               </div>

         
               <button style="width: 200px;" class="btn btn-primary btn-block btn-lg mt-2 " type="submit">Iniciar Sesión</button>

              
    

          </form>
          <div class="text-center">
               <a href="<?php echo  FRONT_ROOT."User/RegisterView" ?>">Registarse aqui</a>
               <span> | </span>
               <a href="#" class="mt-2" data-bs-toggle="modal" data-bs-target="#myModal">Olvidé mi contraseña</a>
               </div>


               <div class="modal" id="myModal">
               <div class="modal-dialog modal-md">
               <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Recuperar contraseña</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="<?php echo FRONT_ROOT."User/UpdatePassword" ?>" method="post" class="modal-content bg-dark-alpha p-5 bg-light ">

                    <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control form-control-lg" placeholder="Email" required>
                    </div>

                    <button style="width: 180px;" class="btn btn-primary btn-block btn-lg mt-2 " type="submit">Cambiar Contraseña</button>

                    </form>

               </div>
               </div>
          

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</main>