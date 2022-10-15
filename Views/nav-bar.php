<div class="wrapper row1">
  <header id="header" class="clear"> 
    <div id="logo" class="fl_left">
      <h1>Pet Hero</h1>
    </div>
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class="active"><a class="drop" href="#">Actions</a>
          <ul>
            <?php if(isset($_SESSION["userIsKeeper"]) && $_SESSION["userIsKeeper"])
            : ?>              
              <li><a href="<?php echo  FRONT_ROOT."Keeper/KeeperHomeView "?>">Keeper</a></li>
              <?php endif ; ?>
              <?php if(isset($_SESSION["userIsOwner"]) && $_SESSION["userIsOwner"])
            : ?>    
              <li><a href="<?php echo  FRONT_ROOT."Owner/OwnerHomeView "?>">Owner</a></li>
              <?php endif ; ?>
      </ul>
    </nav>
  </header>
</div>