<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong>Pet Hero</strong>
     </span>
     <ul class="navbar-nav ml-auto">
            <?php if(isset($_SESSION["userIsKeeper"]) && $_SESSION["userIsKeeper"])
            : ?>              
              <li><a href="<?php echo  FRONT_ROOT."Keeper/KeeperHomeView "?>">Keeper</a></li>
              <?php endif ; ?>
              <?php if(isset($_SESSION["userIsOwner"]) && $_SESSION["userIsOwner"])
            : ?>    
              <li><a href="<?php echo  FRONT_ROOT."Owner/OwnerHomeView "?>">Owner</a></li>
              <?php endif ; ?>
      </ul>
     </ul>
</nav>