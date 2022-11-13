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


<h1>Bienvenido Owner</h1>

