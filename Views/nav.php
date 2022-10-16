<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong>Pet Hero</strong>
     </span>
     <ul class="navbar-nav ml-auto">
          <li class="mr-2">
            <?php if(isset($_SESSION["loginUser"]) && $this->userDAO->isKeeper($_SESSION["loginUser"]))
            : ?>              
                <a href="<?php echo  FRONT_ROOT."Keeper/HomeView "?>">Keeper</a>
              <?php else : ?>
               <a href="<?php echo  FRONT_ROOT."Keeper/RegisterView "?>">Register as Keeper</a>
               <?php endif; ?>
          </li>
          <li class="mr-2">     
              <?php if(isset($_SESSION["loginUser"]) && $this->userDAO->isOwner($_SESSION["loginUser"]))
               : ?>                
               <a href="<?php echo  FRONT_ROOT."Owner/HomeView "?>">Owner</a>
              <?php else : ?>
               <a href="<?php echo  FRONT_ROOT."Owner/RegisterView "?>">Register as Owner</a>
               <?php endif; ?>
          
      </ul>
     </ul>
</nav>