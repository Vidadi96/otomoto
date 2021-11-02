<?php

class Dashboard extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("dashboard_model");
  }

  function header_data()
	{
    $this->load->model('universal_model');
		$autosalon = 0;

		if ($this->session->userdata('uid')) {
			$res = $this->universal_model->get_item_where('user', array('id' => $this->session->userdata('uid')), 'autosalon');
			if ($res) {
				if ($res->autosalon)
					$autosalon = 1;
			}
		}

		$data['is_salon'] = $autosalon;
		$data['add_header'] = true;
		return $data;
	}

  function counter()
	{
    $this->load->model('universal_model');

	 	$ip = $this->input->ip_address();

		$check = $this->universal_model->get_more_item_select('counter', 'id, views', array('ip_address' => $ip), 0, array('last_visite_date', 'desc'));

		if ($check && @$check[0]->id) {
			$today_check = $this->universal_model->get_more_item_select('counter', 'id, views', 'ip_address = "'.$ip.'" and last_visite_date > DATE_SUB(NOW() + INTERVAL 1 HOUR, INTERVAL 10 MINUTE)', 0, array('last_visite_date', 'desc'));
			if($today_check && @$today_check[0]->id) {
				$vars = array(
					'last_visite_date' => date('Y-m-d H:i:s'),
					'views' => ((int)($today_check[0]->views) + 1)
				);

				$this->universal_model->update_table('counter', array('id' => $today_check[0]->id), $vars);
			} else {
				$vars = array(
					'ip_address' => $ip,
					'last_visite_date' => date('Y-m-d H:i:s'),
					'views' => 1
				);

				$this->universal_model->add_item($vars, 'counter');
			}
		} else {
			$vars = array(
				'ip_address' => $ip,
				'last_visite_date' => date('Y-m-d H:i:s'),
				'views' => 1
			);

			$this->universal_model->add_item($vars, 'counter');
		}
	}

  function checkAuthor(){
    if (!$this->session->userdata('uid'))
      return false;
    else
      return true;
  }

  function disable_auction()
  {
    // $this->output->enable_profiler(true);

    if ($this->input->post())
    {
      $this->load->model('universal_model');
      $auction_id = (int) $this->input->post('auction_id');
      $result = $this->universal_model->update_table('auction', array('carad_id' => $auction_id, 'status' => 1), array('status' => 0));

      echo $result?1:0;
    }
  }

  function exit()
  {
    unset($_SESSION);
    session_destroy();
    redirect("/");
  }

  function create_key()
  {
    $key = implode('',str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
    return $key;
  }

  function filter_data($array)
  {
    $data = array();
    foreach ($array as $key => $value) {
      if(is_array($value))
        $data[$key] = $value;
      else
        $data[$key] = filter_var(str_replace(array("'", '"',"`", ')', '('), array("","","","",""), $this->security->xss_clean(strip_tags(rawurldecode($value)))), FILTER_SANITIZE_STRING);
    }
    return $data;
  }

  function index()
  {
    // $this->output->enable_profiler(true);
    // $this->counter();
    if ($this->checkAuthor()) {
      $active['ac'] = 2;
      $sort = "Hamısı";
      $sort = ($this->input->get('sort'))?$this->input->get('sort'):"Hamısı";
      $authorid = $this->session->userdata('uid');
      $data['authorInfo'] = $this->dashboard_model->authorInfo($authorid);
      $active['logo'] = $data['authorInfo'][0]['logo'];
      $data['authorCars'] = $this->dashboard_model->getAuthorCars($authorid,$sort);
      $data['authorAdsCount'] = $this->dashboard_model->getAuthorAdsCount($authorid);
      $data['authorFavAdsCount'] = $this->dashboard_model->getAuthorFavAdsCount($authorid);
      $data['title'] = 'dashboard';

      if ($this->input->get('auction_status'))
        $data['auction_status'] = ($this->input->get('auction_status') == 1)?1:0;

      $this->session->set_userdata('adsCount', $data['authorAdsCount'][0]['adscount']);
      $this->session->set_userdata('adsFavCount', $data['authorFavAdsCount'][0]['adsfavcount']);

      $header = $this->header_data();
      $data = array_merge($data, $header);

      $this->load->view('site/tez_header', $data);
      $this->load->view('/Dashboard/leftSide', $active);
      $this->load->view('/Dashboard/index');
      $this->load->view('/Dashboard/footer');
    } else {
      $this->load->view('site/tez_header', array('title' => 'dashboard'));
      $this->load->view('/Dashboard/index2');
      $this->load->view('/Dashboard/footer');
    }
  }

  function rent_car()
  {
    if ($this->checkAuthor()) {
      $active['ac'] = 5;
      $sort = $this->input->get('sort')?(int)$this->input->get('sort'):1;
      $user_id = (int) $this->session->userdata('uid');

      $data['authorInfo'] = $this->dashboard_model->authorInfo($user_id);
      $active['logo'] = $data['authorInfo'][0]['logo'];
      $data['rent_cars'] = $this->dashboard_model->get_rent_cars($user_id, $sort, '0, 25');
      $data['title'] = 'dashboard';

      if ($this->input->get('auction_status'))
        $data['auction_status'] = ($this->input->get('auction_status') == 1)?1:0;

      $header = $this->header_data();
      $data = array_merge($data, $header);

      $this->load->view('site/tez_header', $data);
      $this->load->view('/Dashboard/leftSide', $active);
      $this->load->view('/Dashboard/rent_car');
      $this->load->view('/Dashboard/footer');
    } else {
      $this->load->view('site/tez_header', array('title' => 'dashboard'));
      $this->load->view('/Dashboard/index2');
      $this->load->view('/Dashboard/footer');
    }
  }

  function favourite()
  {
    $this->counter();

    if ($this->checkAuthor()) {
      $active['ac'] = 1;
      $authorid = $this->session->userdata('uid');
      $data['authorInfo'] = $this->dashboard_model->authorInfo($authorid);
      $active['logo'] = $data['authorInfo'][0]['logo'];
      $data['authorFavouriteCars'] = $this->dashboard_model->getAuthorFavouriteCars($authorid);
      $data['title'] = 'dashboard';

      $header = $this->header_data();
      $data = array_merge($data, $header);

      $this->load->view('site/tez_header', $data);
      $this->load->view('/Dashboard/leftSide',$active);
      $this->load->view('/Dashboard/favourite');
      $this->load->view('/Dashboard/footer');
    } else {
      redirect('/dashboard');
    }
  }

  function getGoldPaket()
  {
    if ($this->checkAuthor()) {
      $posts = $this->filter_data($this->input->post());
      $authorid = $this->session->userdata('uid');
      $check = $this->dashboard_model->checkAuthorBalans($authorid,$salon=1);
      if (($check[0]['plus'] - $check[0]['minus']) >= 0) {
        $authorid = $check[0]['authorid'];
        $id = $this->dashboard_model->addGoldPaket($authorid);
        if ($id) {
          $this->session->set_userdata('autosalon',1);
          $this->dashboard_model->updateSalon($authorid);
          echo $id;
        } else {
          echo "false";
        }
      } else {
        echo "false";
      }
    }
  }

  function main(){
    $this->counter();

    // $this->output->enable_profiler(true);
    if($this->checkAuthor()){
      $active['ac'] = 4;
      $authorid = $this->session->userdata('uid');
      $data['authorInfo'] = $this->dashboard_model->authorInfo($authorid);
      $active['logo'] = $data['authorInfo'][0]['logo'];
      $data['adsInfo'] = $this->dashboard_model->getAdsInfo($authorid);
      $data['balans'] = $this->dashboard_model->getBalans($authorid);
      $data['activeAds'] = $this->dashboard_model->getActiveAds($authorid);
      $data['nonActiveAds'] = $this->dashboard_model->getNonActiveAds($authorid);
      $data['title'] = 'dashboard';

      $header = $this->header_data();
      $data = array_merge($data, $header);

      $this->load->view('site/tez_header', $data);
      $this->load->view('/Dashboard/leftSide',$active);
      $this->load->view('/Dashboard/main');
      $this->load->view('/Dashboard/footer');
    }
    else{
      redirect('/dashboard');
    }
  }
  function increaseBalans(){
    // $this->output->enable_profiler(true);
    $posts = $this->filter_data($this->input->post());
    print_r($posts);
    // $amount = $posts['amount'];
    // $payment = @$posts['paymentType'];
    // $card = @$posts['card'];
    // $authorid = $this->session->userdata('uid');
    // $currentDate = date('Y-m-d H:i:s');
    // $id = $this->dashboard_model->increaseBalans($authorid,$amount,$currentDate);
    // if($id!=0){
    //   $this->session->set_userdata('increaseBalans','true');
    // }else{
    //   $this->session->set_userdata('increaseBalans','false');
    // }
    // $currentBalans = $this->dashboard_model->currentBalans($authorid);
    // // print("<pre>");
    // // print_r($currentBalans);
    // $plus = $currentBalans->plus;
    // $minus = $currentBalans->minus;
    // $ads = $currentBalans->ads;
    // if($this->session->userdata('autosalon') == 0){
    //   if( ($plus-($minus+$ads)) >= 50 ){
    //     $this->session->set_userdata('autosalon',1);
    //     $this->dashboard_model->updateSalon($authorid);
    //   }
    // }
    //
    // redirect('/dashboard/main');
  }

  function topPlus(){
    $cost = 9;
    $posts = $this->input->post();
    $posts = $this->filter_data($posts);
    $authorid = (int)$posts['authorid'];
    $adid = (int)$posts['adid'];
    $salon = $this->session->userdata('autosalon');
    $istop = $this->dashboard_model->checkAuthorTopPlus($authorid,$adid);
    $days = @$istop[0]['days'];
    $res = $this->dashboard_model->checkAuthorBalans($authorid,$salon);
    $plus = (@$res[0]['plus'])?@$res[0]['plus']:0;
    $minus = (@$res[0]['minus'])?@$res[0]['minus']:0;
    $ads = (@$res[0]['ads'])?@$res[0]['ads']:0;
    $currentDate = date('Y-m-d H:i:s');
      if(($plus-($minus+$ads)) > 9){
        if( isset($days) && $days <= 5){
          echo "not now";
        }else{
          $id = $this->dashboard_model->makeTopPlus($authorid,$adid,$cost,$currentDate);
          if($id!=0){
            echo "success top plus";
          }
          else{
            echo "something went wrong";
          }
        }
      }
      else{
        echo "Not enough balance";
      }
  }

  function top(){
    // $this->output->enable_profiler(true);
    $cost = 5;
    $posts = $this->input->post();
    $posts = $this->filter_data($posts);
    $authorid = (int)$posts['authorid'];
    $adid = (int)$posts['adid'];
    $salon = $this->session->userdata('autosalon');
    $istop = $this->dashboard_model->checkAuthorTop($authorid,$adid);
    $days = @$istop[0]['days'];
    $res = $this->dashboard_model->checkAuthorBalans($authorid,$salon);
    $amount = 0;
    $okay = false;
    if($this->session->userdata('autosalon')==1){
      $plus = (@$res[0]['plus'])?@$res[0]['plus']:0;
      $minus = (@$res[0]['minus'])?@$res[0]['minus']:0;
      $ads = (@$res[0]['ads'])?@$res[0]['ads']:0;
      $amount = @$plus-(@$minus+@$ads);
    }
    else{
      $adscount = $res[0]['adcount'];
      $next = $res[0]['nextaddate'];
      $now = date('Y-m-d H:i:s');
      if($adscount < 5 && ($now < $next)){
        $okay = true;
      }
      else{
        $okay = false;
      }
    }
    $currentDate = date('Y-m-d H:i:s');

      if($salon == 1){
        if(@$amount > 5){
          if( isset($days) && $days <= 5){
            echo "not now";
          }else{
            $id = $this->dashboard_model->makeTop($authorid,$adid,$cost,$currentDate);
            if($id!=0){
              echo "success top";
            }
            else{
              echo "something went wrong";
            }
          }
        }
        else{
          echo "Not enough balance";
        }
      }else{
        if(@$okay){
          if( isset($days) && $days <= 5){
            echo "not now";
          }else{
            $id = $this->dashboard_model->makeTop($authorid,$adid,$cost,$currentDate);
            if($id!=0){
              echo "success top";
            }
            else{
              echo "something went wrong";
            }
          }
        }
        else{
          echo "Not enough balance";
        }
      }

  }

  function profile()
  {
    $this->counter();

    if($this->checkAuthor()){
      $id = (int) $this->session->userdata('uid');
      $data['authorInfo'] = $this->dashboard_model->authorInfo($id);
      $map_data = $this->dashboard_model->get_map_data($data['authorInfo'][0]['map_id']);
      if ($map_data)
        $data['map_data'] = $map_data;
      else {
        $arr = array(
          'map_id' => 9999999999,
          'lat' => 40.4007,
          'lng' => 49.8729,
          'address' => 'Address'
        );

        $data['map_data'] = $arr;
      }
      $active['ac'] = 3;
      $active['logo'] = $data['authorInfo'][0]['logo'];
      $data['title'] = 'dashboard';
      $data['map'] = true;

      $header = $this->header_data();
      $data = array_merge($data, $header);

      $this->load->view('site/tez_header', $data);
      $this->load->view('/Dashboard/leftSide',$active);
      $this->load->view('/Dashboard/profile');
      $this->load->view('/Dashboard/footer');
    }
    else{
      redirect('/dashboard');
    }
  }

  function maps()
  {
    $this->load->model('universal_model');
    if($this->input->get("map_id"))
		{
			$post = $this->universal_model->get_more_item("map", array("map_id"=>$this->input->get("map_id")), $isarray=1);

			echo '<br />
      <div class="col-lg-12">
  			<h5 style="margin-top: 5px">Ünvan</h5>
  			<input type="hidden" name="lat" value="" />
  			<input type="hidden" name="lng" value="" />
  			<input type="hidden" name="map_id" value="" />
			</div>
      <div class="col-lg-5" style="margin: 5px 0px">
				<input name="title-2" class="form-control m-input" value="'.@$post[0]["address"].'" />
			</div>
      <div class="col-lg-12">
				<label>	&nbsp;</label>
				<button type="button" class="btn btn-success save_marker float-right"><i class="fa fa-save"></i> Yadda saxla</button>
				<br/>
      </div>';
		}
		else if($this->input->get("action") == "save_marker")
		{
			parse_str($this->input->post("data"), $vars);
      $vars = $this->filter_data($vars);
      // print_r($vars);

      $check = $this->universal_model->get_more_item_select_row('map', 'map_id', array('map_id' => (int) $vars['map_id']));

      if ($check) {
        $map_id = $this->universal_model->item_edit_save("map", array("map_id" => (int) $vars["map_id"]), array("lat" => (float)$vars["lat"], "lng" => (float)$vars["lng"], "address" => $vars["title-2"]));
        $this->universal_model->item_edit_save('user', array('id' => $this->session->userdata('uid')), array('map_id' => $vars['map_id']));
      } else {
        $map_id = $this->universal_model->add_item(array('lat' => $vars['lat'], 'lng' => $vars['lng'], 'address' => $vars['title-2']), 'map');
        $this->universal_model->item_edit_save('user', array('id' => $this->session->userdata('uid')), array('map_id' => $map_id));
      }

      echo 1;
		}
  }

  function checkAuthorBalans()
  {
    $id = $this->session->userdata('uid');
    $salon = $this->session->userdata('autosalon');
    $balans = $this->dashboard_model->checkAuthorBalans($id,$salon);
    if ($salon==0) {
      return $balans;
    } else {
      return $balans;
    }
  }

  function addCar()
  {
    redirect('/dashboard/newCar');
  }

  function newCar()
  {
    // $this->counter();
    $this->load->model('PagesModel');
    $this->cache->delete('mark_list');
    $cache_mark_list = $this->PagesModel->get_marks('');
    $this->cache->write($cache_mark_list, 'mark_list');
    $this->cache->delete('popular_mark_list');
    $cache_popular_mark_list = $this->PagesModel->get_marks(' and popular = 1');
    $this->cache->write($cache_popular_mark_list, 'popular_mark_list');

    // $this->output->enable_profiler(true);
    $authorid = $this->session->userdata('uid');
    $data['balans'] = $this->checkAuthorBalans();
    $data['paket'] = $this->dashboard_model->checkAuthorPaket($authorid);
    $data['title'] = 'dashboard';
    $curday = date('Y-m-d H:i:s');
    $this->load->model('PagesModel');
    $data['popular_mark'] = $this->PagesModel->get_marks(' and popular = 1');
    $data['mark'] = $this->PagesModel->get_marks('');
    $data['err'] = $this->input->get('err')?(int)$this->input->get('err'):0;
    $data['webp'] = (preg_match("/image\/webp/i", $_SERVER['HTTP_ACCEPT']) == 1 || strpos( $_SERVER['HTTP_USER_AGENT'], ' Chrome/'))?1:0;

    if ($this->session->userdata('autosalon')==0) {
      if ($data['balans'][0]['adcount']<5) {
        $data['carmark']  =  $this->dashboard_model->getCarMark();
        $data['carmodel'] = $this->dashboard_model->getCarModel();
        $data['carbody']  =  $this->dashboard_model->getCarBody();
        $data['carcolor']  =  $this->dashboard_model->getCarColor();
        $data['carengine']  =  $this->dashboard_model->getCarEngine();
        $data['carinteriorcolor']  =  $this->dashboard_model->getCarInteriorColor();
        $data['carcities']  =  $this->dashboard_model->getCarCities();
        $data['pincode'] = $this->generate_pin();

        $header = $this->header_data();
        $data = array_merge($data, $header);

        $this->load->view('site/tez_header', $data);
        $this->load->view('/Dashboard/addCar2');
        $this->load->view('/Dashboard/footer');
      } else {
        $header = $this->header_data();
        $data = array_merge($data, $header);

        $this->load->view('site/tez_header', $data);
        $this->load->view('/Dashboard/addCarLimit');
        $this->load->view('/Dashboard/footer');
      }
    } else {
      $currentBalans = $this->dashboard_model->currentBalans($authorid);
      $plus = $currentBalans->plus;
      $minus = $currentBalans->minus;
      $ads = $currentBalans->ads;
      $checkMonth = $this->dashboard_model->checkMonth($authorid);
        if (($plus-($minus+$ads)) > 0) {
          $authorid = $this->session->userdata('uid');
          $data['authorInfo'] = $this->dashboard_model->authorInfo($authorid);
          $active['logo'] = $data['authorInfo'][0]['logo'];
          $data['carmark']  =  $this->dashboard_model->getCarMark();
          $data['carmodel'] = $this->dashboard_model->getCarModel();
          $data['carbody']  =  $this->dashboard_model->getCarBody();
          $data['carcolor']  =  $this->dashboard_model->getCarColor();
          $data['carengine']  =  $this->dashboard_model->getCarEngine();
          $data['carinteriorcolor']  =  $this->dashboard_model->getCarInteriorColor();
          $data['carcities']  =  $this->dashboard_model->getCarCities();
          $data['pincode'] = $this->generate_pin();

          $header = $this->header_data();
          $data = array_merge($data, $header);

          $this->load->view('site/tez_header', $data);
          $this->load->view('/Dashboard/addCar2');
          $this->load->view('/Dashboard/footer');
        } else {
          $header = $this->header_data();
          $data = array_merge($data, $header);

          $this->load->view('site/tez_header', $data);
          $this->load->view('/Dashboard/addCarLimit');
          $this->load->view('/Dashboard/footer');
        }
    }
  }
  function editCar(){
    // $this->counter();
    $this->load->model('PagesModel');
    $this->cache->delete('mark_list');
    $cache_mark_list = $this->PagesModel->get_marks('');
    $this->cache->write($cache_mark_list, 'mark_list');
    $this->cache->delete('popular_mark_list');
    $cache_popular_mark_list = $this->PagesModel->get_marks(' and popular = 1');
    $this->cache->write($cache_popular_mark_list, 'popular_mark_list');

    // $this->output->enable_profiler(true);
    if($this->checkAuthor()){
      $this->load->model('PagesModel');
      $this->load->model('universal_model');
      $data['popular_mark'] = $this->PagesModel->get_marks(' and popular = 1');
      $data['mark'] = $this->PagesModel->get_marks('');
      $adid = (int) $this->input->get('id');
      $data['carmark']  =  $this->dashboard_model->getCarMark();
      $data['carmodel'] = $this->dashboard_model->getCarModel();
      $data['carbody']  =  $this->dashboard_model->getCarBody();
      $data['carcolor']  =  $this->dashboard_model->getCarColor();
      $data['carengine']  =  $this->dashboard_model->getCarEngine();
      $data['carinteriorcolor']  =  $this->dashboard_model->getCarInteriorColor();
      $data['carcities']  =  $this->dashboard_model->getCarCities();
      $authorid = $this->session->userdata('uid');
      $data['editAd'] = $this->dashboard_model->editAd($adid,$authorid);

      $data['title'] = 'dashboard';
      $this->load->view('site/tez_header', $data);
      if($data['editAd']) {
        $data['filter_mark_name'] = $this->universal_model->get_more_item_select_row('carmark', 'mark', array('id' => $data['editAd'][0]['mark']));
        $data['filter_model_name'] = $this->universal_model->get_more_item_select_row('carmodel', 'model', array('id' => $data['editAd'][0]['model']));
        $pincode = 0;
        $data['carphotos'] = $this->dashboard_model->getAdsPhotos($adid, $pincode);
        $this->load->view('/Dashboard/editCar', $data);
      }
      else
        $this->load->view('/Dashboard/noEditCar', array('id' => (int) $this->input->get('id')));

      $this->load->view('/Dashboard/footer');
    }
    else
      redirect('/dashboard');
  }

  function editMyCar(){
    if($this->checkAuthor() || @$this->session->userdata('edit_pincode') == $this->input->post('pincode')){
      $adid = $this->input->post('adid');
      $posts = $this->input->post();
      $posts = $this->filter_data($posts);
      foreach($posts as $x => $x_value) {
        if($x_value == 'on'){
          $posts[$x] = 1;
        }
      }
      $this->dashboard_model->editMyCar($posts);
      if ($this->checkAuthor())
        redirect("/dashboard");
      else
        redirect('/pages/edit_with_pin/'.$posts['adid'].'?pincode='.$this->session->userdata('edit_pincode'));
    }
    else{
      redirect('/dashboard?val='.$this->session->userdata('edit_pincode')."_".$this->input->post('pincode'));
    }
  }
  function getMarkModels(){
    // $csrfName = $this->input->post('csrfName');
    // $csrfHash = $this->input->post('csrfHash');
    $posts = $this->input->post('mark');
    $models = $this->dashboard_model->getMarkModels($posts);
    $arr['models'] = $models;
    $arr['csrf_name'] = $this->security->get_csrf_token_name();
    $arr['csrf_hash'] = $this->security->get_csrf_hash();
    echo json_encode($arr);
  }
  function changeImgOrder()
  {
    // $this->output->enable_profiler(true);
    $posts = $this->input->post();
    $posts = $this->filter_data($posts);
    $this->dashboard_model->changeImgOrder($posts);
  }

  function addNewCar()
  {
    // $this->counter();

    $this->load->model('universal_model');
    $authorid = @$this->session->userdata('uid');
    $posts = $this->filter_data($this->input->post());

    $photo_count = $this->universal_model->get_item_where('carphoto', array('pincode' => $posts['pincode']), 'count(*) as "count"');

    if (@$photo_count && @$photo_count->count > 4) {
      if (!$authorid) {
        $username = $posts['firstname'];
        $email = $posts['email'];
        $phone = $posts['phone'];
        $passwd = $posts['passwd'];
        $pincode = $posts['pincode'];
        $autosalon = $posts['autosalon'];

        $check_mail = $this->universal_model->get_item_where('user', array('email' => $email), 'id');

        if (@$check_mail->id) {
          echo 'Daxil etdiyiniz mail artıq mövcuddur. Xahiş edirik başqa mail daxil edəsiniz';
        } else {
          $authorid = $this->dashboard_model->addNewUser($username, $email, $phone, $passwd, $pincode, $autosalon);

          $_SESSION['uid'] = $authorid;
          $_SESSION['ad'] = $username;
          $_SESSION['email'] = $email;
          $_SESSION['mobile'] = $phone;
          $_SESSION['sifre'] = $passwd;
          $_SESSION['autosalon'] = $autosalon;

          $add = $this->dashboard_model->addNewCar($posts, $authorid);
          if ($add != 'AddBad'){
            $mark_arr = $this->universal_model->get_item_where('carmark', array('id' => (int) $posts['mark']), 'mark');
            $mark = (@$mark_arr && $mark_arr->mark)?$mark_arr->mark:'';
            $model_arr = $this->universal_model->get_item_where('carmodel', array('id' => (int) $posts['model']), 'model');
            $model = (@$model_arr && $model_arr->model)?$model_arr->model:'';

            if ($mark && $model) {
              $vars = array(
                'mark' => strtoupper($mark),
                'model' => strtoupper($model),
                'year' => (int) $posts['year'],
                'price' => (float) $posts['price'],
                'currency' => (int) $posts['currency'],
                'carad_id' => $add
              );

              $this->universal_model->add_item($vars, 'appraisement');

              $this->add_bakcell($phone, $authorid, $add);
            }

            $this->session->set_userdata('addsuccess','true');
            redirect("/dashboard");
          } else {
            $this->session->set_userdata('addsuccess','false');
            redirect("/dashboard");
          }
        }
      } else {
        $add = $this->dashboard_model->addNewCar($posts, $authorid);
        if($add != 'AddBad') {
          $mark_arr = $this->universal_model->get_item_where('carmark', array('id' => (int) $posts['mark']), 'mark');
          $mark = (@$mark_arr && $mark_arr->mark)?$mark_arr->mark:'';
          $model_arr = $this->universal_model->get_item_where('carmodel', array('id' => (int) $posts['model']), 'model');
          $model = (@$model_arr && $model_arr->model)?$model_arr->model:'';

          $res = $this->universal_model->get_item_where('user', array('id' => $this->session->userdata('uid')), 'autosalon, mobile');

          if (@!$res->autosalon)
            $this->add_bakcell($res->mobile, $authorid, $add);

          if($mark && $model) {
            $vars = array(
              'mark' => strtoupper($mark),
              'model' => strtoupper($model),
              'year' => (int) $posts['year'],
              'price' => (float) $posts['price'],
              'currency' => (int) $posts['currency'],
              'carad_id' => $add
            );

            $this->universal_model->add_item($vars, 'appraisement');
          }

          $this->session->set_userdata('addsuccess','true');
          redirect("/dashboard");
        } else {
          $this->session->set_userdata('addsuccess','false');
          redirect("/dashboard");
        }
      }
    } else {
      redirect("/dashboard/newCar?err=5");
    }
    // redirect("/dashboard");

  }

  function add_bakcell($phone, $authorid, $add)
  {
    $number = str_replace(' ', '', $phone);
    $number = str_replace('-', '', $number);

    $bakcell = $this->check_bakcell('994'.substr((int) $number, 0));
    if ($bakcell) {
      $vars2 = array(
        'amount' => 10,
        'authorid' => $authorid,
        'createdate' => date('Y-m-d H:i:s'),
        'action' => 20,
        'caradid' => $add,
        'active' => 1,
        'salon' => 0
      );

      $this->universal_model->add_item($vars2, 'car_orders');
    }
  }

  function removeImage(){
    if($this->checkAuthor()){
    $id = $this->input->get('id');
    $this->dashboard_model->removeImage($id);
    echo "success";
    }
    else{
      redirect('/dashboard');
    }
  }
  function watermark_image($target, $wtrmrk_file, $newcopy) {
   $watermark = imagecreatefrompng($wtrmrk_file);
   imagealphablending($watermark, false);
   imagesavealpha($watermark, true);
   $img = imagecreatefromjpeg($target);
   $img_w = imagesx($img);
   $img_h = imagesy($img);
   $wtrmrk_w = imagesx($watermark);
   $wtrmrk_h = imagesy($watermark);
   $dst_x = ($img_w / 2) - ($wtrmrk_w / 2); // For centering the watermark on any image
   $dst_y = ($img_h / 2) - ($wtrmrk_h / 2); // For centering the watermark on any image
   imagecopy($img, $watermark, $dst_x, $dst_y, 0, 0, $wtrmrk_w, $wtrmrk_h);
   imagejpeg($img, $newcopy, 100);
   imagedestroy($img);
   imagedestroy($watermark);
}

  function img_upload_main()
	{
    // $this->output->enable_profiler(true);
    $pincode = $this->input->get('pincode')?(int)$this->input->get('pincode'):0;
    $carid = $this->input->get('carid')?(int)$this->input->get('carid'):0;

    $this->load->library('FancyFileUploaderHelper');
    $this->load->library('resize');
    // Depending on your server, you might have to use $_POST instead of $_REQUEST.
    if (isset($_REQUEST["action"]) && $_REQUEST["action"] === "fileuploader")
    {
      header("Content-Type: application/json");

      $allowedexts = array(
        "jpg" => true,
        "png" => true,
        "JPEG" => true,
        "jpeg" => true
      );

      $files = FancyFileUploaderHelper::NormalizeFiles("files");
      if (!isset($files[0]))  $result = array("success" => false, "error" => "File data was submitted but is missing.", "errorcode" => "bad_input");
      else if (!$files[0]["success"]){  $result = $files[0]; }
      else if (!isset($allowedexts[strtolower($files[0]["ext"])]))
      {
        $result = array(
          "success" => false,
          "error" => "Invalid file extension.  Must be '.jpg' or '.png'.",
          "errorcode" => "invalid_file_ext"
        );
      }
      else
      {
        $success = $files[0]['success'];
        $file = $files[0]['file'];
        $generated_name = $this->generate_name();
        $name = 'img_'.$generated_name.'.'.$files[0]['ext'];
        $ext = $files[0]['ext'];
        $type = $files[0]['type'];
        $size = $files[0]['size'];

        $path="/assets/img/car_photos/";
        $authorid = $this->session->userdata('uid');

          if($this->upload($files, $name)){
            $result = array(
              "success" => true
            );

            $deg = $this->correctImageOrientation($this->config->item('server_root').'/assets/img/car_photos/'.$name);

            $this->load->library('resize');
    				$this->resize->getFileInfo($this->config->item('server_root').$path.$name);


            $this->resize->resizeImage(1000, 1000, 'landscape');
    				$this->resize->saveImage($this->config->item('server_root').'/assets/img/car_photos/800xauto/'.$name, 90, $deg);


            $upload_location = $this->config->item('server_root').'/assets/img/car_photos/800xauto/'.$name;
            $watermark_image = imagecreatefrompng($this->config->item('server_root').$path.'logo/otomoto_logo_transparent.png');
            if($ext == 'jpg' || $ext == 'jpeg')
            {
              $image = imagecreatefromjpeg($upload_location);
            }
            if($ext == 'png')
            {
              $image = imagecreatefrompng($upload_location);
            }
            $watermark_image_width = imagesx($watermark_image);
            $watermark_image_height = imagesy($watermark_image);
            imagecopy($image, $watermark_image, (imagesx($image) - $watermark_image_width)/2, (imagesy($image) - $watermark_image_height)/2, 0, 0, $watermark_image_width, $watermark_image_height);
            imagepng($image, $upload_location);

            $array = explode('.', $name);
            $jpg = $image;
            $w = imagesx($jpg);
            $h = imagesy($jpg);
            $webp = imagecreatetruecolor($w,$h);
            imagecopy($webp, $jpg, 0, 0, 0, 0, $w, $h);
            imagewebp($webp, $this->config->item('server_root').'/assets/img/car_photos/800xauto/'.$array[0].'.webp', 80);
            imagedestroy($jpg);
            imagedestroy($webp);

    				$this->resize->resizeImage(360, 360, 'auto');
    				$this->resize->saveImage($this->config->item('server_root').'/assets/img/car_photos/90x90/'.$name, 90, $deg);

            $upload_location = $this->config->item('server_root').'/assets/img/car_photos/90x90/'.$name;
            $watermark_image = imagecreatefrompng($this->config->item('server_root').$path.'logo/otomoto_logo_transparent0.png');

            if ($ext == 'jpg' || $ext == 'jpeg')
              $image = imagecreatefromjpeg($upload_location);

            if ($ext == 'png')
              $image = imagecreatefrompng($upload_location);

            $watermark_image_width = imagesx($watermark_image);
            $watermark_image_height = imagesy($watermark_image);
            imagecopy($image, $watermark_image, (imagesx($image) - $watermark_image_width)/2, (imagesy($image) - $watermark_image_height)/2, 0, 0, $watermark_image_width, $watermark_image_height);
            imagepng($image, $upload_location);

            $array = explode('.', $name);
            $jpg = $image;
            $w = imagesx($jpg);
            $h = imagesy($jpg);
            $webp = imagecreatetruecolor($w,$h);
            imagecopy($webp, $jpg, 0, 0, 0, 0, $w, $h);
            imagewebp($webp, $this->config->item('server_root').'/assets/img/car_photos/90x90/'.$array[0].'.webp', 80);
            imagedestroy($jpg);
            imagedestroy($webp);

    				unlink($this->config->item('server_root').$path.$name);

            $location = $this->dashboard_model->photoLocation($pincode)['location'];
            $location=($location==0)?1:$location+1;
            $this->dashboard_model->uploadCarPhoto($path, $name, $carid, $authorid, $pincode, $location);
          }
          else {
            $result = array(
              "error" => true
            );
          }

      }
      $result['imagePath800'] = $this->config->item('server_root').'/assets/img/car_photos/800xauto/'.$name;
      $result['imagePath90'] = $this->config->item('server_root').'/assets/img/car_photos/90x90/'.$name;
      $result['otomoto'] = $this->security->get_csrf_hash();
      echo json_encode($result, JSON_UNESCAPED_SLASHES);
      exit();
    }
	}

  function correctImageOrientation($filename)
  {
    $deg = 0;
    $exif = @exif_read_data($filename);
    if($exif && isset($exif['Orientation'])) {
      $orientation = $exif['Orientation'];
      if($orientation != 1){
        switch ($orientation) {
          case 3:
            $deg = 180;
            break;
          case 6:
            $deg = 270;
            break;
          case 8:
            $deg = 90;
            break;
        }
      }
    }
    return $deg;
  }

  function unlinkimage()
  {
    $this->load->model('universal_model');
    $arr['csrf_name'] = $this->security->get_csrf_token_name();
    $arr['csrf_hash'] = $this->security->get_csrf_hash();
    @unlink($this->input->post('size90'));
    @unlink($this->input->post('size800'));
    $repl = ["jpg", "png", "jpeg"];
    $new = str_replace($repl,'webp', $this->input->post('size90'));
    $new2 = str_replace($repl,'webp', $this->input->post('size800'));
    @unlink($new);
    @unlink($new2);
    $arr = explode('/', $this->input->post('size90'));
    $name = $arr?$arr[count($arr) - 1]:'';
    // echo $name;
    if ($name)
      $this->universal_model->delete_item(array('name' => $name), 'carphoto');
  }

  function generate_pin()
  {
    $val = rand(0, 99999);
    $check = false;
    $array = $this->dashboard_model->select_result('carad', 'pincode');
    foreach ($array as $row)
    {
      if ($row->pincode == $val)
        $check = true;
    }

    if ($check)
      $this->generate_pin();
    else
      return $val;
  }


  function AuthorCars($authorid=0){
    if($this->checkAuthor()){
      $data['ad'] = $this->dashboard_model->getAuthorCars($authorid);

      $header = $this->header_data();
      $data = array_merge($data, $header);

      $this->load->view('/Dashboard/header');
      $this->load->view('/Dashboard/leftSide');
      $this->load->view('/Dashboard/ads',$data);
      $this->load->view('/Dashboard/footer');
    }
    else{
      redirect('dashboard');
    }
  }
  function makeFavourite(){
    if($this->checkAuthor()){
      $posts = $this->input->post();
      $posts = $this->filter_data($posts);
      $id = $posts['id'];
      $fav = $posts['fav'];
      $fav = ($fav==0)?1:0;
      $authorid = $this->session->userdata('uid');
      $this->dashboard_model->makeFavourite($id,$authorid,$fav);
      echo $fav;
    }
    else{
      $this->load->view('/Dashboard/header');
      $this->load->view('/Dashboard/leftSide2');
      $this->load->view('/Dashboard/index2');
      $this->load->view('/Dashboard/footer');
    }
  }

  function rent_make_favourite()
  {
    if ($this->checkAuthor()) {
      $posts = $this->filter_data($this->input->post());
      $id = (int) $posts['id'];
      $fav = $posts['fav'];
      $fav = ($fav==0)?1:0;
      $user_id = $this->session->userdata('uid');
      $this->dashboard_model->rent_make_favourite($id, $user_id, $fav);
      echo $fav;
    } else {
      $this->load->view('/Dashboard/header');
      $this->load->view('/Dashboard/leftSide2');
      $this->load->view('/Dashboard/index2');
      $this->load->view('/Dashboard/footer');
    }
  }

  function changeCarStatus(){
    if($this->checkAuthor()){
      $adid = $this->input->get('id');
      $status = $this->input->get('status');
      $authorid = $this->session->userdata('uid');
      $this->dashboard_model->changeCarStatus($adid,$status,$authorid);
      redirect("/dashboard");
    }
    else{
      $this->load->view('/Dashboard/header');
      $this->load->view('/Dashboard/leftSide2');
      $this->load->view('/Dashboard/index2');
      $this->load->view('/Dashboard/footer');
    }
  }

  function change_rent_car_status($id)
  {
    if ($this->checkAuthor()) {
      $adid = (int) $id;
      $status = $this->input->get('status');
      $user_id = $this->session->userdata('uid');
      $this->dashboard_model->change_rent_car_status($adid, $status, $user_id);
      redirect("/dashboard/rent_car");
    } else {
      $this->load->view('/Dashboard/header');
      $this->load->view('/Dashboard/leftSide2');
      $this->load->view('/Dashboard/index2');
      $this->load->view('/Dashboard/footer');
    }
  }

  function changeStatus(){
    if($this->checkAuthor()){
      $adid = $this->input->get('id');
      $status = $this->input->get('status');
      $authorid = $this->session->userdata('uid');
      $this->dashboard_model->changeStatus($adid,$status,$authorid);
      redirect("/dashboard");
    }
    else{
      $this->load->view('/Dashboard/header');
      $this->load->view('/Dashboard/leftSide2');
      $this->load->view('/Dashboard/index2');
      $this->load->view('/Dashboard/footer');
    }
  }

  function change_rent_status($id)
  {
    if ($this->checkAuthor()) {
      $adid = (int) $id;
      $status = $this->input->get('status');
      $user_id = $this->session->userdata('uid');
      $this->dashboard_model->change_rent_status($adid, $status, $user_id);
      redirect("/dashboard/rent_car");
    } else {
      $this->load->view('/Dashboard/header');
      $this->load->view('/Dashboard/leftSide2');
      $this->load->view('/Dashboard/index2');
      $this->load->view('/Dashboard/footer');
    }
  }

  function remove(){
    // $this->output->enable_profiler('true');
    if($this->checkAuthor()){
    $adid = $this->input->get('id');
    $authorid = $this->session->userdata('uid');
    $removed = $this->dashboard_model->removeCar($adid,$authorid);
      if($removed == 'RemoveSuccess'){
        $this->session->set_userdata('success','true');
        redirect("/dashboard");
      }
      else{
        $this->session->set_userdata('success','false');
        redirect("/dashboard");
      }
    }
    else{
      redirect('/dasboard');
    }
  }

  function remove_rent_car($id)
  {
    if ($this->checkAuthor()) {
    $adid = (int) $id;
    $user_id = $this->session->userdata('uid');
    $removed = $this->dashboard_model->remove_rent_car($adid, $user_id);
      if ($removed == 'RemoveSuccess') {
        $this->session->set_userdata('success','true');
        redirect("/dashboard/rent_car");
      } else {
        $this->session->set_userdata('success','false');
        redirect("/dashboard/rent_car");
      }
    } else {
      redirect('/dashboard');
    }
  }

  function addAuthorInfo(){
    // $this->output->enable_profiler(true);
    $this->load->model('universal_model');
    if($this->checkAuthor()){
      $this->load->library('resize');
      $authorid = $this->session->userdata('uid');
      $posts = $this->filter_data($this->input->post());

      if(@$_FILES['logo']['tmp_name'] && @$_FILES['logo']['tmp_name'] != 'none')
  		{
  			$img = $this->do_upload("logo", $this->config->item('server_root').'/assets/img/car_photos/', 20000, 'logo', 'jpg|png|JPEG|jpeg');
        if (@$img["error"]==TRUE) {
  				$error = $img["error"];
  			}	else {
  				$this->resize->getFileInfo($img['full_path']);
          $this->resize->resizeImage(200, 200, 'auto');
          $this->resize->saveImage($this->config->item('server_root').'/assets/img/car_photos/logo/'.$img['file_name'], 90);
          unlink($img['full_path']);

          $last_logo_arr = $this->universal_model->get_more_item_select('user', 'logo', array('id' => $authorid));
          if (@$last_logo_arr) {
            if(@$last_logo_arr->logo)
              @unlink($this->config->item('server_root').'/assets/img/car_photos/logo/'.$last_logo_arr[0]->logo);
          }

          $this->universal_model->item_edit_save('user', array('id' => $authorid), array('logo' => $img['file_name']));
        }
      }

      if(@$_FILES['avatar']['tmp_name'] && @$_FILES['avatar']['tmp_name'] != 'none')
  		{
  			$img2 = $this->do_upload("avatar", $this->config->item('server_root').'/assets/img/car_photos/', 20000, 'avatar', 'jpg|png|JPEG|jpeg');
  			if (@$img2["error"]==TRUE) {
  				$error = $img2["error"];
  			}	else {
  				$this->resize->getFileInfo($img2['full_path']);
          $this->resize->resizeImage(1000, 1000, 'landscape');
          $this->resize->saveImage($this->config->item('server_root').'/assets/img/car_photos/avatar/'.$img2['file_name'], 90);
          unlink($img2['full_path']);

          if (@$last_avatar_arr) {
            if(@$last_avatar_arr->avatar)
              @unlink($this->config->item('server_root').'/assets/img/car_photos/avatar/'.$last_avatar_arr[0]->avatar);
          }

          $this->universal_model->item_edit_save('user', array('id' => $authorid), array('avatar' => $img2['file_name']));
        }
      }

      $this->dashboard_model->editAuthorInfo($posts, $authorid);
      if($posts['newpass'] != '' && $posts['newpass2'] != '' && $posts['newpass'] === $posts['newpass2']){
        $newpass = md5($posts['newpass']);
        $this->dashboard_model->updateAuthorPass($newpass, $authorid);
      }
      redirect("/dashboard/profile?msg=1");
    }
    else
    {
      redirect('/dashboard');
    }
  }

  function do_upload($inputname, $upload_path, $file_size=20000, $img_name="", $types='txt|gif|jpg|png|TIF|TIFF|pdf|JPEG|jpeg|doc|docx|xls|xlsx|ppt|pptx')
  {
    $data = array();
    $config['upload_path'] = $upload_path;
    $config['overwrite'] = 1;
    $config['allowed_types'] = $types;
    $config["max_size"] = $file_size;
    $config['file_name'] = $img_name."_".strtotime(date("Y-m-d H:i:s"));
    $this->load->library('upload', $config);
    if (!$this->upload->do_upload($inputname))
      $data = array('error' => $this->upload->display_errors());
    else
      $data = $this->upload->data();

    return $data;
  }

    private function set_upload_options()
    {
        //upload an image options
        $config = array();
        $config['upload_path'] = './assest/images/products/';
        $config['allowed_types'] = 'jpg|png|JPEG|jpeg';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;

        return $config;
    }



    public function upload($file,$name) {
        if($file) {

            $config['upload_path'] = $this->config->item('server_root').'/assets/img/car_photos/';
            $config['file_name'] = $name;
            $config['overwrite'] = TRUE;
            $config["allowed_types"] = 'jpg|png|JPEG|jpeg';
            $config["max_size"] = 20048;
            $config["max_width"] = 5400;
            $config["max_height"] = 5400;
            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('files')) {
                $data['error'] = $this->upload->display_errors();
                print_r($data['error']);

            } else {
              return "1";
            }
        }
    }

    public function uploadLogo($file,$name) {
        if($file) {

            $config['upload_path'] = $this->config->item('server_root').'/assets/img/car_photos/';
            $config['file_name'] = $name;
            $config['overwrite'] = TRUE;
            $config["allowed_types"] = 'jpg|png|JPEG|jpeg';
            $config["max_size"] = 20048;
            $config["max_width"] = 5400;
            $config["max_height"] = 5400;
            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('logo')) {
                $data['error'] = $this->upload->display_errors();
                print_r($data['error']);

            } else {
              return "1";
            }
        }
    }

    public function uploadAvatar($file,$name) {
        if($file) {

            $config['upload_path'] = $this->config->item('server_root').'/assets/img/car_photos/';
            $config['file_name'] = $name;
            $config['overwrite'] = TRUE;
            $config["allowed_types"] = 'jpg|png|JPEG|jpeg';
            $config["max_size"] = 20048;
            $config["max_width"] = 5400;
            $config["max_height"] = 5400;
            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('avatar')) {
                $data['error'] = $this->upload->display_errors();
                print_r($data['error']);

            } else {
              return "1";
            }
        }
    }

    public function add_to_auction()
    {
      if ($this->input->post())
      {
        $this->load->model('universal_model');
        $filtered_post = $this->filter_data($this->input->post());

        $vars = array(
          'carad_id' => (int) $filtered_post['carad_id'],
          'discount' => (int) $filtered_post['discount'],
          'period' => (int) $filtered_post['period'],
          'participants' => (int) $filtered_post['participants'],
          'phone_show' => ($filtered_post['phone_show'] == 2)?0:1,
          'status' => 1,
          'create_date' => date('Y-m-d H:i:s')
        );

        $result = $this->universal_model->add_item($vars, 'auction');

        if ($result)
          redirect('/dashboard/index?auction_status=1');
        else
          redirect('/dashboard/index?auction_status=0');
      }
    }


    function generate_name()
  	{
  		$this->load->helper('string');
  		$val = random_string('alnum', 25);
  		$check = false;

      $this->load->model('universal_model');
  		$array = $this->universal_model->select_result('carphoto', 'name');
  		foreach ($array as $row)
  		{
  			if ($row->name == 'img_'.$val)
  				$check = true;
  		}

  		if ($check)
  			$this->generate_name();
  		else
  			return $val;
  	}

    function check_bakcell($msisdn)
    {
      $secretkey = '5b6410a13c5088d8ba184f6ec2dfcdd1';
      $authcode = 'fe04df926e55110ce0fcdafd5d2e1a38';
      $amount = '10';
      $post_data = '
      <?xml version="1.0" encoding="UTF-8" ?>
      <autocomplete>
       <authcode>'.$authcode.'</authcode>
       <msisdn>'.$msisdn.'</msisdn>
       <amount>'.$amount.'</amount>
      </autocomplete>
      ';
      $post_data = trim($post_data);
      $hash = md5($post_data.$secretkey);
      $post_url = 'https://portal.emobile.az/externals/loyalty/autocomplete?hash='.$hash;
      $post_headers = array();
      $post_headers[] = "Content-Type: text/xml";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $post_url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $post_headers);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      $x_response = curl_exec($ch);
      if ($x_response === false)
        $x_response = "Curl error : ".curl_error($ch);
      curl_close($ch);
      $res = false;
      if (strpos($x_response, 'success'))
        $res = true;

      return $res;
    }

}

?>
