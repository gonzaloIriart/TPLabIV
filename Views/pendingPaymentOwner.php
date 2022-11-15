<?php 
    require_once("Views/nav.php");
    ?>

<?php
if($message != "ok" && $message != ""){
?>
<div class="alert alert-danger">
  <a href="#" class="alert-link"><?php echo($message) ?></a>
</div>

<?php
}

if($message == "ok"){
  ?>
<div class="alert alert-success">
  <a href="#" class="alert-link">Reserva abonada con éxito</a>
</div>

<?php
}
if(!isset($payments) || empty($payments)){

  ?>
  <div style="max-width: 60rem;"  class="container card text-center mt-5 pt-2">
    <h3>No hay reservas por abonar</h3>
  </div>
  <?php
 }
 else{

 

?>  

<?php foreach($payments as $paymentItem){?>
  
<div style="max-width: 60rem;" class="container card text-center">
  <div class="card-body">
    <h5 class="card-title"><?php echo "Mascota: ".$paymentItem->getReserve()->getPet()->getname()?></h5>
    <p class="card-text"><?php echo "Cuidador: ".$paymentItem->getBankAccount()->getKeeper()->getUser()->getName() ?></p>
    <p class="card-text">Desde: <?php echo date("d/m/Y", strtotime(str_replace('-"', '/', $paymentItem->getReserve()->getEvent()->getStartDate()))) ?></p>
    <p class="card-text">Hasta: <?php echo date("d/m/Y", strtotime(str_replace('-"', '/', $paymentItem->getReserve()->getEvent()->getEndDate()))) ?></p>
    <p class="card-text">Alias: <?php echo $paymentItem->getBankAccount()->getAlias() ?></p>
    <p class="card-text">Banco: <?php echo $paymentItem->getBankAccount()->getBank() ?></p>
    <p class="card-text">CBU: <?php echo $paymentItem->getBankAccount()->getCbu() ?></p>
    <p class="card-text">Monto a pagar para confimar la Reserva: $<?php echo $paymentItem->getReserve()->getAdvancePayment() ?></p>

    <button style="width: 180px;" type="button" class="btn btn-primary btn-block btn-lg mt-2" data-bs-toggle="modal" data-bs-target="#myModal">Confirmar Reserva</button>
          

    <!-- The Modal -->
    <div class="modal" id="myModal">
      <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Inserte comprobante de pago</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div>
              <form action="<?php echo FRONT_ROOT."Payment/SetPaymentPaid" ?>" method="post" class="modal-content bg-dark-alpha p-5 bg-light" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="col-form-label mt-2" for="inputDefault">Archivo: </label>
                  <input type="file" name="paymentImage"  class="form-control" id="inputDefault" required>
                  <input type="text" name="paymentId" value="<?php echo $paymentItem->getPaymentId()?>"   style="display:none">
                  <input type="text" name="reserveId" value="<?php echo $paymentItem->getReserve()->getReserveId()?>"   style="display:none">
                </div>    

                <div class="container bg-light, mt-3">
                  <button style="width: 200px;" class="btn center" type="submit">Subir comprobante</button>
                </div>
              </form>
              <button style="width: 100px;" type="button" class="btn " data-bs-dismiss="modal">Cerrar</button>
            </div>
            

          </div>
        </div>
      </div>
    </div>
</div>
<?php }} ?>