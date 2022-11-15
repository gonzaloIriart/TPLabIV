<?php 
    require_once("Views/nav.php");
?>


<?php
if($message ?? false){
?>
<div class="alert alert-success">
  <a href="#" class="alert-link"><?php echo($message) ?></a>
</div>
<?php
}
?>

<div style="max-width: 60rem;"  class="container card text-center mt-5 pt-2">
<h1>Bienvenido Owner</h1>
  </div>


