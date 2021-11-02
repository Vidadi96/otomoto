<?php
    class Pages extends MY_Controller
    {
      public $webp;

      function __construct()
    	{
    		parent::__construct();
    		$this->load->model("PagesModel");
        $this->load->model("universal_model");
        $this->webp = (preg_match("/image\/webp/i", $_SERVER['HTTP_ACCEPT']) == 1 || strpos( $_SERVER['HTTP_USER_AGENT'], ' Chrome/'))?1:0;
    	}

      public function unlink_image_manually()
      {
        $data = $this->universal_model->get_more_item_select('carphoto', 'name', array('caradid' => 229));
        $pathh = '/assets/img/car_photos';

        foreach($data as $raw)
        {
          $del_arr = explode('.', $raw->name);

          if(file_exists($this->config->item('server_root').$pathh."/800xauto/".$raw->name))
            unlink($this->config->item("server_root").$pathh."/800xauto/".$raw->name);
          if(file_exists($this->config->item('server_root').$pathh."/90x90/".$raw->name))
            unlink($this->config->item("server_root").$pathh."/90x90/".$raw->name);
          if(file_exists($this->config->item('server_root').$pathh."/800xauto/".$del_arr[0].'.webp'))
            unlink($this->config->item("server_root").$pathh."/800xauto/".$del_arr[0].'.webp');
          if(file_exists($this->config->item('server_root').$pathh."/90x90/".$del_arr[0].'.webp'))
            unlink($this->config->item("server_root").$pathh."/90x90/".$del_arr[0].'.webp');
        }
      }

      public function index($pg = 'main-page')
      {
        // if(@$this->session->userdata['uid'] == 1207)
        //   $this->output->enable_profiler(true);

        $mark_array = $model_array = $body_array = $color_array = $city_array = $fuel_array = $transmission_array = $drive_array = [];
        $mark = $model = $body = $color = $city = $search = $rec_pass = 0;
        $min_mileage = $max_mileage = $currency = $min_price = $max_price = $min_year = $max_year = $min_engine = $max_engine = 0;
        $credit = $barter = $disk = $radar = $camera = $qapanma = $lampa = $leather = $lyuk = $isidilme = $abs = $kondisioner = $sensor = $havalandirma = $perde = $esp = 0;
        $order = $fuel = $transmission = $drive = '';

        if($this->input->get())
        {
          $filtered_get = $this->filter_data($this->input->get());
          $order = $this->input->get('order')?$filtered_get['order']:'';
          $search = $data['all_ads'] = $this->input->get('search')?1:0;

          $b = @$this->input->get('mark');
          if (isset($b)) {
            $search = 1;
            $mark = $filtered_get['mark']?(int)$filtered_get['mark']:0;
            $model = $filtered_get['model']?(int)$filtered_get['model']:0;
            $data['filter_mark2'] = (int) $filtered_get['mark'];
            $data['filter_model2'] = (int) $filtered_get['model'];
            $data['filter_mark_name'] = $this->universal_model->get_more_item_select_row('carmark', 'mark', array('id' => $mark));
            $data['filter_model_name'] = $this->universal_model->get_more_item_select_row('carmodel', 'model', array('id' => $model));
          }
          $city = $this->input->get('city')?(int)$filtered_get['city']:0;

          $a = @$this->input->get('min_engine');
          if(isset($a))
          {
            $search = 1;
            $mark_array = $this->input->get('mark_array')?$filtered_get['mark_array']:[];
            $mark = $mark_array?implode(',', $mark_array):$mark;
            $model_array = $this->input->get('model_array')?$filtered_get['model_array']:[];
            $model = $model_array?implode(',', $model_array):$model;
            $body_array = $this->input->get('body')?$filtered_get['body']:[];
            $body = ($body_array && @$body_array[0])?implode(',', $body_array):0;
            $color_array = $this->input->get('color')?$filtered_get['color']:[];
            $color = ($color_array && @$color_array[0])?implode(',', $color_array):0;
            $city_array = $this->input->get('city_array')?$filtered_get['city_array']:[];
            $city = ($city_array && @$city_array[0])?implode(',', $city_array):0;
            $fuel_array = $this->input->get('fuel')?$filtered_get['fuel']:[];
            $fuel = ($fuel_array && @$fuel_array[0])?'"'.implode('","', $fuel_array).'"':'';
            $transmission_array = $this->input->get('transmission')?$filtered_get['transmission']:[];
            $transmission = ($transmission_array && @$transmission_array[0])?'"'.implode('","', $transmission_array).'"':'';
            $drive_array = $this->input->get('drive')?$filtered_get['drive']:[];
            $drive = ($drive_array && @$drive_array[0])?'"'.implode('","', $drive_array).'"':'';

            $min_mileage = (int)$filtered_get['min_mileage'];
            $max_mileage = (int)$filtered_get['max_mileage'];
            $min_engine = (int)$filtered_get['min_engine'];
            $min_engine_arr = $this->universal_model->get_item_where('carengine', array('id' => $min_engine), 'engine');
            $min_engine = $min_engine_arr?($min_engine_arr->engine?$min_engine_arr->engine:0):0;
            $max_engine = (int)$filtered_get['max_engine'];
            $max_engine_arr = $this->universal_model->get_item_where('carengine', array('id' => $max_engine), 'engine');
            $max_engine = $max_engine_arr?($max_engine_arr->engine?$max_engine_arr->engine:0):0;

  					$disk = $this->input->get('disk')?1:0;
  					$radar = $this->input->get('radar')?1:0;
  					$camera = $this->input->get('camera')?1:0;
  					$qapanma = $this->input->get('qapanma')?1:0;
  					$lampa = $this->input->get('lampa')?1:0;
  					$leather = $this->input->get('leather')?1:0;
  					$lyuk = $this->input->get('lyuk')?1:0;
  					$isidilme = $this->input->get('isidilme')?1:0;
  					$abs = $this->input->get('abs')?1:0;
  					$kondisioner = $this->input->get('kondisioner')?1:0;
  					$sensor = $this->input->get('sensor')?1:0;
  					$havalandirma = $this->input->get('havalandirma')?1:0;
  					$perde = $this->input->get('perde')?1:0;
  					$esp = $this->input->get('esp')?1:0;
          }

          $v = @$this->input->get('min_year');
          if (isset($v)) {
            $currency = (int) $filtered_get['currency'];
            $min_price = (int) $filtered_get['min_price'];
            $max_price = (int) $filtered_get['max_price'];
            $min_year = (int) $filtered_get['min_year'];
            $max_year = (int) $filtered_get['max_year'];
            $credit = $this->input->get('credit')?1:0;
            $barter = $this->input->get('barter')?1:0;
          }

          $rec_pass = $this->input->get('rec_pass')?(int)$this->input->get('rec_pass'):0;
        }

        $data['title'] = $pg;
        $data['order'] = $order;
        $data['filter_mark'] = $mark;
        $data['filter_model_list'] = $this->universal_model->get_more_item_select('carmodel', 'id, model', 'active = 1'.($mark?' and markid in ('.$mark.')':' and markid = -1'), 0, array('model', 'asc'));
        $data['filter_model'] = $model;
        $data['filter_currency'] = $currency;
        $data['filter_min_price'] = $min_price;
        $data['filter_max_price'] = $max_price;
        $data['filter_min_year'] = $min_year;
        $data['filter_max_year'] = $max_year;
        $data['filter_city'] = $city;
        $data['filter_credit'] = $credit;
        $data['filter_barter'] = $barter;

        if ($this->cache->get('mark_list')) {
          $cache_mark_list = $this->cache->get('mark_list');
        } else {
          $cache_mark_list = $this->PagesModel->get_marks('');
          $this->cache->write($cache_mark_list, 'mark_list');
        }

        if ($this->cache->get('popular_mark_list')) {
          $cache_popular_mark_list = $this->cache->get('popular_mark_list');
        } else {
          $cache_popular_mark_list = $this->PagesModel->get_marks(' and popular = 1');
          $this->cache->write($cache_popular_mark_list, 'popular_mark_list');
        }

        if ($this->cache->get('city_list')) {
          $cache_city_list = $this->cache->get('city_list');
        } else {
          $cache_city_list = $this->universal_model->get_more_item_select('elancities', 'id, ad', array('active' => 1));
          $this->cache->write($cache_city_list, 'city_list');
        }

        $data['mark'] = $cache_mark_list;
        $data['popular_mark'] = $cache_popular_mark_list;
        $data['city'] = $cache_city_list;
        $data['total_row'] = $this->PagesModel->get_cars_total_row()->count;
        $data['search'] = $search;
        $data['rec_pass'] = $rec_pass;

        $vars = array(
          'mark' => $mark,
          'model' => $model,
          'body' => $body,
          'color' => $color,
          'city' => $city,
          'min_mileage' => $min_mileage,
          'max_mileage' => $max_mileage,
          'currency' => $currency,
          'min_price' => $min_price,
          'max_price' => $max_price,
          'min_year' => $min_year,
          'max_year' => $max_year,
          'min_engine' => $min_engine,
          'max_engine' => $max_engine,
          'credit' => $credit,
          'barter' => $barter,
          'disk' => $disk,
          'radar' => $radar,
          'camera' => $camera,
          'qapanma' => $qapanma,
          'lampa' => $lampa,
          'leather' => $leather,
          'lyuk' => $lyuk,
          'isidilme' => $isidilme,
          'abs' => $abs,
          'kondisioner' => $kondisioner,
          'sensor' => $sensor,
          'havalandirma' => $havalandirma,
          'perde' => $perde,
          'esp' => $esp,
          'order' => $order,
          'fuel' => $fuel,
          'transmission' => $transmission,
          'drive' => $drive
        );

        $data['premium_list'] = $this->PagesModel->get_main_list_top($vars, ' and (premium = 1 or u.unlimited = 1)', 12, 'car.premium_update_date desc');
        $data['vip_list'] = $this->PagesModel->get_main_list_top($vars, ' and  (vip = 1 or u.unlimited = 1)', 8, 'car.vip_update_date desc');
        $data['simple_list'] = $this->main_pagination_data(array('simple_list' => $this->PagesModel->get_main_list($vars, '', 12), 'webp' => $this->webp));
        $data['simple_list_count'] = $this->PagesModel->get_main_list_count($vars, '');

        $header = $this->header_data();
        $content = array_merge($data, $header);

        // $this->load->view('site/main_header', $content);
        // $this->load->view('site/view_header');
        $this->load->view('site/tez_header', $content);
        $this->load->view('Pages/'.$pg);
        $this->load->view('site/footer');
      }

      public function main_pagination_data($data)
      {
        return $this->load->view("/Pages/pagination_view", $data, TRUE);
      }

      public function main_pagination()
      {
        if ($this->input->post())
        {
          $mark_array = $model_array = $body_array = $color_array = $city_array = $fuel_array = $transmission_array = $drive_array = [];
          $mark = $model = $body = $color = $city = $search = 0;
          $min_mileage = $max_mileage = $currency = $min_price = $max_price = $min_year = $max_year = $min_engine = $max_engine = 0;
          $credit = $barter = $disk = $radar = $camera = $qapanma = $lampa = $leather = $lyuk = $isidilme = $abs = $kondisioner = $sensor = $havalandirma = $perde = $esp = 0;
          $order = $fuel = $transmission = $drive = '';

          if($this->input->get())
          {
            $filtered_get = $this->filter_data($this->input->get());
            $order = $this->input->get('order')?$filtered_get['order']:'';

            $b = @$this->input->get('mark');
            if (isset($b)) {
              $search = 1;
              $mark = $filtered_get['mark']?(int)$filtered_get['mark']:0;
              $model = $filtered_get['model']?(int)$filtered_get['model']:0;
              $data['filter_mark2'] = (int) $filtered_get['mark'];
              $data['filter_model2'] = (int) $filtered_get['model'];
              $data['filter_mark_name'] = $this->universal_model->get_more_item_select_row('carmark', 'mark', array('id' => $mark));
              $data['filter_model_name'] = $this->universal_model->get_more_item_select_row('carmodel', 'model', array('id' => $model));
            }
            $city = $this->input->get('city')?(int)$filtered_get['city']:0;

            $a = @$this->input->get('min_engine');
            if(isset($a))
            {
              $search = 1;
              $mark_array = $this->input->get('mark_array')?$filtered_get['mark_array']:[];
              $mark = $mark_array?implode(',', $mark_array):0;
              $model_array = $this->input->get('model_array')?$filtered_get['model_array']:[];
              $model = $model_array?implode(',', $model_array):0;
              $body_array = $this->input->get('body')?$filtered_get['body']:[];
              $body = $body_array?implode(',', $body_array):0;
              $color_array = $this->input->get('color')?$filtered_get['color']:[];
              $color = $color_array?implode(',', $color_array):0;
              $city_array = $this->input->get('city_array')?$filtered_get['city_array']:[];
              $city = $city_array?implode(',', $city_array):0;
              $fuel_array = $this->input->get('fuel')?$filtered_get['fuel']:[];
              $fuel = $fuel_array?'"'.implode('","', $fuel_array).'"':'';
              $transmission_array = $this->input->get('transmission')?$filtered_get['transmission']:[];
              $transmission = $transmission_array?'"'.implode('","', $transmission_array).'"':'';
              $drive_array = $this->input->get('drive')?$filtered_get['drive']:[];
              $drive = $drive_array?'"'.implode('","', $drive_array).'"':'';

              $min_mileage = (int)$filtered_get['min_mileage'];
              $max_mileage = (int)$filtered_get['max_mileage'];
              $min_engine = (int)$filtered_get['min_engine'];
              $max_engine = (int)$filtered_get['max_engine'];

    					$disk = $this->input->get('disk')?1:0;
    					$radar = $this->input->get('radar')?1:0;
    					$camera = $this->input->get('camera')?1:0;
    					$qapanma = $this->input->get('qapanma')?1:0;
    					$lampa = $this->input->get('lampa')?1:0;
    					$leather = $this->input->get('leather')?1:0;
    					$lyuk = $this->input->get('lyuk')?1:0;
    					$isidilme = $this->input->get('isidilme')?1:0;
    					$abs = $this->input->get('abs')?1:0;
    					$kondisioner = $this->input->get('kondisioner')?1:0;
    					$sensor = $this->input->get('sensor')?1:0;
    					$havalandirma = $this->input->get('havalandirma')?1:0;
    					$perde = $this->input->get('perde')?1:0;
    					$esp = $this->input->get('esp')?1:0;
            }

            $v = @$this->input->get('min_year');
            if (isset($v)) {
              $currency = (int) $filtered_get['currency'];
              $min_price = (int) $filtered_get['min_price'];
              $max_price = (int) $filtered_get['max_price'];
              $min_year = (int) $filtered_get['min_year'];
              $max_year = (int) $filtered_get['max_year'];
              $credit = $this->input->get('credit')?1:0;
              $barter = $this->input->get('barter')?1:0;
            }
          }

          $vars = array(
            'mark' => $mark,
            'model' => $model,
            'body' => $body,
            'color' => $color,
            'city' => $city,
            'min_mileage' => $min_mileage,
            'max_mileage' => $max_mileage,
            'currency' => $currency,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'min_year' => $min_year,
            'max_year' => $max_year,
            'min_engine' => $min_engine,
            'max_engine' => $max_engine,
            'credit' => $credit,
            'barter' => $barter,
            'disk' => $disk,
            'radar' => $radar,
            'camera' => $camera,
            'qapanma' => $qapanma,
            'lampa' => $lampa,
            'leather' => $leather,
            'lyuk' => $lyuk,
            'isidilme' => $isidilme,
            'abs' => $abs,
            'kondisioner' => $kondisioner,
            'sensor' => $sensor,
            'havalandirma' => $havalandirma,
            'perde' => $perde,
            'esp' => $esp,
            'order' => $order,
            'fuel' => $fuel,
            'transmission' => $transmission,
            'drive' => $drive
          );

          $from = (int) $this->input->post('from');
          $data = $this->main_pagination_data(array('simple_list' => $this->PagesModel->get_main_list($vars, '', $from.', 12'), 'webp' => $this->webp));

          echo json_encode(array('otomoto' => $this->security->get_csrf_hash(), 'data' => $data, 'webp' => $this->webp));
        }
      }

      public function rent_car()
      {
        // if(@$this->session->userdata['uid'] == 1207)
        //   $this->output->enable_profiler(true);

        $mark_array = $model_array = $body_array = $color_array = $city_array = $fuel_array = $transmission_array = $drive_array = [];
        $class = $mark = $model = $body = $color = $city = $search = $rec_pass = 0;
        $min_mileage = $max_mileage = $currency = $min_price = $max_price = $min_year = $max_year = $min_engine = $max_engine = 0;
        $disk = $radar = $camera = $qapanma = $lampa = $leather = $lyuk = $isidilme = $abs = $kondisioner = $sensor = $havalandirma = $perde = $esp = 0;0;
        $min_limitation = $max_limitation = $min_deposit = $max_deposit = $min_included_km = $max_included_km = 0;
        $delivery = $returning = $baby_chair = $insurance = $roof_rack = 0;
        $order = $fuel = $transmission = $drive = '';

        if($this->input->get())
        {
          $filtered_get = $this->filter_data($this->input->get());
          $order = $this->input->get('order')?$filtered_get['order']:'';
          $search = $data['all_ads'] = $this->input->get('search')?1:0;

          $b = @$this->input->get('mark');
          if (isset($b)) {
            $search = 1;
            $mark = $filtered_get['mark']?(int)$filtered_get['mark']:0;
            $model = $filtered_get['model']?(int)$filtered_get['model']:0;
            $class = @$filtered_get['class']?(int)$filtered_get['class']:0;
            $data['filter_mark2'] = (int) $filtered_get['mark'];
            $data['filter_model2'] = (int) $filtered_get['model'];
            $data['filter_mark_name'] = $this->universal_model->get_more_item_select_row('carmark', 'mark', array('id' => $mark));
            $data['filter_model_name'] = $this->universal_model->get_more_item_select_row('carmodel', 'model', array('id' => $model));
          }
          $city = $this->input->get('city')?(int)$filtered_get['city']:0;

          $a = @$this->input->get('min_engine');
          if(isset($a))
          {
            $search = 1;
            $mark_array = $this->input->get('mark_array')?$filtered_get['mark_array']:[];
            $mark = $mark_array?implode(',', $mark_array):$mark;
            $model_array = $this->input->get('model_array')?$filtered_get['model_array']:[];
            $model = $model_array?implode(',', $model_array):$model;
            $body_array = $this->input->get('body')?$filtered_get['body']:[];
            $body = ($body_array && @$body_array[0])?implode(',', $body_array):0;
            $color_array = $this->input->get('color')?$filtered_get['color']:[];
            $color = ($color_array && @$color_array[0])?implode(',', $color_array):0;
            $city_array = $this->input->get('city_array')?$filtered_get['city_array']:[];
            $city = ($city_array && @$city_array[0])?implode(',', $city_array):0;
            $fuel_array = $this->input->get('fuel')?$filtered_get['fuel']:[];
            $fuel = ($fuel_array && @$fuel_array[0])?'"'.implode('","', $fuel_array).'"':'';
            $transmission_array = $this->input->get('transmission')?$filtered_get['transmission']:[];
            $transmission = ($transmission_array && @$transmission_array[0])?'"'.implode('","', $transmission_array).'"':'';

            $min_included_km = (int) $filtered_get['min_included_km'];
            $max_included_km = (int) $filtered_get['max_included_km'];
            $min_deposit = (int) $filtered_get['min_deposit'];
            $max_deposit = (int) $filtered_get['max_deposit'];
            $min_limitation = (int) $filtered_get['min_limitation'];
            $max_limitation = (int) $filtered_get['max_limitation'];

  					$disk = $this->input->get('disk')?1:0;
  					$radar = $this->input->get('radar')?1:0;
  					$camera = $this->input->get('camera')?1:0;
  					$qapanma = $this->input->get('qapanma')?1:0;
  					$lampa = $this->input->get('lampa')?1:0;
  					$leather = $this->input->get('leather')?1:0;
  					$lyuk = $this->input->get('lyuk')?1:0;
  					$isidilme = $this->input->get('isidilme')?1:0;
  					$abs = $this->input->get('abs')?1:0;
  					$kondisioner = $this->input->get('kondisioner')?1:0;
  					$sensor = $this->input->get('sensor')?1:0;
  					$havalandirma = $this->input->get('havalandirma')?1:0;
  					$perde = $this->input->get('perde')?1:0;
  					$esp = $this->input->get('esp')?1:0;
            $insurance = $this->input->get('insurance')?1:0;
            $baby_chair = $this->input->get('baby_chair')?1:0;
            $roof_rack = $this->input->get('roof_rack')?1:0;
          }

          $v = @$this->input->get('min_year');
          if (isset($v)) {
            $currency = (int) $filtered_get['currency'];
            $min_price = (int) $filtered_get['min_price'];
            $max_price = (int) $filtered_get['max_price'];
            $min_year = (int) $filtered_get['min_year'];
            $max_year = (int) $filtered_get['max_year'];
            $delivery = $this->input->get('delivery')?1:0;
            $returning = $this->input->get('returning')?1:0;
          }

          $rec_pass = $this->input->get('rec_pass')?(int)$this->input->get('rec_pass'):0;
        }

        $data['title'] = 'rent_car';
        $data['order'] = $order;
        $data['filter_mark'] = $mark;
        $data['filter_class'] = $class;
        $data['filter_model_list'] = $this->universal_model->get_more_item_select('carmodel', 'id, model', 'active = 1'.($mark?' and markid in ('.$mark.')':' and markid = -1'), 0, array('model', 'asc'));
        $data['filter_model'] = $model;
        $data['filter_currency'] = $currency;
        $data['filter_min_price'] = $min_price;
        $data['filter_max_price'] = $max_price;
        $data['filter_min_year'] = $min_year;
        $data['filter_max_year'] = $max_year;
        $data['filter_city'] = $city;
        $data['filter_delivery'] = $delivery;
        $data['filter_returning'] = $returning;

        if ($this->cache->get('mark_list')) {
          $cache_mark_list = $this->cache->get('mark_list');
        } else {
          $cache_mark_list = $this->PagesModel->get_marks('');
          $this->cache->write($cache_mark_list, 'mark_list');
        }

        if ($this->cache->get('popular_mark_list')) {
          $cache_popular_mark_list = $this->cache->get('popular_mark_list');
        } else {
          $cache_popular_mark_list = $this->PagesModel->get_marks(' and popular = 1');
          $this->cache->write($cache_popular_mark_list, 'popular_mark_list');
        }

        if ($this->cache->get('city_list')) {
          $cache_city_list = $this->cache->get('city_list');
        } else {
          $cache_city_list = $this->universal_model->get_more_item_select('elancities', 'id, ad', array('active' => 1));
          $this->cache->write($cache_city_list, 'city_list');
        }

        $data['mark'] = $cache_mark_list;
        $data['popular_mark'] = $cache_popular_mark_list;
        $data['city'] = $cache_city_list;
        $data['total_row'] = $this->PagesModel->get_rent_cars_total_row()->count;
        $data['search'] = $search;
        $data['rec_pass'] = $rec_pass;

        $vars = array(
          'mark' => $mark,
          'model' => $model,
          'class' => $class,
          'body' => $body,
          'color' => $color,
          'city' => $city,
          'currency' => $currency,
          'min_price' => $min_price,
          'max_price' => $max_price,
          'min_year' => $min_year,
          'max_year' => $max_year,
          'disk' => $disk,
          'radar' => $radar,
          'camera' => $camera,
          'qapanma' => $qapanma,
          'lampa' => $lampa,
          'leather' => $leather,
          'lyuk' => $lyuk,
          'isidilme' => $isidilme,
          'abs' => $abs,
          'kondisioner' => $kondisioner,
          'sensor' => $sensor,
          'havalandirma' => $havalandirma,
          'perde' => $perde,
          'esp' => $esp,
          'order' => $order,
          'fuel' => $fuel,
          'transmission' => $transmission,
          'min_included_km' => $min_included_km,
          'max_included_km' => $max_included_km,
          'min_deposit' => $min_deposit,
          'max_deposit' => $max_deposit,
          'min_limitation' => $min_limitation,
          'max_limitation' => $max_limitation,
          'insurance' => $insurance,
          'baby_chair' => $baby_chair,
          'roof_rack' => $roof_rack,
          'delivery' => $delivery,
          'returning' => $returning
        );

        $data['premium_list'] = $this->PagesModel->get_rent_main_list_top($vars, ' and premium=1', 12, 'car.premium_update_date desc');
        $data['vip_list'] = $this->PagesModel->get_rent_main_list_top($vars, ' and vip=1', 8, 'car.vip_update_date desc');
        $data['simple_list'] = $this->rent_main_pagination_data(array('simple_list' => $this->PagesModel->get_rent_main_list($vars, '', 12), 'webp' => $this->webp));
        $data['simple_list_count'] = $this->PagesModel->get_rent_main_list_count($vars, '');
        $data['classes'] = $this->PagesModel->get_classes();

        $header = $this->header_data();
        $content = array_merge($data, $header);

        // $this->load->view('site/main_header', $content);
        // $this->load->view('site/view_header');
        $this->load->view('site/tez_header', $content);
        $this->load->view('Pages/rent_car');
        $this->load->view('site/footer');
      }

      public function rent_main_pagination_data($data)
      {
        return $this->load->view("/Pages/rent_pagination_view", $data, TRUE);
      }

      public function rent_main_pagination()
      {
        if ($this->input->post())
        {
          $mark_array = $model_array = $body_array = $color_array = $city_array = $fuel_array = $transmission_array = $drive_array = [];
          $class = $mark = $model = $body = $color = $city = $search = $delivery = $returning = $baby_chair = $roof_rack = $insurance = 0;
          $min_mileage = $max_mileage = $currency = $min_price = $max_price = $min_year = $max_year = $min_engine = $max_engine = 0;
          $disk = $radar = $camera = $qapanma = $lampa = $leather = $lyuk = $isidilme = $abs = $kondisioner = $sensor = $havalandirma = $perde = $esp = 0;
          $min_included_km = $max_included_km = $min_deposit = $max_deposit = $min_limitation = $max_limitation = 0;
          $order = $fuel = $transmission = $drive = '';

          if($this->input->get())
          {
            $filtered_get = $this->filter_data($this->input->get());
            $order = $this->input->get('order')?$filtered_get['order']:'';

            $b = @$this->input->get('mark');
            if (isset($b)) {
              $search = 1;
              $mark = $filtered_get['mark']?(int)$filtered_get['mark']:0;
              $model = $filtered_get['model']?(int)$filtered_get['model']:0;
              $class = $filtered_get['class']?(int)$filtered_get['class']:0;
              $data['filter_mark2'] = (int) $filtered_get['mark'];
              $data['filter_model2'] = (int) $filtered_get['model'];
              $data['filter_mark_name'] = $this->universal_model->get_more_item_select_row('carmark', 'mark', array('id' => $mark));
              $data['filter_model_name'] = $this->universal_model->get_more_item_select_row('carmodel', 'model', array('id' => $model));
            }
            $city = $this->input->get('city')?(int)$filtered_get['city']:0;

            $a = @$this->input->get('min_engine');
            if(isset($a))
            {
              $search = 1;
              $mark_array = $this->input->get('mark_array')?$filtered_get['mark_array']:[];
              $mark = $mark_array?implode(',', $mark_array):0;
              $model_array = $this->input->get('model_array')?$filtered_get['model_array']:[];
              $model = $model_array?implode(',', $model_array):0;
              $body_array = $this->input->get('body')?$filtered_get['body']:[];
              $body = $body_array?implode(',', $body_array):0;
              $color_array = $this->input->get('color')?$filtered_get['color']:[];
              $color = $color_array?implode(',', $color_array):0;
              $city_array = $this->input->get('city_array')?$filtered_get['city_array']:[];
              $city = $city_array?implode(',', $city_array):0;
              $fuel_array = $this->input->get('fuel')?$filtered_get['fuel']:[];
              $fuel = $fuel_array?'"'.implode('","', $fuel_array).'"':'';
              $transmission_array = $this->input->get('transmission')?$filtered_get['transmission']:[];
              $transmission = $transmission_array?'"'.implode('","', $transmission_array).'"':'';

              $min_included_km = (int) $filtered_get['min_included_km'];
              $max_included_km = (int) $filtered_get['max_included_km'];
              $min_deposit = (int) $filtered_get['min_deposit'];
              $max_deposit = (int) $filtered_get['max_deposit'];
              $min_limitation = (int) $filtered_get['min_limitation'];
              $max_limitation = (int) $filtered_get['max_limitation'];

    					$disk = $this->input->get('disk')?1:0;
    					$radar = $this->input->get('radar')?1:0;
    					$camera = $this->input->get('camera')?1:0;
    					$qapanma = $this->input->get('qapanma')?1:0;
    					$lampa = $this->input->get('lampa')?1:0;
    					$leather = $this->input->get('leather')?1:0;
    					$lyuk = $this->input->get('lyuk')?1:0;
    					$isidilme = $this->input->get('isidilme')?1:0;
    					$abs = $this->input->get('abs')?1:0;
    					$kondisioner = $this->input->get('kondisioner')?1:0;
    					$sensor = $this->input->get('sensor')?1:0;
    					$havalandirma = $this->input->get('havalandirma')?1:0;
    					$perde = $this->input->get('perde')?1:0;
    					$esp = $this->input->get('esp')?1:0;
              $insurance = $this->input->get('insurance')?1:0;
              $baby_chair = $this->input->get('baby_chair')?1:0;
              $roof_rack = $this->input->get('roof_rack')?1:0;
            }

            $v = @$this->input->get('min_year');
            if (isset($v)) {
              $currency = (int) $filtered_get['currency'];
              $min_price = (int) $filtered_get['min_price'];
              $max_price = (int) $filtered_get['max_price'];
              $min_year = (int) $filtered_get['min_year'];
              $max_year = (int) $filtered_get['max_year'];
              $delivery = $this->input->get('delivery')?1:0;
              $returning = $this->input->get('returning')?1:0;
            }
          }

          $vars = array(
            'mark' => $mark,
            'model' => $model,
            'class' => $class,
            'body' => $body,
            'color' => $color,
            'city' => $city,
            'currency' => $currency,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'min_year' => $min_year,
            'max_year' => $max_year,
            'disk' => $disk,
            'radar' => $radar,
            'camera' => $camera,
            'qapanma' => $qapanma,
            'lampa' => $lampa,
            'leather' => $leather,
            'lyuk' => $lyuk,
            'isidilme' => $isidilme,
            'abs' => $abs,
            'kondisioner' => $kondisioner,
            'sensor' => $sensor,
            'havalandirma' => $havalandirma,
            'perde' => $perde,
            'esp' => $esp,
            'order' => $order,
            'fuel' => $fuel,
            'transmission' => $transmission,
            'min_included_km' => $min_included_km,
            'max_included_km' => $max_included_km,
            'min_deposit' => $min_deposit,
            'max_deposit' => $max_deposit,
            'min_limitation' => $min_limitation,
            'max_limitation' => $max_limitation,
            'insurance' => $insurance,
            'baby_chair' => $baby_chair,
            'roof_rack' => $roof_rack,
            'delivery' => $delivery,
            'returning' => $returning
          );

          $from = (int) $this->input->post('from');
          $data = $this->rent_main_pagination_data(array('simple_list' => $this->PagesModel->get_rent_main_list($vars, '', $from.', 12'), 'webp' => $this->webp));

          echo json_encode(array('otomoto' => $this->security->get_csrf_hash(), 'data' => $data, 'webp' => $this->webp));
        }
      }

      public function get_model_list2()
    	{
    		if($this->input->post())
    		{
    			$filtered_post = $this->filter_data($this->input->post());

    			$mark = (int) $filtered_post['mark'];
    			$data['model'] = $this->universal_model->get_more_item_select('carmodel', 'id, model', array('active' => 1, 'markid' => $mark));
    			$data['otomoto'] = $this->security->get_csrf_hash();

    			echo json_encode($data);
    		}
    	}

      public function get_model_list3()
    	{
    		if($this->input->post())
    		{
    			$filtered_post = $this->filter_data($this->input->post());

    			$mark = (int) $filtered_post['mark'];
    			$data['model'] = $this->PagesModel->get_model_list($mark);
    			$data['otomoto'] = $this->security->get_csrf_hash();

    			echo json_encode($data);
    		}
    	}

      public function get_rent_model_list3()
    	{
    		if($this->input->post())
    		{
    			$filtered_post = $this->filter_data($this->input->post());

    			$mark = (int) $filtered_post['mark'];
    			$data['model'] = $this->PagesModel->get_rent_model_list($mark);
    			$data['otomoto'] = $this->security->get_csrf_hash();

    			echo json_encode($data);
    		}
    	}

      public function get_rent_mark_list()
    	{
    		if($this->input->post())
    		{
          // $this->output->enable_profiler(true);
    			$filtered_post = $this->filter_data($this->input->post());

    			$class = (int) $filtered_post['class'];
    			$data['mark'] = $this->PagesModel->get_rent_mark_list($class);
    			$data['otomoto'] = $this->security->get_csrf_hash();

    			echo json_encode($data);
    		}
    	}

      public function get_years_list()
    	{
    		if($this->input->post())
    		{
          // if(@$this->session->userdata('uid') == 1207)
          //   $this->output->enable_profiler(true);

          $filtered_post = $this->filter_data($this->input->post());

    			$mark = (int) $filtered_post['mark'];
          $model = (int) $filtered_post['model'];
    			$data['years'] = $this->PagesModel->get_year_list($mark, $model);
    			$data['otomoto'] = $this->security->get_csrf_hash();

    			echo json_encode($data);
    		}
    	}

      public function get_rent_years_list()
    	{
    		if($this->input->post())
    		{
          $filtered_post = $this->filter_data($this->input->post());

    			$mark = (int) $filtered_post['mark'];
          $model = (int) $filtered_post['model'];
    			$data['years'] = $this->PagesModel->get_rent_year_list($mark, $model);
    			$data['otomoto'] = $this->security->get_csrf_hash();

    			echo json_encode($data);
    		}
    	}

      public function detailed_search()
      {
        $this->counter();

        $mark_array = $model_array = $body = $color = $city_array = $fuel = $transmission = $drive = [];
        $mark = $min_mileage = $max_mileage = $currency = $min_price = $max_price = $min_year = $max_year = $min_engine = $max_engine = 0;
        $credit = $barter = $disk = $radar = $camera = $qapanma = $lampa = $leather = $lyuk = $isidilme = $abs = $kondisioner = $sensor = $havalandirma = $perde = $esp = 0;
        $order = $filter_mark2 = $filter_model2 = $filter_mark_name = $filter_model_name = '';

        if($this->input->get())
        {
          $filtered_get = $this->filter_data($this->input->get());

          $a = @$this->input->get('min_mileage');
          if(isset($a))
          {
            $mark_array = $this->input->get('mark_array')?$filtered_get['mark_array']:[];
            $mark = $mark_array?implode(',', $mark_array):0;
            $model_array = $this->input->get('model_array')?$filtered_get['model_array']:[];
            $body = $this->input->get('body')?$filtered_get['body']:[];
            $color = $this->input->get('color')?$filtered_get['color']:[];
            $city_array = $this->input->get('city_array')?$filtered_get['city_array']:[];
            $fuel = $this->input->get('fuel')?$filtered_get['fuel']:[];
            $transmission = $this->input->get('transmission')?$filtered_get['transmission']:[];
            $drive = $this->input->get('drive')?$filtered_get['drive']:[];

            $min_mileage = (int)$filtered_get['min_mileage'];
            $max_mileage = (int)$filtered_get['max_mileage'];
            $min_engine = (int)$filtered_get['min_engine'];
            $max_engine = (int)$filtered_get['max_engine'];

  					$credit = $this->input->get('credit')?1:0;
  					$barter = $this->input->get('barter')?1:0;
  					$disk = $this->input->get('disk')?1:0;
  					$radar = $this->input->get('radar')?1:0;
  					$camera = $this->input->get('camera')?1:0;
  					$qapanma = $this->input->get('qapanma')?1:0;
  					$lampa = $this->input->get('lampa')?1:0;
  					$leather = $this->input->get('leather')?1:0;
  					$lyuk = $this->input->get('lyuk')?1:0;
  					$isidilme = $this->input->get('isidilme')?1:0;
  					$abs = $this->input->get('abs')?1:0;
  					$kondisioner = $this->input->get('kondisioner')?1:0;
  					$sensor = $this->input->get('sensor')?1:0;
  					$havalandirma = $this->input->get('havalandirma')?1:0;
  					$perde = $this->input->get('perde')?1:0;
  					$esp = $this->input->get('esp')?1:0;
            $order = $this->input->get('order');
          }

          $b = @$this->input->get('currency');
          if(isset($b))
          {
            $currency = (int)$filtered_get['currency'];
            $min_price = (int)$filtered_get['min_price'];
            $max_price = (int)$filtered_get['max_price'];
            $min_year = (int)$filtered_get['min_year'];
            $max_year = (int)$filtered_get['max_year'];
          }

          $v = @$this->input->get('model');
          if(isset($v)) {
            $filter_mark2 = (int) $filtered_get['mark'];
            $filter_model2 = (int) $filtered_get['model'];
            $filter_mark_name = $this->universal_model->get_more_item_select_row('carmark', 'mark', array('id' => $filter_mark2));
            $filter_model_name = $this->universal_model->get_more_item_select_row('carmodel', 'model', array('id' => $filter_model2));
          }
        }

        $data = array(
          'mark_array' => $mark_array,
          'model_array' => $model_array,
          'body_array' => $body,
          'color_array' => $color,
          'city_array' => $city_array,
          'fuel_array' => $fuel,
          'transmission_array' => $transmission,
          'drive_array' => $drive,
          'min_mileage' => $min_mileage,
          'max_mileage' => $max_mileage,
          'currency' => $currency,
          'min_price' => $min_price,
          'max_price' => $max_price,
          'min_year' => $min_year,
          'max_year' => $max_year,
          'min_engine' => $min_engine,
          'max_engine' => $max_engine,
          'credit' => $credit,
          'barter' => $barter,
          'disk' => $disk,
          'radar' => $radar,
          'camera' => $camera,
          'qapanma' => $qapanma,
          'lampa' => $lampa,
          'leather' => $leather,
          'lyuk' => $lyuk,
          'isidilme' => $isidilme,
          'abs' => $abs,
          'kondisioner' => $kondisioner,
          'sensor' => $sensor,
          'havalandirma' => $havalandirma,
          'perde' => $perde,
          'esp' => $esp,
          'order' => $order,
          'filter_mark2' => $filter_mark2,
          'filter_model2' => $filter_model2,
          'filter_mark_name' => $filter_mark_name,
          'filter_model_name' => $filter_model_name
        );

        $data['title'] = 'detailed_search';
        $data['popular_mark'] = $this->cache->get('popular_mark_list');
        $data['mark'] = $this->cache->get('mark_list');
        $data['model'] = $this->universal_model->get_more_item_select('carmodel', 'id, model', 'active = 1 and markid in ('.$mark.')');
        $data['city'] = $this->cache->get('city_list');

        if($this->cache->get('body_list')) {
          $cache_body_list = $this->cache->get('body_list');
        } else {
          $cache_body_list = $this->universal_model->get_more_item_select('carbody', 'id, body', array('active' => 1));
          $this->cache->write($cache_body_list, 'body_list');
        }
    		$data['body'] = $cache_body_list;

        if($this->cache->get('engine_list')) {
          $cache_engine_list = $this->cache->get('engine_list');
        } else {
          $cache_engine_list = $this->universal_model->get_more_item_select('carengine', 'id, engine', array('active' => 1));
          $this->cache->write($cache_engine_list, 'engine_list');
        }
    		$data['engine'] = $cache_engine_list;

    		$data['fuel'] = ['Benzin', 'Dizel', 'Qaz', 'Elektro', 'Hibrid'];
    		$data['transmission'] = ['Mexaniki', 'Avtomat', 'Robotlaşdırılmış', 'Variator'];
    		$data['drive'] = ['Arxa', 'Ön', 'Tam'];

        if($this->cache->get('color_list')) {
          $cache_color_list = $this->cache->get('color_list');
        } else {
          $cache_color_list = $this->universal_model->get_more_item_select('carcolor', 'id, color', array('active' => 1));
          $this->cache->write($cache_color_list, 'color_list');
        }
    		$data['color'] = $cache_color_list;

        $header = $this->header_data();
        $content = array_merge($data, $header);

        $this->load->view('site/tez_header', $content);
        $this->load->view('Pages/detailed_search');
        $this->load->view('site/footer');
      }

      public function rent_detailed_search()
      {
        $this->counter();

        $mark_array = $model_array = $body = $color = $city_array = $fuel = $transmission = $drive = [];
        $class = $mark = $min_mileage = $max_mileage = $currency = $min_price = $max_price = $min_year = $max_year = $min_engine = $max_engine = 0;
        $delivery = $returning = $baby_chair = $roof_rack = $insurance = 0;
        $min_included_km = $max_included_km = $min_deposit = $max_deposit = $min_limitation = $max_limitation = 0;
        $disk = $radar = $camera = $qapanma = $lampa = $leather = $lyuk = $isidilme = $abs = $kondisioner = $sensor = $havalandirma = $perde = $esp = 0;
        $order = $filter_mark2 = $filter_model2 = $filter_mark_name = $filter_model_name = $filter_class = '';

        if($this->input->get())
        {
          $filtered_get = $this->filter_data($this->input->get());
          $class = $this->input->get('class')?$filtered_get['class']:0;

          $a = @$this->input->get('min_mileage');
          if(isset($a))
          {
            $mark_array = $this->input->get('mark_array')?$filtered_get['mark_array']:($this->input->get('mark')?array($filtered_get['mark']):[]);
            $mark = $mark_array?implode(',', $mark_array):0;
            $model_array = $this->input->get('model_array')?$filtered_get['model_array']:[];
            $body = $this->input->get('body')?$filtered_get['body']:[];
            $color = $this->input->get('color')?$filtered_get['color']:[];
            $city_array = $this->input->get('city_array')?$filtered_get['city_array']:[];
            $fuel = $this->input->get('fuel')?$filtered_get['fuel']:[];
            $transmission = $this->input->get('transmission')?$filtered_get['transmission']:[];

            $min_included_km = (int) $filtered_get['min_included_km'];
            $max_included_km = (int) $filtered_get['max_included_km'];
            $min_deposit = (int) $filtered_get['min_deposit'];
            $max_deposit = (int) $filtered_get['max_deposit'];
            $min_limitation = (int) $filtered_get['min_limitation'];
            $max_limitation = (int) $filtered_get['max_limitation'];

  					$disk = $this->input->get('disk')?1:0;
  					$radar = $this->input->get('radar')?1:0;
  					$camera = $this->input->get('camera')?1:0;
  					$qapanma = $this->input->get('qapanma')?1:0;
  					$lampa = $this->input->get('lampa')?1:0;
  					$leather = $this->input->get('leather')?1:0;
  					$lyuk = $this->input->get('lyuk')?1:0;
  					$isidilme = $this->input->get('isidilme')?1:0;
  					$abs = $this->input->get('abs')?1:0;
  					$kondisioner = $this->input->get('kondisioner')?1:0;
  					$sensor = $this->input->get('sensor')?1:0;
  					$havalandirma = $this->input->get('havalandirma')?1:0;
  					$perde = $this->input->get('perde')?1:0;
  					$esp = $this->input->get('esp')?1:0;
            $insurance = $this->input->get('insurance')?1:0;
            $baby_chair = $this->input->get('baby_chair')?1:0;
            $roof_rack = $this->input->get('roof_rack')?1:0;
            $order = $this->input->get('order');
          }

          $b = @$this->input->get('currency');
          if(isset($b))
          {
            $currency = (int)$filtered_get['currency'];
            $min_price = (int)$filtered_get['min_price'];
            $max_price = (int)$filtered_get['max_price'];
            $min_year = (int)$filtered_get['min_year'];
            $max_year = (int)$filtered_get['max_year'];
            $delivery = $this->input->get('delivery')?1:0;
            $returning = $this->input->get('returning')?1:0;
          }

          $v = @$this->input->get('model');
          if(isset($v)) {
            $filter_mark2 = (int) $filtered_get['mark'];
            $filter_model2 = (int) $filtered_get['model'];
            $filter_mark_name = $this->universal_model->get_more_item_select_row('carmark', 'mark', array('id' => $filter_mark2));
            $filter_model_name = $this->universal_model->get_more_item_select_row('carmodel', 'model', array('id' => $filter_model2));
          }
        }

        $data = array(
          'mark_array' => $mark_array,
          'model_array' => $model_array,
          'body_array' => $body,
          'color_array' => $color,
          'city_array' => $city_array,
          'fuel_array' => $fuel,
          'transmission_array' => $transmission,
          'currency' => $currency,
          'min_price' => $min_price,
          'max_price' => $max_price,
          'min_year' => $min_year,
          'max_year' => $max_year,
          'disk' => $disk,
          'radar' => $radar,
          'camera' => $camera,
          'qapanma' => $qapanma,
          'lampa' => $lampa,
          'leather' => $leather,
          'lyuk' => $lyuk,
          'isidilme' => $isidilme,
          'abs' => $abs,
          'kondisioner' => $kondisioner,
          'sensor' => $sensor,
          'havalandirma' => $havalandirma,
          'perde' => $perde,
          'esp' => $esp,
          'order' => $order,
          'class' => $class,
          'min_included_km' => $min_included_km,
          'max_included_km' => $max_included_km,
          'min_deposit' => $min_deposit,
          'max_deposit' => $max_deposit,
          'min_limitation' => $min_limitation,
          'max_limitation' => $max_limitation,
          'insurance' => $insurance,
          'baby_chair' => $baby_chair,
          'roof_rack' => $roof_rack,
          'delivery' => $delivery,
          'returning' => $returning,
          'filter_mark2' => $filter_mark2,
          'filter_model2' => $filter_model2,
          'filter_mark_name' => $filter_mark_name,
          'filter_model_name' => $filter_model_name
        );

        $data['title'] = 'rent_detailed_search';
        $data['popular_mark'] = $this->cache->get('popular_mark_list');
        $data['mark'] = $this->cache->get('mark_list');
        $data['model'] = $this->universal_model->get_more_item_select('carmodel', 'id, model', 'active = 1 and markid in ('.$mark.')');
        $data['city'] = $this->cache->get('city_list');
        $data['classes'] = $this->PagesModel->get_classes();

        if($this->cache->get('body_list')) {
          $cache_body_list = $this->cache->get('body_list');
        } else {
          $cache_body_list = $this->universal_model->get_more_item_select('carbody', 'id, body', array('active' => 1));
          $this->cache->write($cache_body_list, 'body_list');
        }
    		$data['body'] = $cache_body_list;

    		$data['fuel'] = ['Benzin', 'Dizel', 'Qaz', 'Elektro', 'Hibrid'];
    		$data['transmission'] = ['Mexaniki', 'Avtomat', 'Robotlaşdırılmış', 'Variator'];

        if($this->cache->get('color_list')) {
          $cache_color_list = $this->cache->get('color_list');
        } else {
          $cache_color_list = $this->universal_model->get_more_item_select('carcolor', 'id, color', array('active' => 1));
          $this->cache->write($cache_color_list, 'color_list');
        }
    		$data['color'] = $cache_color_list;

        $header = $this->header_data();
        $content = array_merge($data, $header);

        // print_r($data);

        $this->load->view('site/tez_header', $content);
        $this->load->view('Pages/rent_detailed_search');
        $this->load->view('site/footer');
      }

      public function get_model_list()
      {
        if($this->input->post())
        {
            $mark_array = $this->filter_data(json_decode($this->input->post('mark')));
            $mark = $mark_array?implode(',', $mark_array):0;
            echo json_encode($this->universal_model->get_more_item_select('carmodel', 'id, model', 'active = 1 and markid in('.$mark.')'));
        }
      }

      public function get_detailed_search_data()
      {
    		$data['city'] = $this->universal_model->get_more_item_select('elancities', 'id, ad', array('active' => 1));
    		$data['body'] = $this->universal_model->get_more_item_select('carbody', 'id, body', array('active' => 1));
    		$data['engine'] = $this->universal_model->get_more_item_select('carengine', 'id, engine', array('active' => 1));
    		$data['fuel'] = ['Benzin', 'Dizel', 'Qaz', 'Elektro', 'Hibrid'];
    		$data['transmission'] = ['Mexaniki', 'Avtomat', 'Robotlaşdırılmış', 'Variator'];
    		$data['drive'] = ['Arxa', 'Ön', 'Tam'];
    		$data['interiorcolor'] = $this->universal_model->get_more_item_select('carinteriorcolor', 'id, interiorcolor', array('active' => 1));
    		$data['color'] = $this->universal_model->get_more_item_select('carcolor', 'id, color', array('active' => 1));

        echo json_encode($data);
      }

      public function product()
      {
        // if(@$this->session->userdata['uid'] == 1207)
        //   $this->output->enable_profiler(true);

        //$this->counter();

        $id = (int) $this->uri->segment(4);

        if ($id) {
          $check_car = $this->universal_model->get_item_where('carad', array('id' => $id, 'car_status' => 0, 'status' => 1), 'id');

          if(@$check_car && $check_car->id)
          {
            $status = '';
            $show_phone = 1;
            if ($this->input->get('status')) {
              $filtered_get = $this->filter_data($this->input->get());
              $status = $filtered_get['status'];
            }
            $data['webp'] = $this->webp;
            $data['status'] = $status;
            $data['title'] = 'product';
            $data['code'] = $this->input->get('code')?(int)$this->input->get('code'):0;

            if($this->cache->get('product_data'.$id)) {
              $cache_arr = $this->cache->get('product_data'.$id);
            } else {
              $cache_arr['images'] = $this->universal_model->get_more_item_select('carphoto', 'id, name', array('caradid' => $id, 'active' => 1, 'deleted' => 0), 0, ['location', 'asc']);
              $cache_arr['car'] = $this->PagesModel->get_product_data($id);

              $this->cache->write($cache_arr, 'product_data'.$id, 30);
            }

            $data['images'] = $cache_arr['images'];
            $data['car'] = $car = $cache_arr['car'];
            if ($car->on_auction) {
              $data['auction_offers'] = $this->PagesModel->get_auction_offers($car->auction_id);
              if ($car->authorid != $this->session->userdata('uid')) {
                if (!$car->phone_show) {
                  $check_selled = $this->universal_model->get_item_where('auction_offers', array('auction_id' => $car->auction_id, 'selled' => 1), 'user_id');

                  if ($check_selled) {
                    $show_phone = ($check_selled->user_id == $this->session->userdata('uid'))?1:0;
                  } else {
                    $show_phone = 0;
                  }
                }
                else {
                  if (!$car->participants) {
                    $users_array = $this->PagesModel->get_auction_users($car->auction_id);
                    if ($users_array) {
                      $show_phone = 0;
                      foreach ($users_array as $row) {
                        if ($row->user_id == $this->session->userdata('uid'))
                          $show_phone = 1;
                      }
                    }
                  }
                }
              }
            }
            $data['fuel'] = ['Benzin', 'Dizel', 'Qaz', 'Elektro', 'Hibrid'];
            $data['transmission'] = ['Mexaniki', 'Avtomat', 'Robotlaşdırılmış', 'Variator'];
        		$data['drive'] = ['Arxa', 'Ön', 'Tam'];
            $data['show_phone'] = $show_phone;
            $data['array'] = array(
              ['for_if' => $car->wheels, 'for_echo' => 'Yüngül lehimli disklər'],
              ['for_if' => $car->parkingsensor, 'for_echo' => 'Park radarı'],
              ['for_if' => $car->camera, 'for_echo' => 'Arxa görüntü kamerası'],
              ['for_if' => $car->centrallocking, 'for_echo' => 'Mərkəzi qapanma'],
              ['for_if' => $car->xenon, 'for_echo' => 'Ksenon lampalar'],
              ['for_if' => $car->leather, 'for_echo' => 'Dəri salon'],
              ['for_if' => $car->sunproof, 'for_echo' => 'Lyuk'],
              ['for_if' => $car->heatedseats, 'for_echo' => 'Oturacaqların isidilməsi'],
              ['for_if' => $car->abs, 'for_echo' => 'ABS'],
              ['for_if' => $car->aircondition, 'for_echo' => 'Kondisioner'],
              ['for_if' => $car->rainsensor, 'for_echo' => 'Yağış sensoru'],
              ['for_if' => $car->seatventilation, 'for_echo' => 'Oturacaqların havalandırılması'],
              ['for_if' => $car->sidecurtains, 'for_echo' => 'Yan pərdələr'],
              ['for_if' => $car->esp, 'for_echo' => 'ESP'],
            );

            if ($car->autosalon) {
              $data['showroom'] = $this->PagesModel->get_showroom_data($car->authorid);
              $data['similar'] = $similar_arr = $this->PagesModel->get_similar_ads('car.authorid = '.$car->authorid.' and car.id != '.$id, 10);
              $similar_count = $this->PagesModel->get_similar_ads_count('car.authorid = '.$car->authorid.' and car.id != '.$id);
            } else {
              $similar_arr = $this->PagesModel->get_similar_ads('car.model = '.$car->model_id.' and car.id != '.$id, 10);
              $similar = $similar_arr?$similar_arr:[];

              if (count($similar_arr) < 10)
                $similar2 = $this->PagesModel->get_similar_ads('car.model != '.$car->model_id.' and car.mark = '.$car->mark_id.' and car.id != '.$id, 10 - count($similar_arr));
              else
                $similar2 = [];

              $data['similar'] = array_merge($similar, $similar2);
              $similar_count = $this->PagesModel->get_similar_ads_count('car.model ='.$car->model_id.' and car.id != '.$id);
            }

            if ($similar_count)
              $data['show_more'] = ($similar_count->count > 10)?1:0;
            else
              $data['show_more'] = 0;

            $header = $this->header_data();
            $content = array_merge($data, $header);

            $this->load->view('site/tez_header', $content);
            $this->load->view('Pages/product');
            $this->load->view('site/footer');
          } else {
            echo "<h3>".$id." nömrəli aktiv elan mövcud deyil</h3><br><br>";
            $this->load->view('site/tez_header');
            $this->load->view('site/footer');
          }
        }
      }

      public function rent_product()
      {
        // $this->output->enable_profiler(true);

        $id = (int) $this->uri->segment(4);

        if ($id) {
          $check_car = $this->universal_model->get_item_where('rent_car', array('id' => $id, 'car_status' => 0, 'status' => 1), 'id');

          if(@$check_car && $check_car->id)
          {
            $status = '';

            if ($this->input->get('status')) {
              $filtered_get = $this->filter_data($this->input->get());
              $status = $filtered_get['status'];
            }

            $data['webp'] = $this->webp;
            $data['status'] = $status;
            $data['title'] = 'rent_product';
            $data['code'] = $this->input->get('code')?(int)$this->input->get('code'):0;

            if($this->cache->get('rent_product_data'.$id)) {
              $cache_arr = $this->cache->get('rent_product_data'.$id);
            } else {
              $cache_arr['images'] = $this->universal_model->get_more_item_select('rent_car_photo', 'id, name', array('rent_car_id' => $id, 'active' => 1, 'deleted' => 0), 0, ['location', 'asc']);
              $cache_arr['car'] = $this->PagesModel->get_rent_product_data($id);

              $this->cache->write($cache_arr, 'rent_product_data'.$id, 30);
            }

            $data['images'] = $cache_arr['images'];
            $data['car'] = $car = $cache_arr['car'];
            $data['fuel'] = ['Benzin', 'Dizel', 'Qaz', 'Elektro', 'Hibrid'];
            $data['transmission'] = ['Mexaniki', 'Avtomat', 'Robotlaşdırılmış', 'Variator'];
            $data['array'] = array(
              ['for_if' => $car->wheels, 'for_echo' => 'Yüngül lehimli disklər'],
              ['for_if' => $car->parkingsensor, 'for_echo' => 'Park radarı'],
              ['for_if' => $car->camera, 'for_echo' => 'Arxa görüntü kamerası'],
              ['for_if' => $car->centrallocking, 'for_echo' => 'Mərkəzi qapanma'],
              ['for_if' => $car->xenon, 'for_echo' => 'Ksenon lampalar'],
              ['for_if' => $car->leather, 'for_echo' => 'Dəri salon'],
              ['for_if' => $car->sunproof, 'for_echo' => 'Lyuk'],
              ['for_if' => $car->heatedseats, 'for_echo' => 'Oturacaqların isidilməsi'],
              ['for_if' => $car->abs, 'for_echo' => 'ABS'],
              ['for_if' => $car->aircondition, 'for_echo' => 'Kondisioner'],
              ['for_if' => $car->rainsensor, 'for_echo' => 'Yağış sensoru'],
              ['for_if' => $car->seatventilation, 'for_echo' => 'Oturacaqların havalandırılması'],
              ['for_if' => $car->sidecurtains, 'for_echo' => 'Yan pərdələr'],
              ['for_if' => $car->esp, 'for_echo' => 'ESP']
            );

            $data['showroom'] = $this->PagesModel->get_showroom_data($car->authorid);
            $data['similar'] = $similar_arr = $this->PagesModel->get_rent_similar_ads('car.authorid = '.$car->authorid.' and car.id != '.$id, 10);
            $similar_count = $this->PagesModel->get_rent_similar_ads_count('car.authorid = '.$car->authorid.' and car.id != '.$id);

            if ($similar_count)
              $data['show_more'] = ($similar_count->count > 10)?1:0;
            else
              $data['show_more'] = 0;

            $header = $this->header_data();
            $content = array_merge($data, $header);

            $this->load->view('site/tez_header', $content);
            $this->load->view('Pages/rent_product');
            $this->load->view('site/footer');
          } else {
            echo "<h3>".$id." nömrəli aktiv elan mövcud deyil</h3><br><br>";
            $this->load->view('site/tez_header');
            $this->load->view('site/footer');
          }
        }
      }

      public function get_last_price()
      {
        // $this->output->enable_profiler(true);
        if($this->input->post())
        {
          $auction_id = (int) $this->input->post('auction_id');
          $car_id = (int) $this->input->post('car_id');
          $discount = (int) $this->input->post('discount');
          $last_price = $this->PagesModel->get_last_price($auction_id);

          if ($last_price->last_price)
            echo $last_price->last_price;
          else {
            $price_arr = $this->universal_model->get_item_where('carad', array('id' => $car_id), 'price');
            echo $price_arr?($price_arr->price*(100 - $discount)/100):0;
          }
        }
      }

      public function product_counter()
      {
        // $this->output->enable_profiler(true);
        if($this->input->post())
        {
          $id = (int) $this->input->post('id');
          $count_arr = $this->universal_model->get_more_item_select_row('carad', 'counter', array('id' => $id));
          if ($count_arr) {
            $result = $this->universal_model->item_edit_save('carad', array('id' => $id), array('counter' => ($count_arr->counter + 1)));

            echo $result?'true':'false';
          }
        }
      }

      public function rent_product_counter()
      {
        // $this->output->enable_profiler(true);
        if($this->input->post())
        {
          $id = (int) $this->input->post('id');
          $count_arr = $this->universal_model->get_more_item_select_row('rent_car', 'counter', array('id' => $id));
          if ($count_arr) {
            $result = $this->universal_model->item_edit_save('rent_car', array('id' => $id), array('counter' => ($count_arr->counter + 1)));

            echo $result?'true':'false';
          }
        }
      }

      public function change_favourite()
      {
        if($this->input->post())
        {
          $id = (int) $this->input->post('id');
          $fav = (int) $this->input->post('fav');

          $where_user = $this->session->userdata('uid')?' uid = '.$this->session->userdata('uid'):' tmp_user_id = '.$this->session->userdata('tmp_user');
          $check = $this->universal_model->get_more_item_select('favorit', 'id', 'pid = '.$id.' and'.$where_user);

          if ($check)
            $this->universal_model->item_edit_save('favorit', 'pid = '.$id.' and'.$where_user, array('beyen' => $fav));
          else
            $this->universal_model->add_item(array('pid' => $id, 'uid' => $this->session->userdata('uid')?$this->session->userdata('uid'):0, 'tmp_user_id' => $this->session->userdata('tmp_user'), 'beyen' => $fav), 'favorit');
        }
      }

      public function edit_with_pin($id){
        $adid = (int) $id;
        $pincode = (int) @$this->input->post('pincode');
        $pincode = $pincode?$pincode:(int) @$this->input->get('pincode');
        $this->session->set_userdata('edit_pincode', $pincode);

        $check = $this->universal_model->get_more_item_select_row('carad', 'id', array('id' => $adid, 'pincode' => $pincode));

        if ($check) {
          $this->load->model('dashboard_model');
          $data['popular_mark'] = $this->PagesModel->get_marks(' and popular = 1');
          $data['mark'] = $this->PagesModel->get_marks('');
          $data['carmark']  =  $this->dashboard_model->getCarMark();
          $data['carmodel'] = $this->dashboard_model->getCarModel();
          $data['carbody']  =  $this->dashboard_model->getCarBody();
          $data['carcolor']  =  $this->dashboard_model->getCarColor();
          $data['carengine']  =  $this->dashboard_model->getCarEngine();
          $data['carinteriorcolor']  =  $this->dashboard_model->getCarInteriorColor();
          $data['carcities']  =  $this->dashboard_model->getCarCities();
          $data['editAd'] = $this->PagesModel->edit_with_pin_data($adid);
          $data['carphotos'] = $this->dashboard_model->getAdsPhotos($adid, 0);
          $data['title'] = 'dashboard';
          $this->load->view('site/tez_header', $data);
          $this->load->view('/Dashboard/editCar');
          $this->load->view('/Dashboard/footer');
        } else {
          $filtered_post = $this->filter_data($this->input->post());
          $title = $filtered_post['title'];
          redirect('/pages/product/'.$title.'?status=edit_error');
        }

      }

      public function edit_rent_with_pin($id)
      {
        $adid = (int) $id;
        $pincode = (int) $this->input->post('pincode');

        $check = $this->universal_model->get_more_item_select_row('rent_car', 'id', array('id' => $adid, 'pincode' => $pincode));

        if ($check) {
          $this->load->model('PagesModel');
          $this->load->model('dashboard_model');
          $data['popular_mark'] = $this->PagesModel->get_marks(' and popular = 1');
          $data['mark'] = $this->PagesModel->get_marks('');
          $data['classes'] = $this->universal_model->get_more_item_select('rent_class', 'id, class', 'active = 1');
          $data['carmark']  =  $this->dashboard_model->getCarMark();
          $data['carmodel'] = $this->dashboard_model->getCarModel();
          $data['carbody']  =  $this->dashboard_model->getCarBody();
          $data['carcolor']  =  $this->dashboard_model->getCarColor();
          $data['carengine']  =  $this->dashboard_model->getCarEngine();
          $data['carinteriorcolor']  =  $this->dashboard_model->getCarInteriorColor();
          $data['carcities']  =  $this->dashboard_model->getCarCities();
          $data['editAd'] = $this->universal_model->get_more_item('rent_car', array('id' => $adid), 1);

          $data['title'] = 'dashboard';
          $this->load->view('/site/tez_header', $data);

          $data['filter_mark_name'] = $this->universal_model->get_more_item_select_row('carmark', 'mark', array('id' => $data['editAd'][0]['mark']));
          $data['filter_model_name'] = $this->universal_model->get_more_item_select_row('carmodel', 'model', array('id' => $data['editAd'][0]['model']));
          $pincode = 0;
          $data['carphotos'] = $this->universal_model->get_more_item_select('rent_car_photo', '*', array('active' => 1, 'deleted' => 0, 'rent_car_id' => $adid), 1, array('location', 'asc'));

          $this->load->view('/rent/edit_rent_car', $data);
        } else {
          $filtered_post = $this->filter_data($this->input->post());
          $title = $filtered_post['title'];
          redirect('/pages/rent_product/'.$title.'?status=edit_error');
        }
      }

      public function delete_with_pin($id)
      {
        $adid = (int) $id;
        $pincode = (int) $this->input->post('pincode');

        $check = $this->universal_model->get_more_item_select_row('carad', 'id', array('id' => $adid, 'pincode' => $pincode));

        if ($check) {
          $this->universal_model->item_edit_save('carad', array('id' => $adid) , array('status' => 4));
          redirect('/');
        } else {
          $filtered_post = $this->filter_data($this->input->post());
          $title = $filtered_post['title'];
          redirect('/pages/product/'.$title.'?status=delete_error');
        }
      }

      public function delete_rent_with_pin($id)
      {
        $adid = (int) $id;
        $pincode = (int) $this->input->post('pincode');

        $check = $this->universal_model->get_more_item_select_row('rent_car', 'id', array('id' => $adid, 'pincode' => $pincode));

        if ($check) {
          $this->universal_model->item_edit_save('rent_car', array('id' => $adid) , array('status' => 4));
          redirect('/');
        } else {
          $filtered_post = $this->filter_data($this->input->post());
          $title = $filtered_post['title'];
          redirect('/pages/rent_product/'.$title.'?status=delete_error');
        }
      }

      public function complain($id)
      {
        $id = (int) $id;
        if($this->input->post())
        {
          $this->load->library("template");
          $filtered_post = $this->filter_data($this->input->post());
          $title = $filtered_post['title'];
          $text = $filtered_post['complain'];
          $msg = '<h2>'.$title.'</h2><br><br>'.$text;
          $this->template->send_mail($id." nömrəli elana şikayət", $msg);
          redirect('/pages/product/'.$title.'?status=send_success');
        }
      }

      public function rent_complain($id)
      {
        $id = (int) $id;
        if($this->input->post())
        {
          $this->load->library("template");
          $filtered_post = $this->filter_data($this->input->post());
          $title = $filtered_post['title'];
          $text = $filtered_post['complain'];
          $msg = '<h2>'.$title.'</h2><br><br>'.$text;
          $this->template->send_mail($id." nömrəli elana şikayət", $msg);
          redirect('/pages/rent_product/'.$title.'?status=send_success');
        }
      }

      public function favourite()
      {
        $this->counter();

        $data['title'] = 'favourite';
        $data['webp'] = $this->webp;
        $top_plus_arr = $this->PagesModel->get_favourite('f.beyen = 1 and car.premium = 1 and DATE(premium_date) > DATE_SUB(CURDATE(), INTERVAL car.premium_type DAY)', 'car.premium_update_date desc');
        $top_arr = $this->PagesModel->get_favourite('f.beyen = 1 and car.vip = 1 and car.premium = 0 and DATE(vipdate) > DATE_SUB(CURDATE(), INTERVAL car.vip_type DAY)', 'car.vip_update_date desc');
        $simple_arr = $this->PagesModel->get_favourite('f.beyen = 1 and car.premium = 0 and car.vip = 0', 'car.createdate desc');
        $data['cars'] = array_merge($top_plus_arr, $top_arr, $simple_arr);

        $header = $this->header_data();
        $content = array_merge($data, $header);

        $this->load->view('site/tez_header', $content);
        $this->load->view('Pages/favourite');
        $this->load->view('site/footer');
      }

      public function add_offer($id)
      {
        $auction_id = (int) $id;
        if ($this->input->post())
        {
          $filtered_post = $this->filter_data($this->input->post());

          if ($this->session->userdata('uid')) {
            $user_data = $this->universal_model->get_item_where('user', array('id' => $this->session->userdata('uid')), 'first_name, mobile');
            $user_name = $user_data->first_name;
            $phone = $user_data->mobile;
          } else {
            $user_name = $filtered_post['user_name'];
            $phone = substr($filtered_post['phone'], 0, 13);
          }

          $carad_id = (int) $filtered_post['carad_id'];

          $offer_procent = (int) $this->input->post('offer_procent');
          $auction_data = $this->universal_model->get_item_where('auction', array('id' => $auction_id), '*');
          $check_selled = $this->universal_model->get_item_where('auction_offers', array('auction_id' => $auction_id, 'selled' => 1), 'id');

          if (!$check_selled)
          {
            if ($auction_data->participants)
            {
              $participants_count = $this->PagesModel->get_participants_count($auction_id);
              $participants_count = $participants_count?$participants_count:[];
              $check_unique_phone = $this->universal_model->get_item_where('auction_offers', array('auction_id' => $auction_id, 'phone' => $phone), '*');

              if (!$check_unique_phone)
              {
                if (count($participants_count) < $auction_data->participants) {
                  $result = $this->add_offer_sub($auction_id, $auction_data, $offer_procent, $user_name, $phone);

                  if ($result)
                    redirect('/pages/product/auto/'.$carad_id.'?code=1');
                  else
                    redirect('/pages/product/auto/'.$carad_id.'?code=9999');
                }
                else
                  redirect('/pages/product/auto/'.$carad_id.'?code=99');
              } else {
                $result = $this->add_offer_sub($auction_id, $auction_data, $offer_procent, $user_name, $phone);

                if ($result)
                  redirect('/pages/product/auto/'.$carad_id.'?code=1');
                else
                  redirect('/pages/product/auto/'.$carad_id.'?code=9999');
              }
            } else {
              $result = $this->add_offer_sub($auction_id, $auction_data, $offer_procent, $user_name, $phone);

              if ($result)
                redirect('/pages/product/auto/'.$carad_id.'?code=1');
              else
                redirect('/pages/product/auto/'.$carad_id.'?code=9999');
            }
          }
          else
            redirect('/pages/product/auto/'.$carad_id.'?code=999');
        }
      }

      public function add_offer_sub($auction_id, $auction_data, $offer_procent, $user_name, $phone)
      {
        $last_price = $this->universal_model->get_item_where('auction_offers', array('auction_id' => $auction_id), 'max(offer_price) as "offer_price"');

        if ($last_price && $last_price->offer_price) {
          $price = $last_price->offer_price*(100 + $offer_procent)/100;
          $vars = array(
            'auction_id' => $auction_id,
            'user_id' => $this->session->userdata('uid')?$this->session->userdata('uid'):0,
            'user_name' => $user_name,
            'phone' => $phone,
            'offer_price' => (int) $price,
            'offer_date' => date('Y-m-d H:i:s'),
            'selled' => 0
          );

          $result = $this->universal_model->add_item($vars, 'auction_offers');
        } else {
          $price_arr = $this->universal_model->get_item_where('carad', array('id' => $auction_data->carad_id), 'price');
          $price = ($price_arr->price*(100 - $auction_data->discount)/100)*(100 + $offer_procent)/100;

          $vars = array(
            'auction_id' => $auction_id,
            'user_id' => $this->session->userdata('uid')?$this->session->userdata('uid'):0,
            'user_name' => $user_name,
            'phone' => $phone,
            'offer_price' => (int) $price,
            'offer_date' => date('Y-m-d H:i:s'),
            'selled' => 0
          );

          $result = $this->universal_model->add_item($vars, 'auction_offers');
        }
        return $result;
      }

      public function auction_sell()
      {
        if ($this->input->post())
        {
          $offer_id = (int) $this->input->post('offer_id');
          $result = $this->universal_model->item_edit_save('auction_offers', array('id' => $offer_id), array('selled' => 1));
          echo $result?1:0;
        }
      }

      public function auction()
      {
        $this->counter();

        $data['webp'] = $this->webp;
        $data['title'] = 'favourite';
        $top_plus_arr = $this->PagesModel->get_auction_cars('car.premium = 1', 'car.premium_update_date desc');
        $top_arr = $this->PagesModel->get_auction_cars('car.vip = 1 and car.premium = 0', 'car.vip_update_date desc');
        $simple_arr = $this->PagesModel->get_auction_cars('car.premium = 0 and car.vip = 0', 'car.createdate desc');
        $data['cars'] = array_merge($top_plus_arr, $top_arr, $simple_arr);

        $header = $this->header_data();
        $content = array_merge($data, $header);

        $this->load->view('site/tez_header', $content);
        $this->load->view('Pages/auction');
        $this->load->view('site/footer');
      }

      public function for_auto_update_top()
      {
        $data = $this->universal_model->get_more_item_select('carad', 'id, vip, vipdate, vip_type, vip_update_date, premium, premium_date, premium_type, premium_update_date', 'status = 1 and car_status = 0 and (vip = 1 or premium = 1)');
        foreach($data as $row)
        {
          if ($row->vip == 1)
          {
            if (strtotime($row->vipdate) + ($row->vip_type*24*60*60) < strtotime(date('Y-m-d H:i:s'))) {
              $this->universal_model->item_edit_save('carad', array('id' => $row->id), array('vip' => 0));
            } else {
              if (strtotime(date('Y-m-d H:i:s')) - strtotime($row->vip_update_date) > 24*60*60) {
                $this->universal_model->item_edit_save('carad', array('id' => $row->id), array('vip_update_date' => date('Y-m-d H:i:s')));
              }
            }
          }

          if ($row->premium == 1)
          {
            if (strtotime($row->premium_date) + ($row->premium_type*24*60*60) < strtotime(date('Y-m-d H:i:s'))) {
              $this->universal_model->item_edit_save('carad', array('id' => $row->id), array('premium' => 0));
            } else {
              if (strtotime(date('Y-m-d H:i:s')) - strtotime($row->premium_update_date) > 24*60*60) {
                $this->universal_model->item_edit_save('carad', array('id' => $row->id), array('premium_update_date' => date('Y-m-d H:i:s')));
              }
            }
          }
        }

        $unlimited_data = $this->PagesModel->get_unlimited_list();
        foreach($unlimited_data as $row)
        {
          if (strtotime(date('Y-m-d H:i:s')) - strtotime($row->vip_update_date) > 24*60*60)
            $this->universal_model->item_edit_save('carad', array('id' => $row->id), array('vip_update_date' => date('Y-m-d H:i:s')));


          if (strtotime(date('Y-m-d H:i:s')) - strtotime($row->premium_update_date) > 24*60*60)
            $this->universal_model->item_edit_save('carad', array('id' => $row->id), array('premium_update_date' => date('Y-m-d H:i:s')));
        }

        $data2 = $this->universal_model->get_more_item_select('rent_car', 'id, vip, vipdate, vip_type, vip_update_date, premium, premium_date, premium_type, premium_update_date', 'status = 1 and car_status = 0 and (vip = 1 or premium = 1)');
        foreach($data2 as $row)
        {
          if ($row->vip == 1)
          {
            if (strtotime($row->vipdate) + ($row->vip_type*24*60*60) < strtotime(date('Y-m-d H:i:s'))) {
              $this->universal_model->item_edit_save('rent_car', array('id' => $row->id), array('vip' => 0));
            } else {
              if (strtotime(date('Y-m-d H:i:s')) - strtotime($row->vip_update_date) > 24*60*60) {
                $this->universal_model->item_edit_save('rent_car', array('id' => $row->id), array('vip_update_date' => date('Y-m-d H:i:s')));
              }
            }
          }

          if ($row->premium == 1)
          {
            if (strtotime($row->premium_date) + ($row->premium_type*24*60*60) < strtotime(date('Y-m-d H:i:s'))) {
              $this->universal_model->item_edit_save('rent_car', array('id' => $row->id), array('premium' => 0));
            } else {
              if (strtotime(date('Y-m-d H:i:s')) - strtotime($row->premium_update_date) > 24*60*60) {
                $this->universal_model->item_edit_save('rent_car', array('id' => $row->id), array('premium_update_date' => date('Y-m-d H:i:s')));
              }
            }
          }
        }

        $auction_data = $this->universal_model->get_more_item_select('auction', 'id, period, create_date', 'status = 1');
        foreach ($auction_data as $row)
        {
          if (strtotime($row->create_date) + ($row->period*24*60*60) < strtotime(date('Y-m-d H:i:s')))
            $this->universal_model->item_edit_save('auction', array('id' => $row->id), array('status' => 0));
        }

        $this->PagesModel->auto_check_appraisement();
      }

      public function appraisement()
      {
        // if ($this->session->userdata('uid') == 1207)
        //   $this->output->enable_profiler(true);

        $data['mark_list'] = $this->PagesModel->get_appraisement_mark_list();
        $data['title'] = 'appraisement';

        $header = $this->header_data();
        $content = array_merge($data, $header);

        $this->load->view('site/tez_header', $content);
        $this->load->view('Pages/appraisement');
        $this->load->view('site/footer');
      }

      public function get_appraisement_model_list()
      {
        if ($this->input->post())
        {
          $filtered_post = $this->filter_data($this->input->post());

          $mark = $filtered_post['mark'];
          $array = $this->PagesModel->get_appraisement_model_list($mark);
          echo json_encode($array);
        }
      }

      public function get_appraisement_year_list()
      {
        // $this->output->enable_profiler(true);
        if ($this->input->post())
        {
          $filtered_post = $this->filter_data($this->input->post());

          $mark = $filtered_post['mark'];
          $model = $filtered_post['model'];
          $array = $this->PagesModel->get_appraisement_year_list($mark, $model);
          echo json_encode($array);
        }
      }

      public function get_appraisement_result()
      {
        if ($this->input->post())
        {
          $filtered_post = $this->filter_data($this->input->post());

          $mark = $filtered_post['mark'];
          $model = $filtered_post['model'];
          $year = (int) $filtered_post['year'];

          $array = $this->PagesModel->get_appraisement_result($mark, $model, $year);

          if ($array)
          {
            $sum = 0;
            foreach($array as $row)
            {
              if ($row->currency == 0)
              $x = 1;
              else if ($row->currency == 1)
              $x = 1.7;
              else
              $x = 2.06;

              $sum = $sum + $row->price * $x;
            }

            $res_val = $sum/count($array);
            echo number_format($res_val, 0, ".", " ");
          }
        }
      }

      public function contact()
      {
        $this->counter();

        $data['title'] = 'contact';
        $data['message'] = $this->input->get('message')?(int)$this->input->get('message'):0;

        $header = $this->header_data();
        $content = array_merge($data, $header);

        $this->load->view('site/tez_header', $content);
        $this->load->view('Pages/contact');
        $this->load->view('site/footer');
      }

      public function contact_with()
      {
        $this->load->library("template");
        if($this->input->post())
        {
          $filtered_post = $this->filter_data($this->input->post());

          $vars = array(
            'name' => $filtered_post['name'],
            'surname' => $filtered_post['surname'],
            'phone_mail' => $filtered_post['phone_mail'],
            'contact_type' => (int) $filtered_post['contact_type'],
            'text' => $filtered_post['text']
          );

          $result = $this->universal_model->add_item($vars, 'contact');

          if($result) {
            $msg = '<h3><b>İstifadəçinin adı:</b>&nbsp;&nbsp; '.$filtered_post['name'].' '.$filtered_post['surname'].'</h3>
                    <br>
                    <h3><b>İstifadəçinin e-poçt ünvanı:</b>&nbsp;&nbsp;'.$filtered_post['phone_mail'].'</h4>
  									<br><br>
                    <h3>Müraciət:</h3>
                    <br>
  									<h5>'.$filtered_post['text'].'</h5>';

    				if($msg)
    						$result2 = $this->template->send_mail("Otomoto", $msg, 'support@otomoto.az');

            redirect('/pages/contact?message=1');
          }
          else
            redirect('/pages/contact?message=2');
        }
      }

      function find_duplicate_files()
      {
        $names = $this->scandir_recursive($this->config->item('server_root').'/assets/img/car_photos/800xauto/');
        $files = array();
        foreach( $names as $name ) {
            if( count( $name ) > 1 ) {
                $files[] = $name;
            }
        }
        print_r($files);
      }

      function scandir_recursive($dir, &$result = array())
      {
        $dir = rtrim($dir, DIRECTORY_SEPARATOR);

        foreach ( scandir($dir) as $node ) {
            if ($node !== '.' and $node !== '..') {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $node)) {
                    scandir_recursive($dir . DIRECTORY_SEPARATOR . $node, $result);
                } else {
                    $result[$node][] = $dir . DIRECTORY_SEPARATOR . $node;
                }
            }
        }
        return $result;
      }

      public function top()
      {
        // $this->output->enable_profiler(true);

        $mark_array = $model_array = $body_array = $color_array = $city_array = $fuel_array = $transmission_array = $drive_array = [];
        $mark = $model = $body = $color = $city = $search = $top = 0;
        $min_mileage = $max_mileage = $currency = $min_price = $max_price = $min_year = $max_year = $min_engine = $max_engine = 0;
        $credit = $barter = $disk = $radar = $camera = $qapanma = $lampa = $leather = $lyuk = $isidilme = $abs = $kondisioner = $sensor = $havalandirma = $perde = $esp = 0;
        $order = $fuel = $transmission = $drive = '';
        $data['title'] = 'top_page';

        if($this->input->get())
        {
          $filtered_get = $this->filter_data($this->input->get());
          $order = $this->input->get('order')?$filtered_get['order']:'';
          $search = $data['all_ads'] = $this->input->get('search')?1:0;

          $b = @$this->input->get('mark');
          if (isset($b)) {
            $search = 1;
            $mark = $filtered_get['mark']?(int)$filtered_get['mark']:0;
            $model = $filtered_get['model']?(int)$filtered_get['model']:0;
            $data['filter_mark2'] = (int) $filtered_get['mark'];
            $data['filter_model2'] = (int) $filtered_get['model'];
            $data['filter_mark_name'] = $this->universal_model->get_more_item_select_row('carmark', 'mark', array('id' => $mark));
            $data['filter_model_name'] = $this->universal_model->get_more_item_select_row('carmodel', 'model', array('id' => $model));
          }
          $city = $this->input->get('city')?(int)$filtered_get['city']:0;
          $top = $this->input->get('top')?(int)$filtered_get['top']:0;

          $a = @$this->input->get('min_engine');
          if(isset($a))
          {
            $search = 1;
            $mark_array = $this->input->get('mark_array')?$filtered_get['mark_array']:[];
            $mark = $mark_array?implode(',', $mark_array):0;
            $model_array = $this->input->get('model_array')?$filtered_get['model_array']:[];
            $model = $model_array?implode(',', $model_array):0;
            $body_array = $this->input->get('body')?$filtered_get['body']:[];
            $body = ($body_array && @$body_array[0])?implode(',', $body_array):0;
            $color_array = $this->input->get('color')?$filtered_get['color']:[];
            $color = ($color_array && @$color_array[0])?implode(',', $color_array):0;
            $city_array = $this->input->get('city_array')?$filtered_get['city_array']:[];
            $city = ($city_array && @$city_array[0])?implode(',', $city_array):0;
            $fuel_array = $this->input->get('fuel')?$filtered_get['fuel']:[];
            $fuel = ($fuel_array && @$fuel_array[0])?'"'.implode('","', $fuel_array).'"':'';
            $transmission_array = $this->input->get('transmission')?$filtered_get['transmission']:[];
            $transmission = ($transmission_array && @$transmission_array[0])?'"'.implode('","', $transmission_array).'"':'';
            $drive_array = $this->input->get('drive')?$filtered_get['drive']:[];
            $drive = ($drive_array && @$drive_array[0])?'"'.implode('","', $drive_array).'"':'';

            $min_mileage = (int)$filtered_get['min_mileage'];
            $max_mileage = (int)$filtered_get['max_mileage'];
            $min_engine = (int)$filtered_get['min_engine'];
            $min_engine_arr = $this->universal_model->get_item_where('carengine', array('id' => $min_engine), 'engine');
            $min_engine = $min_engine_arr?($min_engine_arr->engine?$min_engine_arr->engine:0):0;
            $max_engine = (int)$filtered_get['max_engine'];
            $max_engine_arr = $this->universal_model->get_item_where('carengine', array('id' => $max_engine), 'engine');
            $max_engine = $max_engine_arr?($max_engine_arr->engine?$max_engine_arr->engine:0):0;

  					$disk = $this->input->get('disk')?1:0;
  					$radar = $this->input->get('radar')?1:0;
  					$camera = $this->input->get('camera')?1:0;
  					$qapanma = $this->input->get('qapanma')?1:0;
  					$lampa = $this->input->get('lampa')?1:0;
  					$leather = $this->input->get('leather')?1:0;
  					$lyuk = $this->input->get('lyuk')?1:0;
  					$isidilme = $this->input->get('isidilme')?1:0;
  					$abs = $this->input->get('abs')?1:0;
  					$kondisioner = $this->input->get('kondisioner')?1:0;
  					$sensor = $this->input->get('sensor')?1:0;
  					$havalandirma = $this->input->get('havalandirma')?1:0;
  					$perde = $this->input->get('perde')?1:0;
  					$esp = $this->input->get('esp')?1:0;
          }

          $v = @$this->input->get('min_year');
          if (isset($v)) {
            $currency = (int) $filtered_get['currency'];
            $min_price = (int) $filtered_get['min_price'];
            $max_price = (int) $filtered_get['max_price'];
            $min_year = (int) $filtered_get['min_year'];
            $max_year = (int) $filtered_get['max_year'];
            $credit = $this->input->get('credit')?1:0;
            $barter = $this->input->get('barter')?1:0;
          }
        }

        $vars = array(
          'mark' => $mark,
          'model' => $model,
          'body' => $body,
          'color' => $color,
          'city' => $city,
          'min_mileage' => $min_mileage,
          'max_mileage' => $max_mileage,
          'currency' => $currency,
          'min_price' => $min_price,
          'max_price' => $max_price,
          'min_year' => $min_year,
          'max_year' => $max_year,
          'min_engine' => $min_engine,
          'max_engine' => $max_engine,
          'credit' => $credit,
          'barter' => $barter,
          'disk' => $disk,
          'radar' => $radar,
          'camera' => $camera,
          'qapanma' => $qapanma,
          'lampa' => $lampa,
          'leather' => $leather,
          'lyuk' => $lyuk,
          'isidilme' => $isidilme,
          'abs' => $abs,
          'kondisioner' => $kondisioner,
          'sensor' => $sensor,
          'havalandirma' => $havalandirma,
          'perde' => $perde,
          'esp' => $esp,
          'order' => $order,
          'fuel' => $fuel,
          'transmission' => $transmission,
          'drive' => $drive
        );

        if ($top) {
          $data['cars'] = $this->top_pagination_data(array('cars' => $this->PagesModel->get_main_list_top($vars, ' and (premium = 1 or u.unlimited = 1)', '0, 12', 'car.premium_update_date desc'), 'webp' => $this->webp));
          $data['cars_count'] = $this->PagesModel->get_main_list_count($vars, ' and (premium = 1 or u.unlimited = 1)');
        } else {
          $data['cars'] = $this->top_pagination_data(array('cars' => $this->PagesModel->get_main_list_top($vars, ' and (vip = 1 or u.unlimited = 1)', '0, 12', 'car.vip_update_date desc'), 'webp' => $this->webp));
          $data['cars_count'] = $this->PagesModel->get_main_list_count($vars, ' and (vip = 1 or u.unlimited = 1)');
        }

        $header = $this->header_data();
        $content = array_merge($data, $header);

        $this->load->view('site/tez_header', $content);
        $this->load->view('Pages/top_page');
        $this->load->view('site/footer');
      }

      public function simple()
      {
        $mark_array = $model_array = $body_array = $color_array = $city_array = $fuel_array = $transmission_array = $drive_array = [];
        $mark = $model = $body = $color = $city = $search = $top = 0;
        $min_mileage = $max_mileage = $currency = $min_price = $max_price = $min_year = $max_year = $min_engine = $max_engine = 0;
        $credit = $barter = $disk = $radar = $camera = $qapanma = $lampa = $leather = $lyuk = $isidilme = $abs = $kondisioner = $sensor = $havalandirma = $perde = $esp = 0;
        $order = $fuel = $transmission = $drive = '';
        $data['title'] = 'simple';

        if($this->input->get())
        {
          $filtered_get = $this->filter_data($this->input->get());
          $order = $this->input->get('order')?$filtered_get['order']:'';
          $search = $data['all_ads'] = $this->input->get('search')?1:0;

          $b = @$this->input->get('mark');
          if (isset($b)) {
            $search = 1;
            $mark = $filtered_get['mark']?(int)$filtered_get['mark']:0;
            $model = $filtered_get['model']?(int)$filtered_get['model']:0;
            $data['filter_mark2'] = (int) $filtered_get['mark'];
            $data['filter_model2'] = (int) $filtered_get['model'];
            $data['filter_mark_name'] = $this->universal_model->get_more_item_select_row('carmark', 'mark', array('id' => $mark));
            $data['filter_model_name'] = $this->universal_model->get_more_item_select_row('carmodel', 'model', array('id' => $model));
          }
          $city = $this->input->get('city')?(int)$filtered_get['city']:0;

          $a = @$this->input->get('min_engine');
          if(isset($a))
          {
            $search = 1;
            $mark_array = $this->input->get('mark_array')?$filtered_get['mark_array']:[];
            $mark = $mark_array?implode(',', $mark_array):0;
            $model_array = $this->input->get('model_array')?$filtered_get['model_array']:[];
            $model = $model_array?implode(',', $model_array):0;
            $body_array = $this->input->get('body')?$filtered_get['body']:[];
            $body = ($body_array && @$body_array[0])?implode(',', $body_array):0;
            $color_array = $this->input->get('color')?$filtered_get['color']:[];
            $color = ($color_array && @$color_array[0])?implode(',', $color_array):0;
            $city_array = $this->input->get('city_array')?$filtered_get['city_array']:[];
            $city = ($city_array && @$city_array[0])?implode(',', $city_array):0;
            $fuel_array = $this->input->get('fuel')?$filtered_get['fuel']:[];
            $fuel = ($fuel_array && @$fuel_array[0])?'"'.implode('","', $fuel_array).'"':'';
            $transmission_array = $this->input->get('transmission')?$filtered_get['transmission']:[];
            $transmission = ($transmission_array && @$transmission_array[0])?'"'.implode('","', $transmission_array).'"':'';
            $drive_array = $this->input->get('drive')?$filtered_get['drive']:[];
            $drive = ($drive_array && @$drive_array[0])?'"'.implode('","', $drive_array).'"':'';

            $min_mileage = (int)$filtered_get['min_mileage'];
            $max_mileage = (int)$filtered_get['max_mileage'];
            $min_engine = (int)$filtered_get['min_engine'];
            $min_engine_arr = $this->universal_model->get_item_where('carengine', array('id' => $min_engine), 'engine');
            $min_engine = $min_engine_arr?($min_engine_arr->engine?$min_engine_arr->engine:0):0;
            $max_engine = (int)$filtered_get['max_engine'];
            $max_engine_arr = $this->universal_model->get_item_where('carengine', array('id' => $max_engine), 'engine');
            $max_engine = $max_engine_arr?($max_engine_arr->engine?$max_engine_arr->engine:0):0;

  					$disk = $this->input->get('disk')?1:0;
  					$radar = $this->input->get('radar')?1:0;
  					$camera = $this->input->get('camera')?1:0;
  					$qapanma = $this->input->get('qapanma')?1:0;
  					$lampa = $this->input->get('lampa')?1:0;
  					$leather = $this->input->get('leather')?1:0;
  					$lyuk = $this->input->get('lyuk')?1:0;
  					$isidilme = $this->input->get('isidilme')?1:0;
  					$abs = $this->input->get('abs')?1:0;
  					$kondisioner = $this->input->get('kondisioner')?1:0;
  					$sensor = $this->input->get('sensor')?1:0;
  					$havalandirma = $this->input->get('havalandirma')?1:0;
  					$perde = $this->input->get('perde')?1:0;
  					$esp = $this->input->get('esp')?1:0;
          }

          $v = @$this->input->get('min_year');
          if (isset($v)) {
            $currency = (int) $filtered_get['currency'];
            $min_price = (int) $filtered_get['min_price'];
            $max_price = (int) $filtered_get['max_price'];
            $min_year = (int) $filtered_get['min_year'];
            $max_year = (int) $filtered_get['max_year'];
            $credit = $this->input->get('credit')?1:0;
            $barter = $this->input->get('barter')?1:0;
          }
        }

        $vars = array(
          'mark' => $mark,
          'model' => $model,
          'body' => $body,
          'color' => $color,
          'city' => $city,
          'min_mileage' => $min_mileage,
          'max_mileage' => $max_mileage,
          'currency' => $currency,
          'min_price' => $min_price,
          'max_price' => $max_price,
          'min_year' => $min_year,
          'max_year' => $max_year,
          'min_engine' => $min_engine,
          'max_engine' => $max_engine,
          'credit' => $credit,
          'barter' => $barter,
          'disk' => $disk,
          'radar' => $radar,
          'camera' => $camera,
          'qapanma' => $qapanma,
          'lampa' => $lampa,
          'leather' => $leather,
          'lyuk' => $lyuk,
          'isidilme' => $isidilme,
          'abs' => $abs,
          'kondisioner' => $kondisioner,
          'sensor' => $sensor,
          'havalandirma' => $havalandirma,
          'perde' => $perde,
          'esp' => $esp,
          'order' => $order,
          'fuel' => $fuel,
          'transmission' => $transmission,
          'drive' => $drive
        );

        $data['cars'] = $this->simple_pagination_data(array('cars' => $this->PagesModel->get_main_list_top($vars, '', '0, 12', 'car.createdate desc'), 'webp' => $this->webp));
        $data['cars_count'] = $this->PagesModel->get_main_list_count($vars, '');

        $header = $this->header_data();
        $content = array_merge($data, $header);

        $this->load->view('site/tez_header', $content);
        $this->load->view('Pages/simple');
        $this->load->view('site/footer');
      }

      public function rent_top()
      {
        // $this->output->enable_profiler(true);

        $data['title'] = 'rent_top_page';
        $mark_array = $model_array = $body = $color = $city_array = $fuel = $transmission = $drive = [];
        $class = $mark = $model = $city = $min_mileage = $max_mileage = $currency = $min_price = $max_price = $min_year = $max_year = $min_engine = $max_engine = 0;
        $delivery = $returning = $baby_chair = $roof_rack = $insurance = 0;
        $min_included_km = $max_included_km = $min_deposit = $max_deposit = $min_limitation = $max_limitation = 0;
        $disk = $radar = $camera = $qapanma = $lampa = $leather = $lyuk = $isidilme = $abs = $kondisioner = $sensor = $havalandirma = $perde = $esp = 0;
        $order = $filter_mark2 = $filter_model2 = $filter_mark_name = $filter_model_name = $filter_class = '';

        if($this->input->get())
        {
          $filtered_get = $this->filter_data($this->input->get());
          $class = $this->input->get('class')?$filtered_get['class']:0;
          $order = $this->input->get('order')?$filtered_get['order']:'';
          $search = $data['all_ads'] = $this->input->get('search')?1:0;
          $top = $this->input->get('top')?(int)$filtered_get['top']:0;

          $a = @$this->input->get('min_mileage');
          if(isset($a))
          {
            $search = 1;
            $mark_array = $this->input->get('mark_array')?$filtered_get['mark_array']:[];
            $mark = $mark_array?implode(',', $mark_array):0;
            $model_array = $this->input->get('model_array')?$filtered_get['model_array']:[];
            $model = $model_array?implode(',', $model_array):0;
            $body_array = $this->input->get('body')?$filtered_get['body']:[];
            $body = ($body_array && @$body_array[0])?implode(',', $body_array):0;
            $color_array = $this->input->get('color')?$filtered_get['color']:[];
            $color = ($color_array && @$color_array[0])?implode(',', $color_array):0;
            $city_array = $this->input->get('city_array')?$filtered_get['city_array']:[];
            $city = ($city_array && @$city_array[0])?implode(',', $city_array):0;
            $fuel_array = $this->input->get('fuel')?$filtered_get['fuel']:[];
            $fuel = ($fuel_array && @$fuel_array[0])?'"'.implode('","', $fuel_array).'"':'';
            $transmission_array = $this->input->get('transmission')?$filtered_get['transmission']:[];
            $transmission = ($transmission_array && @$transmission_array[0])?'"'.implode('","', $transmission_array).'"':'';
            $drive_array = $this->input->get('drive')?$filtered_get['drive']:[];
            $drive = ($drive_array && @$drive_array[0])?'"'.implode('","', $drive_array).'"':'';

            $min_mileage = (int)$filtered_get['min_mileage'];
            $max_mileage = (int)$filtered_get['max_mileage'];
            $min_engine = (int)$filtered_get['min_engine'];
            $max_engine = (int)$filtered_get['max_engine'];
            $min_included_km = (int) $filtered_get['min_included_km'];
            $max_included_km = (int) $filtered_get['max_included_km'];
            $min_deposit = (int) $filtered_get['min_deposit'];
            $max_deposit = (int) $filtered_get['max_deposit'];
            $min_limitation = (int) $filtered_get['min_limitation'];
            $max_limitation = (int) $filtered_get['max_limitation'];

  					$disk = $this->input->get('disk')?1:0;
  					$radar = $this->input->get('radar')?1:0;
  					$camera = $this->input->get('camera')?1:0;
  					$qapanma = $this->input->get('qapanma')?1:0;
  					$lampa = $this->input->get('lampa')?1:0;
  					$leather = $this->input->get('leather')?1:0;
  					$lyuk = $this->input->get('lyuk')?1:0;
  					$isidilme = $this->input->get('isidilme')?1:0;
  					$abs = $this->input->get('abs')?1:0;
  					$kondisioner = $this->input->get('kondisioner')?1:0;
  					$sensor = $this->input->get('sensor')?1:0;
  					$havalandirma = $this->input->get('havalandirma')?1:0;
  					$perde = $this->input->get('perde')?1:0;
  					$esp = $this->input->get('esp')?1:0;
            $insurance = $this->input->get('insurance')?1:0;
            $baby_chair = $this->input->get('baby_chair')?1:0;
            $roof_rack = $this->input->get('roof_rack')?1:0;
          }

          $b = @$this->input->get('currency');
          if(isset($b))
          {
            $currency = (int)$filtered_get['currency'];
            $min_price = (int)$filtered_get['min_price'];
            $max_price = (int)$filtered_get['max_price'];
            $min_year = (int)$filtered_get['min_year'];
            $max_year = (int)$filtered_get['max_year'];
            $delivery = $this->input->get('delivery')?1:0;
            $returning = $this->input->get('returning')?1:0;
          }

          $v = @$this->input->get('model');
          if(isset($v)) {
            $filter_mark2 = (int) $filtered_get['mark'];
            $filter_model2 = (int) $filtered_get['model'];
            $filter_mark_name = $this->universal_model->get_more_item_select_row('carmark', 'mark', array('id' => $filter_mark2));
            $filter_model_name = $this->universal_model->get_more_item_select_row('carmodel', 'model', array('id' => $filter_model2));
          }
        }

        $vars = array(
          'mark' => $mark,
          'model' => $model,
          'body' => $body,
          'color' => $color,
          'city' => $city,
          'fuel' => $fuel,
          'transmission' => $transmission,
          'drive' => $drive,
          'min_mileage' => $min_mileage,
          'max_mileage' => $max_mileage,
          'currency' => $currency,
          'min_price' => $min_price,
          'max_price' => $max_price,
          'min_year' => $min_year,
          'max_year' => $max_year,
          'min_engine' => $min_engine,
          'max_engine' => $max_engine,
          'disk' => $disk,
          'radar' => $radar,
          'camera' => $camera,
          'qapanma' => $qapanma,
          'lampa' => $lampa,
          'leather' => $leather,
          'lyuk' => $lyuk,
          'isidilme' => $isidilme,
          'abs' => $abs,
          'kondisioner' => $kondisioner,
          'sensor' => $sensor,
          'havalandirma' => $havalandirma,
          'perde' => $perde,
          'esp' => $esp,
          'order' => $order,
          'class' => $class,
          'min_included_km' => $min_included_km,
          'max_included_km' => $max_included_km,
          'min_deposit' => $min_deposit,
          'max_deposit' => $max_deposit,
          'min_limitation' => $min_limitation,
          'max_limitation' => $max_limitation,
          'insurance' => $insurance,
          'baby_chair' => $baby_chair,
          'roof_rack' => $roof_rack,
          'delivery' => $delivery,
          'returning' => $returning
        );

        if ($top) {
          $data['cars'] = $this->rent_top_pagination_data(array('cars' => $this->PagesModel->get_rent_main_list_top($vars, ' and premium=1', '0, 12', 'car.premium_update_date desc'), 'webp' => $this->webp));
          $data['cars_count'] = $this->PagesModel->get_rent_main_list_count($vars, ' and premium=1');
        } else {
          $data['cars'] = $this->rent_top_pagination_data(array('cars' => $this->PagesModel->get_rent_main_list_top($vars, ' and vip=1', '0, 12', 'car.vip_update_date desc'), 'webp' => $this->webp));
          $data['cars_count'] = $this->PagesModel->get_rent_main_list_count($vars, ' and vip=1');
        }

        $header = $this->header_data();
        $content = array_merge($data, $header);

        $this->load->view('site/tez_header', $content);
        $this->load->view('Pages/rent_top_page');
        $this->load->view('site/footer');
      }

      public function top_pagination_data($data)
      {
        return $this->load->view("/Pages/top_page_pagination", $data, TRUE);
      }

      public function simple_pagination_data($data)
      {
        return $this->load->view("/Pages/simple_pagination", $data, TRUE);
      }

      public function rent_top_pagination_data($data)
      {
        return $this->load->view("/Pages/rent_top_page_pagination", $data, TRUE);
      }

      public function top_pagination()
      {
        if ($this->input->post())
        {
          $mark_array = $model_array = $body_array = $color_array = $city_array = $fuel_array = $transmission_array = $drive_array = [];
          $mark = $model = $body = $color = $city = $search = $top = 0;
          $min_mileage = $max_mileage = $currency = $min_price = $max_price = $min_year = $max_year = $min_engine = $max_engine = 0;
          $credit = $barter = $disk = $radar = $camera = $qapanma = $lampa = $leather = $lyuk = $isidilme = $abs = $kondisioner = $sensor = $havalandirma = $perde = $esp = 0;
          $order = $fuel = $transmission = $drive = '';

          if($this->input->get())
          {
            $filtered_get = $this->filter_data($this->input->get());
            $order = $this->input->get('order')?$filtered_get['order']:'';

            $b = @$this->input->get('mark');
            if (isset($b)) {
              $search = 1;
              $mark = $filtered_get['mark']?(int)$filtered_get['mark']:0;
              $model = $filtered_get['model']?(int)$filtered_get['model']:0;
              $data['filter_mark2'] = (int) $filtered_get['mark'];
              $data['filter_model2'] = (int) $filtered_get['model'];
              $data['filter_mark_name'] = $this->universal_model->get_more_item_select_row('carmark', 'mark', array('id' => $mark));
              $data['filter_model_name'] = $this->universal_model->get_more_item_select_row('carmodel', 'model', array('id' => $model));
            }
            $city = $this->input->get('city')?(int)$filtered_get['city']:0;
            $top = $this->input->get('top')?(int)$filtered_get['top']:0;

            $a = @$this->input->get('min_engine');
            if(isset($a))
            {
              $search = 1;
              $mark_array = $this->input->get('mark_array')?$filtered_get['mark_array']:[];
              $mark = $mark_array?implode(',', $mark_array):0;
              $model_array = $this->input->get('model_array')?$filtered_get['model_array']:[];
              $model = $model_array?implode(',', $model_array):0;
              $body_array = $this->input->get('body')?$filtered_get['body']:[];
              $body = $body_array?implode(',', $body_array):0;
              $color_array = $this->input->get('color')?$filtered_get['color']:[];
              $color = $color_array?implode(',', $color_array):0;
              $city_array = $this->input->get('city_array')?$filtered_get['city_array']:[];
              $city = $city_array?implode(',', $city_array):0;
              $fuel_array = $this->input->get('fuel')?$filtered_get['fuel']:[];
              $fuel = $fuel_array?'"'.implode('","', $fuel_array).'"':'';
              $transmission_array = $this->input->get('transmission')?$filtered_get['transmission']:[];
              $transmission = $transmission_array?'"'.implode('","', $transmission_array).'"':'';
              $drive_array = $this->input->get('drive')?$filtered_get['drive']:[];
              $drive = $drive_array?'"'.implode('","', $drive_array).'"':'';

              $min_mileage = (int)$filtered_get['min_mileage'];
              $max_mileage = (int)$filtered_get['max_mileage'];
              $min_engine = (int)$filtered_get['min_engine'];
              $max_engine = (int)$filtered_get['max_engine'];

    					$disk = $this->input->get('disk')?1:0;
    					$radar = $this->input->get('radar')?1:0;
    					$camera = $this->input->get('camera')?1:0;
    					$qapanma = $this->input->get('qapanma')?1:0;
    					$lampa = $this->input->get('lampa')?1:0;
    					$leather = $this->input->get('leather')?1:0;
    					$lyuk = $this->input->get('lyuk')?1:0;
    					$isidilme = $this->input->get('isidilme')?1:0;
    					$abs = $this->input->get('abs')?1:0;
    					$kondisioner = $this->input->get('kondisioner')?1:0;
    					$sensor = $this->input->get('sensor')?1:0;
    					$havalandirma = $this->input->get('havalandirma')?1:0;
    					$perde = $this->input->get('perde')?1:0;
    					$esp = $this->input->get('esp')?1:0;
            }

            $v = @$this->input->get('min_year');
            if (isset($v)) {
              $currency = (int) $filtered_get['currency'];
              $min_price = (int) $filtered_get['min_price'];
              $max_price = (int) $filtered_get['max_price'];
              $min_year = (int) $filtered_get['min_year'];
              $max_year = (int) $filtered_get['max_year'];
              $credit = $this->input->get('credit')?1:0;
              $barter = $this->input->get('barter')?1:0;
            }
          }

          $vars = array(
            'mark' => $mark,
            'model' => $model,
            'body' => $body,
            'color' => $color,
            'city' => $city,
            'min_mileage' => $min_mileage,
            'max_mileage' => $max_mileage,
            'currency' => $currency,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'min_year' => $min_year,
            'max_year' => $max_year,
            'min_engine' => $min_engine,
            'max_engine' => $max_engine,
            'credit' => $credit,
            'barter' => $barter,
            'disk' => $disk,
            'radar' => $radar,
            'camera' => $camera,
            'qapanma' => $qapanma,
            'lampa' => $lampa,
            'leather' => $leather,
            'lyuk' => $lyuk,
            'isidilme' => $isidilme,
            'abs' => $abs,
            'kondisioner' => $kondisioner,
            'sensor' => $sensor,
            'havalandirma' => $havalandirma,
            'perde' => $perde,
            'esp' => $esp,
            'order' => $order,
            'fuel' => $fuel,
            'transmission' => $transmission,
            'drive' => $drive
          );

          $from = (int) $this->input->post('from');
          if ($top)
            $data = $this->top_pagination_data(array('cars' => $this->PagesModel->get_main_list_top($vars, ' and (premium = 1 or u.unlimited = 1)', $from.', 12', 'car.premium_update_date desc'), 'webp' => $this->webp));
          else
            $data = $this->top_pagination_data(array('cars' => $this->PagesModel->get_main_list_top($vars, ' and (vip = 1 or u.unlimited = 1)', $from.', 12', 'car.vip_update_date desc'), 'webp' => $this->webp));

          echo json_encode(array('otomoto' => $this->security->get_csrf_hash(), 'data' => $data, 'webp' => $this->webp));
        }
      }

      public function simple_pagination()
      {
        if ($this->input->post())
        {
          $mark_array = $model_array = $body_array = $color_array = $city_array = $fuel_array = $transmission_array = $drive_array = [];
          $mark = $model = $body = $color = $city = $search = $top = 0;
          $min_mileage = $max_mileage = $currency = $min_price = $max_price = $min_year = $max_year = $min_engine = $max_engine = 0;
          $credit = $barter = $disk = $radar = $camera = $qapanma = $lampa = $leather = $lyuk = $isidilme = $abs = $kondisioner = $sensor = $havalandirma = $perde = $esp = 0;
          $order = $fuel = $transmission = $drive = '';

          if($this->input->get())
          {
            $filtered_get = $this->filter_data($this->input->get());
            $order = $this->input->get('order')?$filtered_get['order']:'';

            $b = @$this->input->get('mark');
            if (isset($b)) {
              $search = 1;
              $mark = $filtered_get['mark']?(int)$filtered_get['mark']:0;
              $model = $filtered_get['model']?(int)$filtered_get['model']:0;
              $data['filter_mark2'] = (int) $filtered_get['mark'];
              $data['filter_model2'] = (int) $filtered_get['model'];
              $data['filter_mark_name'] = $this->universal_model->get_more_item_select_row('carmark', 'mark', array('id' => $mark));
              $data['filter_model_name'] = $this->universal_model->get_more_item_select_row('carmodel', 'model', array('id' => $model));
            }
            $city = $this->input->get('city')?(int)$filtered_get['city']:0;

            $a = @$this->input->get('min_engine');
            if(isset($a))
            {
              $search = 1;
              $mark_array = $this->input->get('mark_array')?$filtered_get['mark_array']:[];
              $mark = $mark_array?implode(',', $mark_array):0;
              $model_array = $this->input->get('model_array')?$filtered_get['model_array']:[];
              $model = $model_array?implode(',', $model_array):0;
              $body_array = $this->input->get('body')?$filtered_get['body']:[];
              $body = $body_array?implode(',', $body_array):0;
              $color_array = $this->input->get('color')?$filtered_get['color']:[];
              $color = $color_array?implode(',', $color_array):0;
              $city_array = $this->input->get('city_array')?$filtered_get['city_array']:[];
              $city = $city_array?implode(',', $city_array):0;
              $fuel_array = $this->input->get('fuel')?$filtered_get['fuel']:[];
              $fuel = $fuel_array?'"'.implode('","', $fuel_array).'"':'';
              $transmission_array = $this->input->get('transmission')?$filtered_get['transmission']:[];
              $transmission = $transmission_array?'"'.implode('","', $transmission_array).'"':'';
              $drive_array = $this->input->get('drive')?$filtered_get['drive']:[];
              $drive = $drive_array?'"'.implode('","', $drive_array).'"':'';

              $min_mileage = (int)$filtered_get['min_mileage'];
              $max_mileage = (int)$filtered_get['max_mileage'];
              $min_engine = (int)$filtered_get['min_engine'];
              $max_engine = (int)$filtered_get['max_engine'];

    					$disk = $this->input->get('disk')?1:0;
    					$radar = $this->input->get('radar')?1:0;
    					$camera = $this->input->get('camera')?1:0;
    					$qapanma = $this->input->get('qapanma')?1:0;
    					$lampa = $this->input->get('lampa')?1:0;
    					$leather = $this->input->get('leather')?1:0;
    					$lyuk = $this->input->get('lyuk')?1:0;
    					$isidilme = $this->input->get('isidilme')?1:0;
    					$abs = $this->input->get('abs')?1:0;
    					$kondisioner = $this->input->get('kondisioner')?1:0;
    					$sensor = $this->input->get('sensor')?1:0;
    					$havalandirma = $this->input->get('havalandirma')?1:0;
    					$perde = $this->input->get('perde')?1:0;
    					$esp = $this->input->get('esp')?1:0;
            }

            $v = @$this->input->get('min_year');
            if (isset($v)) {
              $currency = (int) $filtered_get['currency'];
              $min_price = (int) $filtered_get['min_price'];
              $max_price = (int) $filtered_get['max_price'];
              $min_year = (int) $filtered_get['min_year'];
              $max_year = (int) $filtered_get['max_year'];
              $credit = $this->input->get('credit')?1:0;
              $barter = $this->input->get('barter')?1:0;
            }
          }

          $vars = array(
            'mark' => $mark,
            'model' => $model,
            'body' => $body,
            'color' => $color,
            'city' => $city,
            'min_mileage' => $min_mileage,
            'max_mileage' => $max_mileage,
            'currency' => $currency,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'min_year' => $min_year,
            'max_year' => $max_year,
            'min_engine' => $min_engine,
            'max_engine' => $max_engine,
            'credit' => $credit,
            'barter' => $barter,
            'disk' => $disk,
            'radar' => $radar,
            'camera' => $camera,
            'qapanma' => $qapanma,
            'lampa' => $lampa,
            'leather' => $leather,
            'lyuk' => $lyuk,
            'isidilme' => $isidilme,
            'abs' => $abs,
            'kondisioner' => $kondisioner,
            'sensor' => $sensor,
            'havalandirma' => $havalandirma,
            'perde' => $perde,
            'esp' => $esp,
            'order' => $order,
            'fuel' => $fuel,
            'transmission' => $transmission,
            'drive' => $drive
          );

          $from = (int) $this->input->post('from');
          $data = $this->simple_pagination_data(array('cars' => $this->PagesModel->get_main_list_top($vars, '', $from.', 12', 'car.createdate desc'), 'webp' => $this->webp));

          echo json_encode(array('otomoto' => $this->security->get_csrf_hash(), 'data' => $data, 'webp' => $this->webp));
        }
      }

      public function rent_top_pagination()
      {
        if ($this->input->post())
        {
          $mark_array = $model_array = $body = $color = $city_array = $fuel = $transmission = $drive = [];
          $class = $mark = $model = $min_mileage = $max_mileage = $currency = $min_price = $max_price = $min_year = $max_year = $min_engine = $max_engine = 0;
          $delivery = $returning = $baby_chair = $roof_rack = $insurance = 0;
          $min_included_km = $max_included_km = $min_deposit = $max_deposit = $min_limitation = $max_limitation = 0;
          $disk = $radar = $camera = $qapanma = $lampa = $leather = $lyuk = $isidilme = $abs = $kondisioner = $sensor = $havalandirma = $perde = $esp = 0;
          $order = $filter_mark2 = $filter_model2 = $filter_mark_name = $filter_model_name = $filter_class = '';

          if($this->input->get())
          {
            $filtered_get = $this->filter_data($this->input->get());
            $class = $this->input->get('class')?$filtered_get['class']:0;
            $order = $this->input->get('order')?$filtered_get['order']:'';
            $search = $data['all_ads'] = $this->input->get('search')?1:0;
            $top = $this->input->get('top')?(int)$filtered_get['top']:0;

            $a = @$this->input->get('min_mileage');
            if(isset($a))
            {
              $search = 1;
              $mark_array = $this->input->get('mark_array')?$filtered_get['mark_array']:[];
              $mark = $mark_array?implode(',', $mark_array):0;
              $model_array = $this->input->get('model_array')?$filtered_get['model_array']:[];
              $model = $model_array?implode(',', $model_array):0;
              $body_array = $this->input->get('body')?$filtered_get['body']:[];
              $body = ($body_array && @$body_array[0])?implode(',', $body_array):0;
              $color_array = $this->input->get('color')?$filtered_get['color']:[];
              $color = ($color_array && @$color_array[0])?implode(',', $color_array):0;
              $city_array = $this->input->get('city_array')?$filtered_get['city_array']:[];
              $city = ($city_array && @$city_array[0])?implode(',', $city_array):0;
              $fuel_array = $this->input->get('fuel')?$filtered_get['fuel']:[];
              $fuel = ($fuel_array && @$fuel_array[0])?'"'.implode('","', $fuel_array).'"':'';
              $transmission_array = $this->input->get('transmission')?$filtered_get['transmission']:[];
              $transmission = ($transmission_array && @$transmission_array[0])?'"'.implode('","', $transmission_array).'"':'';
              $drive_array = $this->input->get('drive')?$filtered_get['drive']:[];
              $drive = ($drive_array && @$drive_array[0])?'"'.implode('","', $drive_array).'"':'';

              $min_mileage = (int)$filtered_get['min_mileage'];
              $max_mileage = (int)$filtered_get['max_mileage'];
              $min_engine = (int)$filtered_get['min_engine'];
              $max_engine = (int)$filtered_get['max_engine'];
              $min_included_km = (int) $filtered_get['min_included_km'];
              $max_included_km = (int) $filtered_get['max_included_km'];
              $min_deposit = (int) $filtered_get['min_deposit'];
              $max_deposit = (int) $filtered_get['max_deposit'];
              $min_limitation = (int) $filtered_get['min_limitation'];
              $max_limitation = (int) $filtered_get['max_limitation'];

    					$disk = $this->input->get('disk')?1:0;
    					$radar = $this->input->get('radar')?1:0;
    					$camera = $this->input->get('camera')?1:0;
    					$qapanma = $this->input->get('qapanma')?1:0;
    					$lampa = $this->input->get('lampa')?1:0;
    					$leather = $this->input->get('leather')?1:0;
    					$lyuk = $this->input->get('lyuk')?1:0;
    					$isidilme = $this->input->get('isidilme')?1:0;
    					$abs = $this->input->get('abs')?1:0;
    					$kondisioner = $this->input->get('kondisioner')?1:0;
    					$sensor = $this->input->get('sensor')?1:0;
    					$havalandirma = $this->input->get('havalandirma')?1:0;
    					$perde = $this->input->get('perde')?1:0;
    					$esp = $this->input->get('esp')?1:0;
              $insurance = $this->input->get('insurance')?1:0;
              $baby_chair = $this->input->get('baby_chair')?1:0;
              $roof_rack = $this->input->get('roof_rack')?1:0;
            }

            $b = @$this->input->get('currency');
            if(isset($b))
            {
              $currency = (int)$filtered_get['currency'];
              $min_price = (int)$filtered_get['min_price'];
              $max_price = (int)$filtered_get['max_price'];
              $min_year = (int)$filtered_get['min_year'];
              $max_year = (int)$filtered_get['max_year'];
              $delivery = $this->input->get('delivery')?1:0;
              $returning = $this->input->get('returning')?1:0;
            }

            $v = @$this->input->get('model');
            if(isset($v)) {
              $filter_mark2 = (int) $filtered_get['mark'];
              $filter_model2 = (int) $filtered_get['model'];
              $filter_mark_name = $this->universal_model->get_more_item_select_row('carmark', 'mark', array('id' => $filter_mark2));
              $filter_model_name = $this->universal_model->get_more_item_select_row('carmodel', 'model', array('id' => $filter_model2));
            }
          }

          $vars = array(
            'mark' => $mark,
            'model' => $model,
            'body' => $body,
            'color' => $color,
            'city' => $city,
            'fuel' => $fuel,
            'transmission' => $transmission,
            'drive' => $drive,
            'min_mileage' => $min_mileage,
            'max_mileage' => $max_mileage,
            'currency' => $currency,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'min_year' => $min_year,
            'max_year' => $max_year,
            'min_engine' => $min_engine,
            'max_engine' => $max_engine,
            'disk' => $disk,
            'radar' => $radar,
            'camera' => $camera,
            'qapanma' => $qapanma,
            'lampa' => $lampa,
            'leather' => $leather,
            'lyuk' => $lyuk,
            'isidilme' => $isidilme,
            'abs' => $abs,
            'kondisioner' => $kondisioner,
            'sensor' => $sensor,
            'havalandirma' => $havalandirma,
            'perde' => $perde,
            'esp' => $esp,
            'order' => $order,
            'class' => $class,
            'min_included_km' => $min_included_km,
            'max_included_km' => $max_included_km,
            'min_deposit' => $min_deposit,
            'max_deposit' => $max_deposit,
            'min_limitation' => $min_limitation,
            'max_limitation' => $max_limitation,
            'insurance' => $insurance,
            'baby_chair' => $baby_chair,
            'roof_rack' => $roof_rack,
            'delivery' => $delivery,
            'returning' => $returning
          );

          $from = (int) $this->input->post('from');
          if ($top)
            $data = $this->rent_top_pagination_data(array('cars' => $this->PagesModel->get_rent_main_list_top($vars, ' and premium=1', $from.', 12', 'car.premium_update_date desc'), 'webp' => $this->webp));
          else
            $data = $this->rent_top_pagination_data(array('cars' => $this->PagesModel->get_rent_main_list_top($vars, ' and vip=1', $from.', 12', 'car.vip_update_date desc'), 'webp' => $this->webp));

          echo json_encode(array('otomoto' => $this->security->get_csrf_hash(), 'data' => $data, 'webp' => $this->webp));
        }
      }

      public function recovery_pass()
      {
        $data = [];
        $header = $this->header_data();
        $content = array_merge($data, $header);

        $this->load->view('/site/tez_header', $content);
        $this->load->view('/Pages/recovery_pass');
        $this->load->view('/site/footer');
      }

      public function agreement()
      {
        $data = [];
        $header = $this->header_data();
        $content = array_merge($data, $header);

        $this->load->view('/site/tez_header', $content);
        $this->load->view('/Pages/agreement');
        $this->load->view('/site/footer');
      }

      public function recovery_pass_send()
      {
        if($this->input->post())
        {
          $filtered_post = $this->filter_data($this->input->post());
          $mail = $filtered_post['email'];

          $check = $this->universal_model->get_item_where('user', array('email' => $mail, 'status' => 1), 'id');

          if ($check) {
            $this->load->library("template");
            $token = $this->generate_name();
            $this->universal_model->update_table('user', array('email' => $mail), array('recovery_token' => $token));

            $html = 'Şifrəni bərpa etmək üçün xaiş olunur bu linkə daxil olasınız: <a href="'.base_url().'pages/recovery_pass_page?token='.$token.'">şifrənin bərpası</a>';
            $result = $this->template->send_mail("Otomoto - şifrənin bərpası", $html, 'izzetlividik@gmail.com');

            redirect('/pages/index/main-page?rec_pass=1');
          } else {
            redirect('/pages/index/main-page?rec_pass=2');
          }
        }
      }

      public function recovery_pass_page()
      {
        if($this->input->get())
        {
          $filtered_get = $this->filter_data($this->input->get());
          $token = $filtered_get['token'];
          $error_msg = $this->input->get('error_msg')?(int)$this->input->get('error_msg'):0;

          $result = $this->universal_model->get_item_where('user', array('recovery_token' => $token), 'email');

          if ($result) {
            $data['mail'] = $result->email;
            $data['token'] = $token;
            $data['error_msg'] = $error_msg;
            $data['title'] = 'recovery_pass_page';

            $header = $this->header_data();
            $content = array_merge($data, $header);

            $this->load->view('/site/tez_header', $content);
            $this->load->view('/Pages/recovery_pass_page');
            $this->load->view('/site/footer');
          }
        }
      }

      public function recovery_pass_do()
      {
        if($this->input->post())
        {
          $filtered_post = $this->filter_data($this->input->post());
          $mail = $filtered_post['email'];
          $password = $filtered_post['password'];
          $repeat_password = $filtered_post['repeat_password'];
          $token = $filtered_post['recovery_token'];

          if ($password && strlen($password) < 6) {
            redirect('/pages/recovery_pass_page?token='.$token.'&error_msg=1');
          } else if ($password != $repeat_password) {
            redirect('/pages/recovery_pass_page?token='.$token.'&error_msg=2');
          } else {
            $result = $this->universal_model->update_table('user', array('password' => md5($password)), array('email' => $mail));
            $result?redirect('/pages/index/main-page?rec_pass=3'):redirect('/pages/recovery_pass_page?token='.$token.'&error_msg=3');
          }
        }
      }

      public function order_rent()
      {
        if ($this->input->post())
        {
          $filtered_post = $this->filter_data($this->input->post());
          $id = (int) $filtered_post['id'];
          $title = $filtered_post['title'];

          $this->load->library("template");

          $date1 = strtotime($filtered_post['start_date']);
          $date2 = strtotime($filtered_post['end_date']);

          if ($date2 > $date1 || $date2 == $date1) {
            $date1 = date('d-m-Y H:i:s', $date1);
            $date2 = date('d-m-Y H:i:s', $date2);

            $mail = $filtered_post['email'];

            if (@$this->session->userdata('uid')) {
              $user = $this->universal_model->get_item_where('user', array('id' => $this->session->userdata('uid')), 'first_name, last_name, mobile');

              $vars = array(
                'rent_car_id' => $id,
                'name' => $user->first_name.' '.$user->last_name,
                'mobile' => $user->mobile,
                'create_date' => date('Y-m-d H:i:s')
              );

              $this->universal_model->add_item($vars, 'rent_log');

              $msg = '<h3>'.$id.' nömrəli elanınıza '.$user->first_name.' '.$user->last_name.' ('.$user->mobile.') tərəfindən '.$date1.' tarixindən '.$date2.' tarixinədək sifariş gəlib</h3><br><br><br><h1>Otomoto</h1>';
            } else {
              $name = $filtered_post['user_name'];
              $mobile = $filtered_post['user_mobile'];

              $vars = array(
                'rent_car_id' => $id,
                'name' => $name,
                'mobile' => $mobile,
                'create_date' => date('Y-m-d H:i:s')
              );

              $this->universal_model->add_item($vars, 'rent_log');

              $msg = '<h3>'.$id.' nömrəli elanınıza '.$name.' ('.$mobile.') tərəfindən '.$date1.' tarixindən '.$date2.' tarixinədək sifariş gəlib</h3><br><br><br><h1>Otomoto</h1>';
            }

            $this->template->send_mail($id." nömrəli rent a car elanına sifariş", $msg, $mail);
            redirect('/pages/rent_product/'.$title.'/'.$id.'?status=send_success2');
          } else {
            redirect('/pages/rent_product/'.$title.'/'.$id.'?status=date_error');
          }
        }
      }

      public function add_to_auction_with_pin()
      {
        if ($this->input->post())
        {
          $filtered_post = $this->filter_data($this->input->post());

          $pin_code = (int)$filtered_post['pin_code'];
          $car_id = (int) $filtered_post['carad_id'];
          $title = $filtered_post['title'];

          $check_pin = $this->universal_model->get_item_where('carad', array('id' => $car_id, 'pincode' => $pin_code), 'id');

          if (@$check_pin && @$check_pin->id)
          {
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
              redirect('/pages/product/'.$title.'?status=auction_success');
            else
              redirect('/pages/product/'.$title.'?status=auction_error');
          }
          else
          {
            redirect('/pages/product/'.$title.'?status=auction_pin_error');
          }
        }
      }

      public function save_name_phone_in_session()
      {
        if ($this->input->post())
        {
          $name = $this->input->post('user_name');
          $phone = $this->input->post('user_phone');

          $data = array(
            's_user_name' => $name,
            's_phone' => $phone
          );

          $a = @$this->session->userdata('s_user_name');

          if (isset($a)) {
            $this->session->unset_userdata('s_user_name');
            $this->session->unset_userdata('s_phone');
          }

          $this->session->set_userdata($data);
        }
      }

      public function rent_phone_click()
      {
        if ($this->input->post())
        {
          $id = (int) $this->input->post('id');
          $check = $this->universal_model->get_item_where('rent_phone_log', array('rent_car_id' => $id), 'count');

          if (@$check && @$check->count)
            $this->universal_model->update_table('rent_phone_log', array('rent_car_id' => $id), array('count' => ((int) $check->count + 1)));
          else {
            $vars = array(
              'rent_car_id' => $id,
              'count' => 1
            );

            $this->universal_model->add_item($vars, 'rent_phone_log');
          }
        }
      }

      // public function cng_adm_passwd()
    	// {
    	// 	$key = $this->config->item('encryption_key');
    	// 	$password = 'Ayla2301060';
    	// 	$salt1 = hash('sha512', $key.$password);
    	// 	$salt2 = hash('sha512', $password.$key);
    	// 	$hashed_password = md5(hash('sha512', $salt1.$password.$salt2));
      //
    	// 	$result = $this->universal_model->update_table('ali_users', array('id' => 5), array('pass' => $hashed_password));
    	// 	echo $result?1:0;
    	// }

    }
