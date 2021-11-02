<div class="right_content">
  <div class="wrapper">
  <?php if($authorFavouriteCars){ ?>
    <br>
    <div class="row">
      <div class="col-md-4">
        <label for="">&nbsp;</label><br>
        <h3>Seçilmişlər</h3>
      </div>
      <!-- <div class="col-md-4 offset-md-4">
        <div class="form-group">
          <label for="">Sırala</label>
          <select class="form-control" name="">
            <option value="">Hamısı</option>
            <option value="">Gözləyən</option>
            <option value="">Deaktiv</option>
          </select>
        </div>
      </div> -->
    </div>

    <hr>
    <div class="row car-info">
      <?php foreach($authorFavouriteCars as $val){ ?>
        <div class="col-md-4 <?=($val['status']==2 || $val['status']==3)?'sold-car':''?> ">
          <div class="img" style="background-image: url('/assets/img/car_photos/800xauto/<?=$val['image']?>');">
            <div class="floated photo-count"> <i class="fa fa-camera" ></i> <span class="photo-count-span" ><?=$val['photocount']?></span> </div>

            <div class="floated onhover <?=($val['favourite']==1)?'myfavourite':'nofavourite'?> star" data-fav=<?=$val['favourite'];?> data-id=<?=$val['id']?>> <a href="#"> <i class="fa fa-star"></i></a></div>
            <div class="floated onhover edit"> <a href="/dashboard/editCar?id=<?=$val['id']?>"> <span>Redaktə et?&nbsp;</span><i class="fa fa-edit"></i></a></div>
            <!-- <div class="floated onhover auction"><span>Hərraca çıxart?&nbsp;</span><i class="fa fa-gavel"></i></div> -->
            <!-- <div class="floated onhover compare"><i class="fa fa-tachometer"></i></div> -->
          </div>
          <hr class="mobile_none_hr">
        </div>
        <div class="col-md-8 <?=($val['status']==2)?'sold-car':''?> ">
          <div class="row">
            <div class="col-md-7">
              <div class="car-name">
                <h4><span class="car-mark" ><?=$val['markname']?></span>&nbsp;<span class="car-model" ><?=$val['modelname']?></span>&nbsp;<span class="car-year" ><?=$val['year']?></span></h4>
              </div>
            </div>
            <div class="col-md-5">
              <div class="car-price">
                <p><?=$val['price']?> <?php if($val['currency']==0){echo "AZN";}elseif($val['currency']==1){echo "USD";}else{echo "EUR";}?></p>
              </div>
            </div>
          </div>
          <div class="row bottom_line">
            <div class="col-md-2 info-wrapper">
              <div class="mileage">
                <span> <i class="fa fa-road" ></i> <label for="">YÜRÜŞ</label> <p> <?=$val['mileage']?></p> </span>
              </div>
            </div>
            <div class="col-md-3 info-wrapper">
              <div class="mileage">
                <span> <i class="fa fa-cog" ></i> <label for="">YANACAQ</label> <p><?=$val['fuel']?></p> </span>
              </div>
            </div>
            <div class="col-md-3 info-wrapper">
              <div class="mileage">
                <span> <i class="fa fa-cogs" ></i> <label for="">MÜHƏRRİK</label> <p><?=$val['engine']?></p> </span>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mileage">
                <span> <i class="fa fa-cogs" ></i> <label for="">SÜRƏTLƏR QUTUSU</label> <p><?=$val['transmission']?></p> </span>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php }else{ ?>
    <h3 style="padding:50px;" ><b>Siz hələ favoritlər əlavə etməmisiniz.</b></h3>
  <?php } ?>
  </div>
</div>

<input id="token" type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">

<style>
  .infavourites{
    display: block;
  }
</style>

<script type="text/javascript">

var token = $('#token').val();

$(".star").click(function(e){
  e.preventDefault();
  var id = $(this).data('id');
  var fav = $(this).data('fav');
  $.ajax({
      url: '/dashboard/makeFavourite',
      type: 'post',
      data: {id: id, fav: fav, otomoto: token},
      success: function (response) {
         if (response == 0) {
           $(".star").removeClass('myfavourite');
           $(".star").addClass('nofavourite');
           $('.star').data('fav', 0);
         } else {
           $(".star").removeClass('nofavourite');
           $(".star").addClass('myfavourite');
           $('.star').data('fav', 1);
         }
      }
  });
})
</script>
