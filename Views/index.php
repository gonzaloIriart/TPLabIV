<main class="d-flex align-items-center justify-content-center height-100" >
     <div class="content">
          <header class="text-center">
               <h2>Pet Hero</h2>
          </header>

          <a href="<?php echo  FRONT_ROOT."User/RegisterView" ?>">Registarse aqui</a>

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
     </div>
</main>