<div class="right_content">
<div class="my_main_wrapper">
    <div class="row">
      <div class="col-md-12">
        <button class="btn btn-success" type="button" name="button" data-toggle="modal" data-target="#myModal">BALANSI ARTIR</button>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-4 col-md-4">
        <div class="balans-wrapper">
          <h5>Balans</h5>
          <div class="i-wrap">
            <i class="fa fa-credit-card" ></i>
          </div>
          <div class="balans-wrap">
            <p class="balans" ><?=@$balans[0]['plus']-(@$balans[0]['minus']+@$balans[0]['ads']);?> ₼</p>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="col-sm-4 col-md-4">
        <div class="ads">
          <h5>Deaktiv</h5>
          <div class="i-wrap">
            <i class="fa fa-bullhorn"></i>
          </div>
          <div class="balans-wrap">
            <p class="balans" ><?=@$nonActiveAds[0]['nonActiveAds'];?> </p>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="col-sm-4 col-md-4">
        <div class="stat">
          <h5>Aktiv</h5>
          <div class="i-wrap">
            <i class="fa fa-bar-chart-o"></i>
          </div>
          <div class="balans-wrap">
            <p class="balans" ><?=@$activeAds[0]['activeAds'];?> </p>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <br>
    <div class="for_paket">
      <div class="paket">
        <span class="paket_name">AVTOSALON</span>
        <span class="paket_cont">Elan sayı 100</span>
        <span class="paket_cont"> 50 AZN</span>
        <a href="tel:050-230-10-60" class="paket_cont" style="font-weight: 400; margin-bottom: 15px">
          <i class="fa fa-phone" aria-hidden="true"></i>
          050-230-10-60
        </a>
        <br>
        <div class="text-center" >
          <?php //if(!@$pendingPaket['id']){ ?>
          <button type="button"  data-toggle="modal" data-target="#myModal2" class="btn btn-success" name="button">AVTOSALON</button>
        <?php //}else{ ?>
          <!-- <button type="button" class="btn btn-success" name="button">GOLD PAKET TƏSDİQLƏMƏDƏDİ</button> -->
        <?php //} ?>
        </div>
      </div>
    </div>
    <br>
    <div class="statistics_table_div">
      <table class="statistics_table">
        <thead>
          <th>Tarix</th>
          <th>Məbləğ</th>
          <th>Elanın pinkodu</th>
          <th>Əməliyyat</th>
        </thead>
        <tbody>
          <?php foreach($adsInfo as $val){ ?>
          <tr>
            <td><?=$val['createdate'];?></td>
            <td><i class="fa fa-arrow-up" ></i>
              <?=($val['action']==4 && $val['salon']==0)?'-':$val['amount']; ?> ₼</td>
            <td><?=$val['pincode']?$val['pincode']:'-'; ?></td>
            <td><?=$val['actions']; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- The Modal -->
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Balansı artır</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="/payment/do_payment" >
            <!-- Modal body -->
            <div class="modal-body">
                <div class="col-md-12">
                  <div class="form-group">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
                    <input type="hidden" name="lang" value="lv">
                    <input type="hidden" name="carad_id" value="0">
                    <input type="hidden" name="action" value="3">
                    <input class="form-control" required placeholder="1.00" type="number" min="1" step="1" name="amount" value="">
                  </div>
                </div>
                <div class="col-md-12">
                  <br>
                  <h5 >Ödəniş növünü seçin:</h5>
                  <div class="form-group">
                    <input type="radio" checked id="bank" name="paymentType" value="1">
                    <label for="bank">Bank kartı</label>
                  </div>
                </div>
                <!-- <div class="col-md-12">
                  <br>
                  <h5>Kartın növünü seçin:</h5>
                  <div class="form-group">
                    <input type="radio" checked id="visa" name="cardType" value="v">
                    <label for="visa">Visa</label>
                    <br>
                    <input type="radio" id="mastercard" name="cardType" value="m">
                    <label for="mastercard">Mastercard</label>
                  </div>
                </div> -->
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <div class="col-md-12">
                <div class="pull-right">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">İMTİNA</button>
                  <button type="submit" class="btn btn-success">ÖDƏ</button>
                </div>
              </div>
            </div>
          </form>

          </div>
        </div>
      </div>

      <!-- The Modal -->
        <div class="modal" id="myModal2">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Balansı artır</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <form method="POST" action="/payment/do_payment" >
              <!-- Modal body -->
              <div class="modal-body">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
                      <input class="form-control" required placeholder="50.00" value="50" type="hidden" min="50" max="50" step="0" name="amount" value="50">
                      <input type="hidden" name="lang" value="lv">
                      <input type="hidden" name="carad_id" value="0">
                      <input type="hidden" name="action" value="3">
                      <div class="form-control">
                        50.00 AZN
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <br>
                    <h5>Ödəniş növünü seçin:</h5>
                    <div class="form-group">
                      <input type="radio" checked id="bank" name="paymentType" value="1">
                      <label for="bank">Bank kartı</label>
                    </div>
                  </div>
                  <!-- <div class="col-md-12">
                    <br>
                    <h5>Kartın növünü seçin:</h5>
                    <div class="form-group">
                      <label for="visa">
                      <input type="radio" checked id="visa" name="cardType" value="v">
                      Visa</label>
                      <br>
                      <label for="mastercard">
                      <input type="radio" id="mastercard" name="cardType" value="m">
                      Mastercard</label>
                    </div>
                  </div> -->
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <div class="col-md-12">
                  <div class="pull-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">İMTİNA</button>
                    <button type="submit" class="btn btn-success">ÖDƏ</button>
                  </div>
                </div>
              </div>
            </form>

            </div>
          </div>
        </div>

</div>

</div>
