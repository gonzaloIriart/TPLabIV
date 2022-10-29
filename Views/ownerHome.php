<?php 
    require_once("Views/nav.php");
?>

<main class="d-flex justify-content-center" >
     <div class="jumbotron">
          <header class="text-center">
               <h2>Welcome <?php echo $_SESSION["loggedUser"]->getName() ?> to Pet Hero</h2>
               <h3>Owner Home</h3>
          </header>
          <?php
               var_dump($_SESSION["owner"]);
               ?>
          
     </div>
</main>