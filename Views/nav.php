<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong>Pet Hero</strong>
     </span>
     <ul class="navbar-nav ml-auto">
          <li class="mr-2">
            <?php if(isset($_SESSION["userIsKeeper"]) && $_SESSION["userIsKeeper"])
            : ?>              
                <a href="<?php echo  FRONT_ROOT."Keeper/HomeView "?>">Keeper</a>
              <?php else : ?>
               <a href="<?php echo  FRONT_ROOT."Keeper/RegisterView "?>">Register as Keeper</a>
               <?php endif; ?>
          </li>
          <li class="mr-2">     
              <?php if(isset($_SESSION["userIsOwner"]) && $_SESSION["userIsOwner"])
               : ?>                
               <a href="<?php echo  FRONT_ROOT."Owner/HomeView "?>">Owner</a>
              <?php else : ?>
               <a href="<?php echo  FRONT_ROOT."Owner/RegisterView "?>">Register as Owner</a>
               <?php endif; ?>
          
      </ul>
     </ul>
</nav>