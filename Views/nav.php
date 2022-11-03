<?php
require_once('validate-session.php');
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
     <div class="container-fluid">
          <?php if (isset($_SESSION["keeper"])) : ?>
               <a class="navbar-brand" href="<?php echo  FRONT_ROOT . "Keeper/HomeView " ?>"><strong>Pet Hero</strong></a>
          <?php else : ?>
               <a class="navbar-brand" href="<?php echo  FRONT_ROOT . "Owner/HomeView " ?>"><strong>Pet Hero</strong></a>
          <?php endif; ?>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarColor01">
               <ul class="navbar-nav me-auto">
                    <?php if (isset($_SESSION["keeper"])) : ?>
                         <li class="nav-item">
                              <a class="nav-link" href="<?php echo  FRONT_ROOT . "Keeper/HomeView " ?>">Keeper</a>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link" href="<?php echo  FRONT_ROOT . "Keeper/ShowPendingReserves " ?>">Pending reserves</a>
                         </li>

                    <?php else : ?>
                         <li class="nav-item">
                              <a class="nav-link" href="<?php echo  FRONT_ROOT . "Owner/RegisterPetView " ?>">Add Pet</a>
                         </li>

                         <li class="nav-item">
                              <a class="nav-link" href="<?php echo  FRONT_ROOT . "Pet/ShowPets" ?>">Show Pets</a>
                         </li>
                    <?php endif; ?>



                    <!--
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
          </div>
        </li>
      
          -->
               </ul>
          </div>
     </div>
</nav>