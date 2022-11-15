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

if(!isset($pendingReviews) || empty($pendingReviews)){

  ?>
  <div style="max-width: 60rem;"  class="container card text-center mt-5 pt-2">
    <h3>No Hay reseñas por subir</h3>
  </div>
  <?php
 }

?>

<?php
if($pendingReviews ?? false){
foreach($pendingReviews as $pendingReview){?>
  
<div style="max-width: 60rem;" class="container card text-center">
  <div class="card-body">
    <h5 class="card-title"><?php echo "Mascota cuidada: ".$pendingReview->getPet()->getname()?></h5>
    <p class="card-text">Desde: <?php echo $pendingReview->getEvent()->getStartDate() ?></p>
    <p class="card-text">Hasta: <?php echo $pendingReview->getEvent()->getEndDate() ?></p>
    <p class="card-text">Monto pagado: $<?php echo $pendingReview->getTotalFee() ?></p>

    <button style="width: 230px;" type="button" class="btn btn-primary btn-block btn-lg mt-2" data-bs-toggle="modal" data-bs-target="#myModal">Escribir Reseña</button>
          

    <!-- The Modal -->
    <div class="modal" id="myModal">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Escriba su reseña</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div>
              <form action="<?php echo FRONT_ROOT."Review/RegisterReview" ?>" method="post" class="modal-content bg-dark-alpha p-2 bg-light" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="col-form-label mt-2" for="inputDefault">Reseña: </label>
                  <textarea name="coments" id="" cols="30" rows="10" class="form-control"></textarea>

                  <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="star-rating">
                          <span class="fa fa-star-o" data-rating="1"></span>
                          <span class="fa fa-star-o" data-rating="2"></span>
                          <span class="fa fa-star-o" data-rating="3"></span>
                          <span class="fa fa-star-o" data-rating="4"></span>
                          <span class="fa fa-star-o" data-rating="5"></span>
                          <input type="hidden" name="stars" class="rating-value" value="1">
                        </div>
                      </div>
                    </div>
                  </div>

                  <input type="text" name="reserveId" value="<?php echo $pendingReview->getReserveId()?>"   style="display:none">
                </div>    

                <div class="container bg-light, mt-3">
                  <button style="width: 200px;" class="btn center" type="submit">Enviar reseña</button>
                </div>
              </form>
  
            

          </div>
        </div>
      </div>
    </div>
</div>
<?php }} ?>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script >

var $star_rating = $('.star-rating .fa');

var SetRatingStar = function() {
  return $star_rating.each(function() {
    if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
      return $(this).removeClass('fa-star-o').addClass('fa-star');
    } else {
      return $(this).removeClass('fa-star').addClass('fa-star-o');
    }
  });
};

$star_rating.on('click', function() {
  $star_rating.siblings('input.rating-value').val($(this).data('rating'));
  return SetRatingStar();
});

SetRatingStar();
$(document).ready(function() {

});

</script>
