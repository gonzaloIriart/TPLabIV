<?php 
    require_once("nav.php");
?>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">size </th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
     <?php

     foreach ($pets as $pet)
     {
     ?>
     <tr class="table-primary">
      <td><?php echo $pet->getName() ?></td>
      <td><?php echo $pet->getSize() ?></td>
      <td> <a href="<?php echo  FRONT_ROOT . "Pet/ShowPet/" .$pet->getPetId()?>" class="btn btn-outline-info">Detalles</a></td>
      </tr>
     <?php
     }
     ?>
  </tbody>
</table>