<div class="col-md-8">
  <div class="wrapper">
    <br>
    <div class="row">
      <div class="col-md-4">
        <label for="">&nbsp;</label><br>
        <h3>Elanlarım</h3>
      </div>
      <div class="col-md-4 offset-md-4">
        <div class="form-group">
          <label for="">Sırala</label>
          <select class="form-control" name="">
            <option value="">Hamısı</option>
            <option value="">Gözləyən</option>
            <option value="">Deaktiv</option>
          </select>
        </div>
      </div>
    </div>

    <hr>
    <div class="row car-info">
      <?php foreach($ad as $val){ ?>
        <div class="col-md-4">
          <div class="img" style="background-image: url('/assets/dashboard/auto/Mercedes1.png');">
            <div class="floated photo-count"> <i class="fa fa-camera" ></i> <span class="photo-count-span" >16</span> </div>
            <div class="floated watch-count"><i class="fa fa-eye" ></i> <span class="watch-count-span" >47</span></div>
            <div class="floated onhover sold"><span>Satılıb?&nbsp;</span><i class="fa fa-check"></i></div>
            <div class="floated onhover edit"><span>Redaktə et?&nbsp;</span><i class="fa fa-edit"></i></div>
            <div class="floated onhover auction"><span>Hərraca çıxart?&nbsp;</span><i class="fa fa-gavel"></i></div>
          <div class="floated onhover disable"><span>Deaktiv et?&nbsp;</span><i class="fa fa-eye-slash"></i></div>

            <div class="floated onhover remove"><i class="fa fa-trash"></i></div>
            <div class="floated onhover star"><i class="fa fa-star"></i></div>
            <div class="floated onhover compare"><i class="fa fa-tachometer"></i></div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-7">
              <div class="car-name">
                <h4><span class="car-mark">Mercedes-Benz</span>&nbsp;<span class="car-model" >C250</span>&nbsp;<span class="car-year" ><?=$val['year']?></span></h4>
              </div>
            </div>
            <div class="col-md-5">
              <div class="car-price">
                <p>42.800 USD</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 info-wrapper">
              <div class="mileage">
                <span> <i class="fa fa-road" ></i> <label for="">YÜRÜŞ</label> <p> 1200</p> </span>
              </div>
            </div>
            <div class="col-md-3 info-wrapper">
              <div class="mileage">
                <span> <i class="fa fa-cog" ></i> <label for="">YANACAQ</label> <p>Benzin</p> </span>
              </div>
            </div>
            <div class="col-md-2 info-wrapper">
              <div class="mileage">
                <span> <i class="fa fa-cogs" ></i> <label for="">MÜHƏRRİK</label> <p>2.5</p> </span>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mileage">
                <span> <i class="fa fa-cogs" ></i> <label for="">SÜRƏTLƏR QUTUSU</label> <p>Automatic</p> </span>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>

  </div>
</div>
